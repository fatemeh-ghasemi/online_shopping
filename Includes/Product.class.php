<?php

class Product {

    protected
            $n = 10 ;

    public function admin_add_new_product ( $name , $price , $quantity , $serialnumber , $describtion , $category_name , $pic_file , $status = 'visible' ) {
        $category_id = $this -> get_category_id ( $category_name ) ;
        DB::get () -> query ( "insert into product set name='$name' ,price='$price' ,"
                . " quantity='$quantity' , serialnumber='$serialnumber' , "
                . "describtion='$describtion' ,category_id='$category_id' , status='$status' " ) ;
        $id          = Db::get () -> insert_id ;
        $this -> add_product_picture ( $id , $pic_file ) ;
        return $id ;
    }

    public function admin_edite_product ( $id , $name , $price , $quantity , $serialnumber , $describtion , $category_name , $status = 'visible' ) {
        $category_id = $this -> get_category_id ( $category_name ) ;
        DB::get () -> query ( "update product set name='$name' ,price='$price' ,"
                . " quantity='$quantity' serialnumber='$serialnumber' , "
                . "describtion='$describtion' ,category_id='$category_id' , status='$status' where id='$id' " ) ;
        // $this->update_product_picture($id, $pic_file);
        return Db::get () -> affected_rows ;
    }

    public function admin_get_list ( $f = 0 ) {
        $x=  $this ->n;
        $result = Db::get () -> query ( "select * from product limit $f , $x" ) ;
        return $result -> fetch_all ( MYSQLI_ASSOC ) ;
    }
    

    public function admin_get_product ( $id ) {
        $result = Db::get () -> query ( "select * from product where id='$id' " ) ;
        return $result -> fetch_assoc () ;
    }

    public function admin_get_count () {
        $result = Db::get () -> query ( "select count(*) from product " ) ;
        $result -> fetch_all ( MYSQLI_ASSOC ) ;
        $c      = $result -> fetch_row () ;
        return $c[ 0 ] ;
    }

    public function get_list ( $f = 0 , $filter = null , $order = null , $condition=NULL) {
        $cat_id=  $this ->  get_category_id($condition);
        $query = ( "select * from product where status='visible' and category_id='$cat_id' " ) ;

        if ( $filter != null ) {
            $query .="   and ($filter)  " ;
        }
        if ( $order != null && is_array ( $order ) && count ( $order ) ) {
            $query .=" order by " . implode ( "," , $order ) . " " ;
        }

        $x=  $this ->n;
        $query .= " limit $f , $x" ;
        $result = Db::get () -> query ( $query ) ;
        return $result -> fetch_all ( MYSQLI_ASSOC ) ;
    }

    public function get_product ( $id ) {
        $result = Db::get () -> query ( "select * from product where status='visible'  and id='$id' " ) ;
        return $result -> fetch_assoc () ;
    }

    public function get_count () {
        $result = Db::get () -> query ( "select count(*) from product where status='visible' " ) ;
        $result -> fetch_all ( MYSQLI_ASSOC ) ;
        $c      = $result -> fetch_row () ;
        return $c[ 0 ] ;
    }

    private function get_category_id ( $category_name ) {
        $result = Db::get () -> query ( "select id from category where name='$category_name' " ) ;
        list($category_id) = $result -> fetch_row () ;
        return $category_id ;
    }

    public function get_category_name ( $category_id ) {
        $result = Db::get () -> query ( "select * from category where id='$category_id' " )->  fetch_assoc () ;
        $name=$result['name'] ;
        return $name;
    }

    private function add_product_picture ( $id , $file ) {
        $arr     = explode ( "." , $file[ 'name' ] ) ;
        $ext     = $arr[ count ( $arr ) - 1 ] ;
        $picname = time () . "." . $ext ;

        $result = Db::get () -> query ( "INSERT INTO product_picture SET product_id='$id', name='$picname'" ) ;
        if ( $result == false ) {
            return FALSE ;
        }

        if ( $file[ 'error' ] == UPLOAD_ERR_OK && is_uploaded_file ( $file[ 'tmp_name' ] ) ) {
            move_uploaded_file ( $file[ 'tmp_name' ] , __DIR__ . "/../product_images/$picname" ) ;
            return TRUE ;
        }
    }

    public function inc_visit_count ( $id ) {
        Db::get () -> query ( "update product set visit_count=visit_count+1 where id='$id' " ) ;
    }
    public function get_product_picture( $id) {
        $result=Db::get()->  query("select * from product_picture where product_id=$id")->  fetch_assoc();
        return $result['name'];
        
    }
        public function get_product_pictures() {
        $result=Db::get()->  query("select * from product_picture")->  fetch_all(MYSQLI_ASSOC);
        return $result;
        
    }

//    private function update_product_picture($id, $file) {
//        $arr = explode(".", $file['name']);
//        $ext = $arr[count($arr) - 1];
//        $picname = time() . "." . $ext;
//
//        $result1 = Db::get()->query("select name from product_picture where product_id='$id' ");
//        list($name) = $result1->fetch_row();
//        $c = "product_images/$name";
//        unlink($c);
//
//        $result = Db::get()->query("update product_picture SET name='$picname' where  product_id='$id' ");
//        if ($result == false) {
//            return FALSE;
//        }
//
//        if ($file['error'] == UPLOAD_ERR_OK && is_uploaded_file($file['tmp_name'])) {
//            move_uploaded_file($file['tmp_name'], "product_images/$picname");
//            return TRUE;
//        }
//    }
}
