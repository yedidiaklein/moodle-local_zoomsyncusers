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

$string['pluginname'] = 'Zoom Sync Users';
$string['zoomsyncusers'] = 'Zoom Sync Users';
$string['domain'] = 'Mail domain to sync';
$string['domaindesc'] = 'Only users with email from this domain on Moodle will be created on Zoom.';
$string['syncusers'] = 'Synchronize Zoom users';
$string['createtype'] = 'Create type';
$string['createtypedesc'] = 'Choose the type of user creation.
auto create will create users automatically without asking the user to approve,
it will work if Zoom allow it on your account (probably enterprise account).
create will create users and send them an approvement email.';
$string['autoCreate'] = 'Auto Create';
$string['create'] = 'Create';
