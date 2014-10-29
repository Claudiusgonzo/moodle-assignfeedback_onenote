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
 * This file contains the backup code for the feedback_file plugin.
 *
 * @package   assignfeedback_onenote
 */
defined('MOODLE_INTERNAL') || die();

/**
 * Provides the information to backup feedback files.
 *
 * This just adds its filearea to the annotations and records the number of files.
 *
 * @package   assignfeedback_onenote
 */
class backup_assignfeedback_onenote_subplugin extends backup_subplugin {

    /**
     * Returns the subplugin information to attach to feedback element
     * @return backup_subplugin_element
     */
    protected function define_grade_subplugin_structure() {

        // Create XML elements.
        $subplugin = $this->get_subplugin_element();
        $subpluginwrapper = new backup_nested_element($this->get_recommended_name());
        $subpluginelement = new backup_nested_element('feedback_file', null, array('numfiles', 'grade'));

        // Connect XML elements into the tree.
        $subplugin->add_child($subpluginwrapper);
        $subpluginwrapper->add_child($subpluginelement);

        // Set source to populate the data.
        $subpluginelement->set_source_table('assignfeedback_onenote', array('grade' => backup::VAR_PARENTID));
        // The parent is the grade.
        $subpluginelement->annotate_files('assignfeedback_onenote', 'feedback_files', 'grade');
        return $subplugin;
    }

}
