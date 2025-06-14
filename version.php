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

$plugin->component = 'local_zoomsyncusers'; // Full name of the plugin (used for diagnostics).
$plugin->version   = 2025060900;         // The current plugin version (Date: YYYYMMDDXX).
$plugin->requires  = 2022041900;         // Requires this Moodle version.
$plugin->maturity  = MATURITY_STABLE;    // This is a stable version.
$plugin->release   = '1.1.0';            // This is the plugin release version.
// Plugin dependencies.
$plugin->dependencies = [
    'mod_zoom' => 2025052000, // Requires this Zoom plugin version.
];
