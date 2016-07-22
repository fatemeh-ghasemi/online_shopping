<?php

class Category {

    public function admin_add_new_category ( $name ) {

        $result = DB::get () -> query ( "select *  from category where name='$name'  " ) ;
        if ( $result -> num_rows > 0 ) {
            return FALSE ;
        }
        else {
            DB::get () -> query ( "insert into category set name='$name'  " ) ;
            return TRUE ;
        }
    }

    public function admin_edite_category ( $id , $name ) {
        DB::get () -> query ( "update category set name='$name' where id='$id' " ) ;
        return Db::get () -> affected_rows ;
    }

    public function admin_delete_category ( $id ) {
        DB::get () -> query ( "delete from category where id='$id' " ) ;
        $result = DB::get () -> query ( "select *  from product where category_id='$id' " ) -> fetch_all ( MYSQLI_ASSOC ) ;
        foreach ( $result as $v ) {
            $pid  = $v[ 'id' ] ;
            Db::get () -> query ( "delete  from product_comment where product_id=$pid" ) ;
            Db::get () -> query ( "delete from `like`  where product_id=$pid" ) ;

            $arr  = Db::get () -> query ( "select * from product_picture where product_id=$pid" ) -> fetch_assoc () ;
            $name = $arr[ 'name' ] ;
            Db::get () -> query ( "delete  from product_picture where product_id=$pid" ) ;
            unlink ( PATH . "/product_images/" . $name ) ;
        }
        Db::get () -> query ( "delete  from product where category_id=$id" ) ;
        return Db::get () -> affected_rows ;
    }

    public function admin_get_categories () {
        $result = DB::get () -> query ( "select * from category " ) ;
        return $result -> fetch_all ( MYSQLI_ASSOC ) ;
    }

}
