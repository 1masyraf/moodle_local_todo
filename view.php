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
 * @package    local_message
 * @author     Wan Asyraf
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


require_once(__DIR__ . '/../../config.php');

global $DB; //*IMPORTANT* This is needed for querying the database without writing direct statements

$PAGE-> set_url(new moodle_url('/local/todo/view.php')); //set the url to the page
$PAGE-> set_context(\context_system::instance());
$PAGE-> set_title(get_string('todo_view_page_title', 'local_todo')); // set title for the page


$id = optional_param('id','', PARAM_TEXT); //get the id from the url parameter

$todoview = $DB->get_records('local_todo', ['id' => $id]); //fetch all todo data from db

echo $OUTPUT->header(); //header of the page
//Content Body----------------------------------------------------
//template context (from local/templates)----------------------------------------------------
$templatecontext = (object)[
    'todoviews' => array_values($todoview), //send the array values from db to mustache template
    'listurl' => new moodle_url('/local/todo/list.php'), //set the list url for navigation
];
echo $OUTPUT->render_from_template('local_todo/view', $templatecontext);
//template context ends here -----------------------------------------------------------------

// var_dump($todoview); // var dump for debugging
echo $OUTPUT->footer(); //footer of the page 
