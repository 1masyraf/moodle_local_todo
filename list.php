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

 use local_todo\manage;

require_once(__DIR__ . '/../../config.php');

global $DB; //*IMPORTANT* This is needed for querying the database without writing direct statements

$PAGE-> set_url(new moodle_url('/local/todo/list.php')); //set the url to the page
$PAGE-> set_context(\context_system::instance());
$PAGE-> set_title(get_string('todo_page_title', 'local_todo')); // set title for the page

require_login(); // to view this page, user need to be logged in using their credentials

//if the logged in user is not an admin, they cant view this page (will be changed later)
// if(!has_capability('local/todo:admin', context_system::instance())){
//     echo $OUTPUT->header();
//     echo "<h3> You do not have permission to view this page</h3>";
//     echo $OUTPUT->footer();
//     exit;
// }


//get all record from db
$todos = $DB->get_records('local_todo');


// $id = optional_param('id','', PARAM_TEXT);

// $manage = new manage();

// $manage->delete_todo($id);


echo $OUTPUT->header(); //header of the page

//template context (from local/templates)----------------------------------------------------
$templatecontext = (object)[
    'todos' => array_values($todos), //list of all messages from the database
];
echo $OUTPUT->render_from_template('local_todo/todo', $templatecontext);
//template context ends here -----------------------------------------------------------------

echo $OUTPUT->footer(); //footer of the page 
