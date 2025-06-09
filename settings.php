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
 * Version details.
 *
 * @package    local_zoomsyncusers
 * @author     Yedidia Klein <yedidia@openapp.co.il>
 * @copyright  Yedidia Klein
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_zoomsyncusers_settings', new lang_string('pluginname', 'local_zoomsyncusers'));

    // Domain to sync.
    $settings->add( new admin_setting_configtext(
        'local_zoomsyncusers/domain',
        get_string('domain', 'local_zoomsyncusers'),
        get_string('domaindesc', 'local_zoomsyncusers'),
        'example.com', PARAM_TEXT, 50
    ));

    // Choose in srop down if doing autoCreate or create.
    $settings->add(new admin_setting_configselect(
        'local_zoomsyncusers/createtype',
        get_string('createtype', 'local_zoomsyncusers'),
        get_string('createtypedesc', 'local_zoomsyncusers'),
        'autoCreate',
        [
            'autoCreate' => get_string('autoCreate', 'local_zoomsyncusers'),
            'create' => get_string('create', 'local_zoomsyncusers'),
            'custCretae' => get_string('custCreate', 'local_zoomsyncusers'),
            'ssoCreate' => get_string('ssoCreate', 'local_zoomsyncusers'),
        ],
        PARAM_TEXT));

    // Get system roles for multiselect.
    $systemroles = get_all_roles();
    $roleoptions = [];
    foreach ($systemroles as $role) {
        $roleoptions[$role->shortname] = $role->shortname;
    }

    // Sync selected system roles multiselect.
    $settings->add(new admin_setting_configmultiselect(
        'local_zoomsyncusers/syncroles',
        get_string('syncroles', 'local_zoomsyncusers'),
        get_string('syncrolesdesc', 'local_zoomsyncusers'),
        [],
        $roleoptions
    ));

    // Add a link to the dry run analysis.
    $settings->add(new admin_setting_description(
        'local_zoomsyncusers/dryrunlink',
        get_string('dryrun', 'local_zoomsyncusers'),
        html_writer::link(
            new moodle_url('/local/zoomsyncusers/dryrun.php'),
            get_string('dryrunlink', 'local_zoomsyncusers'),
            ['target' => '_blank']
        )
    ));

    // Add the settings page to the local plugins section.
    $ADMIN->add('localplugins', $settings);
}
