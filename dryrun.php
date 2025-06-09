<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Dry run script for Zoom Sync Users task.
 * This script shows what would be done without actually performing the sync.
 *
 * @package    local_zoomsyncusers
 * @author     Yedidia Klein <yedidia@openapp.co.il>
 * @copyright  Yedidia Klein
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
require_once($CFG->dirroot . '/mod/zoom/locallib.php');

// Require admin login.
require_login();
require_capability('moodle/site:config', context_system::instance());

$PAGE->set_url('/local/zoomsyncusers/dryrun.php');
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_zoomsyncusers') . ' - ' . get_string('dryrunshort', 'local_zoomsyncusers'));
$PAGE->set_heading(get_string('pluginname', 'local_zoomsyncusers') . ' - ' . get_string('dryrunshort', 'local_zoomsyncusers'));

echo $OUTPUT->header();

// Get the plugin settings.
$domain = get_config('local_zoomsyncusers', 'domain');
$type = get_config('local_zoomsyncusers', 'createtype');
$syncroles = get_config('local_zoomsyncusers', 'syncroles');

echo $OUTPUT->box_start('generalbox');

echo html_writer::tag('h3', get_string('currentconfig', 'local_zoomsyncusers'));
echo html_writer::start_tag('ul');
echo html_writer::tag('li', get_string('domainlabel', 'local_zoomsyncusers') . ' ' .
    ($domain ?: get_string('notset', 'local_zoomsyncusers')));
echo html_writer::tag('li', get_string('createtypelabel', 'local_zoomsyncusers') . ' ' .
    ($type ?: get_string('notset', 'local_zoomsyncusers')));
echo html_writer::tag('li', get_string('selectedroleslabel', 'local_zoomsyncusers') . ' ' .
    ($syncroles ?: get_string('noneselected', 'local_zoomsyncusers')));
echo html_writer::end_tag('ul');

echo $OUTPUT->box_end();

// Determine what the task would do.
$users = [];
$actiondescription = '';

if (empty($domain) || ($domain == "example.com")) {
    // Check if roles are selected.
    if (!empty($syncroles)) {
        // Parse the roles configuration.
        $selectedroles = explode(',', $syncroles);
        if (!empty($selectedroles)) {
            $actiondescription = get_string('syncroleswith', 'local_zoomsyncusers', implode(', ', $selectedroles));

            // Build the SQL to get users with any of the selected roles.
            list($rolesql, $roleparams) = $DB->get_in_or_equal($selectedroles, SQL_PARAMS_NAMED, 'role');
            $users = $DB->get_records_sql('SELECT DISTINCT u.*, r.shortname as rolename FROM {user} u
                JOIN {role_assignments} ra ON ra.userid = u.id
                JOIN {context} c ON c.id = ra.contextid
                JOIN {role} r ON r.id = ra.roleid
                WHERE c.contextlevel = :contextlevel AND r.shortname ' . $rolesql . '
                ORDER BY u.lastname, u.firstname',
                array_merge(['contextlevel' => CONTEXT_COURSE], $roleparams));
        } else {
            $actiondescription = get_string('errornorolesselected', 'local_zoomsyncusers');
        }
    } else {
        $actiondescription = get_string('errornodomainorroles', 'local_zoomsyncusers');
    }
} else {
    $actiondescription = get_string('syncdomainusers', 'local_zoomsyncusers', $domain);
    // Get all users with the specified domain.
    $users = $DB->get_records_sql('SELECT * FROM {user} WHERE email LIKE ? ORDER BY lastname, firstname',
        ['%' . $domain]);
}

echo $OUTPUT->box_start('generalbox');
echo html_writer::tag('h3', get_string('taskaction', 'local_zoomsyncusers'));
echo html_writer::tag('p', $actiondescription);
echo $OUTPUT->box_end();

if (!empty($users)) {
    echo $OUTPUT->box_start('generalbox');
    echo html_writer::tag('h3', get_string('userstoprocess', 'local_zoomsyncusers', count($users)));

    // Check Zoom API availability.
    $zoomavailable = false;
    try {
        $zoom = zoom_webservice();
        $zoomavailable = true;
        echo html_writer::tag('p', get_string('zoomapiavailable', 'local_zoomsyncusers'),
            ['style' => 'color: green;']);
    } catch (moodle_exception $exception) {
        echo html_writer::tag('p', get_string('zoomapifailed', 'local_zoomsyncusers', $exception->getMessage()),
            ['style' => 'color: red;']);
    }

    // Create table to show users.
    $table = new html_table();
    $table->head = [
        get_string('tablename', 'local_zoomsyncusers'),
        get_string('tableemail', 'local_zoomsyncusers'),
        get_string('tablezoomstatus', 'local_zoomsyncusers'),
        get_string('tableaction', 'local_zoomsyncusers'),
    ];
    $table->attributes['class'] = 'generaltable';

    $createcount = 0;
    $skipcount = 0;

    foreach ($users as $user) {
        $row = new html_table_row();

        // User name and email.
        $row->cells[] = fullname($user);
        $row->cells[] = $user->email;

        // Check if user exists in Zoom (if API is available).
        $zoomstatus = get_string('statusunknown', 'local_zoomsyncusers');
        $action = get_string('statusunknown', 'local_zoomsyncusers');

        if ($zoomavailable) {
            try {
                $zoomuser = zoom_get_user(zoom_get_api_identifier($user));
                if ($zoomuser) {
                    $zoomstatus = get_string('statusexists', 'local_zoomsyncusers');
                    $action = get_string('actionskip', 'local_zoomsyncusers');
                    $skipcount++;
                    $row->attributes['style'] = 'background-color: #f0f8ff;';
                } else {
                    $zoomstatus = get_string('statusdoesnotexist', 'local_zoomsyncusers');
                    $action = get_string('actioncreate', 'local_zoomsyncusers', $type);
                    $createcount++;
                    $row->attributes['style'] = 'background-color: #f0fff0;';
                }
            } catch (Exception $e) {
                $zoomstatus = get_string('errorchecking', 'local_zoomsyncusers', $e->getMessage());
                $action = get_string('actionwouldcreate', 'local_zoomsyncusers');
                $createcount++;
                $row->attributes['style'] = 'background-color: #fff8dc;';
            }
        } else {
            $action = get_string('actionwouldcreatetype', 'local_zoomsyncusers', $type);
            $createcount++;
        }

        $row->cells[] = $zoomstatus;
        $row->cells[] = $action;

        $table->data[] = $row;
    }

    echo html_writer::table($table);

    echo $OUTPUT->box_start('generalbox');
    echo html_writer::tag('h4', get_string('summary', 'local_zoomsyncusers'));
    echo html_writer::start_tag('ul');
    echo html_writer::tag('li', get_string('userstocreate', 'local_zoomsyncusers', $createcount));
    echo html_writer::tag('li', get_string('userstoskip', 'local_zoomsyncusers', $skipcount));
    echo html_writer::tag('li', get_string('totalusers', 'local_zoomsyncusers', count($users)));
    echo html_writer::end_tag('ul');
    echo $OUTPUT->box_end();

    echo $OUTPUT->box_end();
} else {
    echo $OUTPUT->box_start('generalbox');
    echo html_writer::tag('h3', get_string('result', 'local_zoomsyncusers'));
    echo html_writer::tag('p', get_string('nousers', 'local_zoomsyncusers'));
    echo $OUTPUT->box_end();
}

// Add navigation back to settings.
echo $OUTPUT->box_start('generalbox');
echo html_writer::tag('p',
    html_writer::link(
        new moodle_url('/admin/settings.php', ['section' => 'local_zoomsyncusers_settings']),
        get_string('backtosettings', 'local_zoomsyncusers')
    )
);
echo $OUTPUT->box_end();

echo $OUTPUT->footer();
