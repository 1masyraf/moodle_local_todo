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
 * Version information for the local_message plugin.
 *
 * @package    local_todo
 * @author     Wan Asyraf
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("$CFG->libdir/formslib.php"); // Load form library

class todoform_form extends moodleform {

    //add elements to the form
    public function definition() {
        
        global $CFG;
        $mform = $this->_form; //Dont forget the underscore

        $mform->addElement('text', 'todo_title', get_string('label_todo_title', 'local_todo')); //Form element (dataType, name of the element, label)
        $mform->setType('todo_title', PARAM_NOTAGS); //Set the type of element
        $mform->setDefault('todo_title',get_string('default_todo_title', 'local_todo')); //Default value (string is from lang/en folder)

        $mform->addElement('textarea', 'todo_item', get_string('label_todo_item', 'local_todo')); //Form element (dataType, name of the element, label)
        $mform->setType('todo_item', PARAM_NOTAGS); //Set the type of element
        $mform->setDefault('todo_item',get_string('default_todo_item', 'local_todo')); //Default value (string is from lang/en folder)
    
        // selections for dropdown menu (as template if needed)
        $choices = array(); //array of choices for select element
        $choices['Pending'] = 'Pending';
        $choices['Completed'] = 'Completed';
        // $choices['2'] = \core\output\notification::NOTIFY_ERROR;
        // $choices['3'] = \core\output\notification::NOTIFY_INFO;

        $mform->addElement('select', 'todo_status', get_string('label_todo_status', 'local_todo'), $choices);
        $mform->setDefault('todo_status', 'Disabled');
        
        $this->add_action_buttons(); //form submit and cancel buttons
    }

    //custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}