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
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.

/**
 * Version details.
 *
 * @package    local_zoomsyncusers
 * @author     Yedidia Klein <yedidia@openapp.co.il>
 * @copyright  Yedidia Klein
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_zoomsyncusers\task;

defined('MOODLE_INTERNAL') || die();

class sync_users extends \core\task\scheduled_task {
    /**
     * Returns the name of the task.
     *
     * @return string
     */
    public function get_name() {
        return get_string('syncusers', 'local_zoomsyncusers');
    }

    /**
     * Executes the task.
     */
    public function execute() {
        global $DB, $CFG;
        require_once($CFG->dirroot . '/mod/zoom/locallib.php');

        // Get the domain from the plugin settings.
        $domain = get_config('local_zoomsyncusers', 'domain');
        $type = get_config('local_zoomsyncusers', 'createtype');
        if (empty($domain)) {
            mtrace('No domain configured for Zoom Sync Users. Task will not run.');
            return;
        }
        // Get all users with the specified domain.
        $users = $DB->get_records_sql('SELECT * FROM {user} WHERE email LIKE ?', ['%' . $domain]);
        if (empty($users)) {
            mtrace('No users found with the specified domain. Task will not run.');
            return;
        }
        // Initialize Zoom API.
        try {
            $zoom = zoom_webservice();
        } catch (moodle_exception $exception) {
            mtrace('Skipping task - ', $exception->getMessage());
            return;
        }
        // Loop through each user and create them in Zoom.
        foreach ($users as $user) {
            // Check if the user already exists in Zoom.
            $zoom_user = zoom_get_user(zoom_get_api_identifier($user));
            if ($zoom_user) {
                mtrace('User ' . $user->email . ' already exists in Zoom. Skipping.');
                continue;
            } else {
                mtrace('User ' . $user->email . ' does not exist in Zoom. Creating...');
                // Create the user in Zoom.
                try {
                    $zoom->autocreate_user($user, $type, 1);
                    mtrace('User ' . $user->email . ' created in Zoom.');
                } catch (\Exception $e) {
                    mtrace('Error creating user ' . $user->email . ': ' . $e->getMessage());
                }
            }
        }
        mtrace('Zoom Sync Users task completed.');
        
    }
}