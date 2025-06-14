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
create will create users and send them an approvement email.
see <a href="https://developers.zoom.us/docs/api/users/#tag/users/POST/users">
Zoom documentation</a> for more details.';
$string['autoCreate'] = 'Auto Create';
$string['create'] = 'Create';
$string['custCreate'] = 'Custom Create';
$string['ssoCreate'] = 'SSO Create';
$string['syncroles'] = 'Sync users with selected roles (clear domain field for this option)';
$string['syncrolesdesc'] = 'When roles are selected, only sync users who have one of the selected roles in at least one course context (you have to clear domain field to use this option).';
$string['dryrun'] = 'Dry Run Analysis';
$string['dryrunshort'] = 'Dry Run';
$string['dryrunlink'] = 'View what would be synchronized';
$string['currentconfig'] = 'Current Configuration:';
$string['domainlabel'] = 'Domain:';
$string['createtypelabel'] = 'Create Type:';
$string['selectedroleslabel'] = 'Selected Roles:';
$string['notset'] = 'Not set';
$string['noneselected'] = 'None selected';
$string['taskaction'] = 'Task Action:';
$string['syncroleswith'] = 'Sync users with selected roles: {$a}';
$string['errornorolesselected'] = 'ERROR: No roles selected. Task would not run.';
$string['errornodomainorroles'] = 'ERROR: No domain specified, nor roles selected. Task would not run.';
$string['syncdomainusers'] = 'Sync all users with email domain: {$a}';
$string['userstoprocess'] = 'Users that would be processed ({$a} total):';
$string['zoomapiavailable'] = '✓ Zoom API connection available';
$string['zoomapifailed'] = '✗ Zoom API connection failed: {$a}';
$string['tablename'] = 'Name';
$string['tableemail'] = 'Email';
$string['tablezoomstatus'] = 'Status in Zoom';
$string['tableaction'] = 'Action that would be taken';
$string['statusunknown'] = 'Unknown';
$string['statusexists'] = '✓ Exists';
$string['statusdoesnotexist'] = '✗ Does not exist';
$string['actionskip'] = 'Skip (already exists)';
$string['actioncreate'] = 'Create user (type: {$a})';
$string['actionwouldcreate'] = 'Would attempt to create';
$string['actionwouldcreatetype'] = 'Would attempt to create (type: {$a})';
$string['errorchecking'] = 'Error checking: {$a}';
$string['summary'] = 'Summary:';
$string['userstocreate'] = 'Users to be created: {$a}';
$string['userstoskip'] = 'Users to be skipped: {$a}';
$string['totalusers'] = 'Total users: {$a}';
$string['result'] = 'Result:';
$string['nousers'] = 'No users found matching the criteria. Task would not process any users.';
$string['backtosettings'] = 'Back to Zoom Sync Users Settings';
