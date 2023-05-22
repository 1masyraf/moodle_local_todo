<?php

namespace local_todo;

use dml_exception;
use stdClass;

class manage {
    

     // Function for creating a new todo
     public function add_todo($fromform){
        global $DB;

        //if no id then add new
        $newtodo = new stdClass();
        $newtodo->todo_title = $fromform->todo_title;
        $newtodo->todo_item = $fromform->todo_item;
        $newtodo->todo_status = $fromform->todo_status;
        $newtodoid = $DB->insert_record('local_todo',$newtodo, true, false);

        return true;
    }

    // Function for editing a todo
    public function edit_todo($id,$fromform){
        global $DB;

        //if theres id then update
        $updatetodo = $DB->get_record('local_todo', ['id' => $id]);
    
        $updatetodo->todo_title = $fromform->todo_title;
        $updatetodo->todo_item = $fromform->todo_item;
        $updatetodo->todo_status = $fromform->todo_status;
    
        $DB->update_record('local_todo', $updatetodo);

        return true;
    }

    // Function for deleting todo
    public function delete_todo($id){
        global $DB;

        $id = optional_param('id','', PARAM_TEXT);

        $transaction= $DB->start_delegated_transaction();
        $deletedTodo = $DB->delete_records('local_todo', ['id' => $id]);
        if($deletedTodo){
            $DB->commit_delegated_transaction($transaction);
        }
        return true;
    }

}