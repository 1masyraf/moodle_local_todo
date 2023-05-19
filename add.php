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


require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/classes/forms/todoform.php');
// require_once(__DIR__ . '/../../classes/forms/add_form.php');

global $DB, $USER, $CFG; //*IMPORTANT* Always import this for convenience

$PAGE-> set_url('/local/todo/add.php'); //set the url to the page

$PAGE-> set_context(\context_system::instance());
$PAGE-> set_title(get_string('todo_add_title', 'local_todo')); // set title for the page

require_login();

//get id
$id = optional_param('id','', PARAM_TEXT); //get the id form url parameter
// -----------------------------------------------

//display the form here------------------------
$mform = new todoform_form(); //add form
$toform = [];
//---------------------------------------------

// if no org ID then it is a new org
// if there is an objid the we show the edit for with save
$mform = new todoform_form("?id=$id");
$toform = [];


//Form data handling --------------------------
//* when the user press cancel button
if ($mform->is_cancelled()) {
    //Go back to the list page
    redirect("/local/todo/list.php", '', 10);
}

elseif ($fromform = $mform->get_data()){

     if($id) {
        //if theres id then update
        $updatetodo = $DB->get_record('local_todo', ['id' => $id]);
    
        $updatetodo->todo_title = $fromform->todo_title;
        $updatetodo->todo_item = $fromform->todo_item;
        $updatetodo->todo_status = $fromform->todo_status;
    
        $DB->update_record('local_todo', $updatetodo);
    }

    else {
            //if no id then add new
            $newtodo = new stdClass();
            $newtodo->todo_title = $fromform->todo_title;
            $newtodo->todo_item = $fromform->todo_item;
            $newtodo->todo_status = $fromform->todo_status;
            $newtodoid = $DB->insert_record('local_todo',$newtodo, true, false);
        }
     redirect("/local/todo/list.php", 'Changes Saved', 10 , \core\output\notification::NOTIFY_SUCCESS);
}
    
else {
    if($id){
        $toform = $DB->get_record('local_todo', ['id' => $id]);
    }

    //set default data
    $mform->set_data($toform);

    echo $OUTPUT->header(); //header of the page

    //Content Body----------------------------------------------------
    $mform->display(); //display the forms
    //Content Body Ends Here----------------------------------------------------

    echo $OUTPUT->footer(); //footer of the page 

}



