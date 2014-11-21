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
 * gapselect question type upgrade code.
 *
 * @package   qtype_gapselect
 * @copyright 2014 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();


/**
 * Upgrade code for the gapselect question type.
 * @param int $oldversion the version we are upgrading from.
 * @return bool
 */
function xmldb_qtype_gapselect_upgrade($oldversion) {
    global $CFG, $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2014112100) {

        // Define field nothingword to be added to question_gapselect.
        $table = new xmldb_table('question_gapselect');
        $field = new xmldb_field('nothingword', XMLDB_TYPE_CHAR, '255', null, null, null, null, 'shownumcorrect');

        // Conditionally launch add field nothingword.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Gapselect savepoint reached.
        upgrade_plugin_savepoint(true, 2014112100, 'qtype', 'gapselect');
    }

    return true;
}

