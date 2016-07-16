<?php

class Category {

    public function admin_add_new_category($name) {
        if (strlen($name)>1) {
            DB::get()->query("insert into category set name='$name'  ");
            $id = Db::get()->insert_id;

            return $id;
        }
    }

    public function admin_edite_category($id, $name) {
        DB::get()->query("update category set name='$name' where id='$id' ");
        return Db::get()->affected_rows;
    }

    public function admin_get_categories() {
        $result = DB::get()->query("select * from category ");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}
