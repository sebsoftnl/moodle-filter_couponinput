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
 * Plugin version and other meta-data are defined here.
 *
 * File         version.php
 * Encoding     UTF-8
 *
 * @package     filter_couponinput
 *
 * @copyright   RvD
 * @author      RvD <helpdesk@sebsoft.nl>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->component = 'filter_couponinput';
$plugin->release = '1.0.2 (build 202404090000)';
$plugin->version = 2024040900;
$plugin->requires = 2022041900; // YYYYMMDDHH (This is the release version for Moodle 4.0).
$plugin->maturity = MATURITY_ALPHA;
$plugin->dependencies = [
    'block_coupon' => 2024010200,
];
