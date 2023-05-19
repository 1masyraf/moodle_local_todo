<?php
// This file is part of Moodle Course Rollover Plugin
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
 * @package     local_todo
 * @author      Wan Asyraf
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// function local_todo_extend_navigation( global_navigation $nav){
//     //restrict to user with admin permission only
//     global $USER;
//     if(has_capability("local/todo:admin", context_system::instance())){

//         $main_node = $nav->add(get_string('plugin_name', 'local_todo'), '/local/todo/list.php');
//         $main_node-> nodetype = 1;
//         $main_node-> collapse = false;
//         $main_node-> forceopen = true;
//         $main_node-> isexpandable = false;
//         $main_node-> showinflatnavigation = true;
//     }
// }

function local_todo_extend_navigation(navigation_node $frontpage) {
    $frontpage->add(
    get_string('plugin_name', 'local_todo'),
    new moodle_url('/local/todo/list.php')
 );
}
