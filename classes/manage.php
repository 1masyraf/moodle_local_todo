<?php

namespace local_todo;

use dml_exception;
use stdClass;


class manage {
    
    //delete a record from the database
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