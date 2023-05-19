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
// require_once('C:\Moodle\server\moodle\local\todo\templates\view.mustache');


global $DB; //*IMPORTANT* This is needed for querying the database without writing direct statements

$PAGE-> set_url(new moodle_url('/local/todo/delete.php')); //set the url to the page
$PAGE-> set_context(\context_system::instance());
$PAGE-> set_title(get_string('todo_view_page_title', 'local_todo')); // set title for the page


$id = optional_param('id','', PARAM_TEXT);

$manage = new manage();

$manage->delete_todo($id);

redirect("/local/todo/list.php", 'Todo Deleted', 10 , \core\output\notification::NOTIFY_SUCCESS);
