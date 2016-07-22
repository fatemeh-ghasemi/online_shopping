<?php

class Product {

    protected
            $n = 4 ;

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
                . " quantity='$quantity' , serialnumber='$serialnumber' , "
                . "describtion='$describtion' ,category_id='$category_id' , status='$status' where id='$id' " ) ;
        return Db::get () -> affected_rows ;
    }

    public function admin_get_list ( $f = 0 , $type = NULL ) {
        $cat_id = $this -> get_category_id ( $type ) ;
        $x      = $this -> n ;
        $result = Db::get () -> query ( "select p.id as id , p.name as name , p.price as price,p.quantity,p.describtion , pi.name as picname ,p.status  "
                . " from product p  inner join product_picture pi  on p.id=pi.product_id  "
                . " where category_id='$cat_id'  limit $f , $x" ) ;
        return $result -> fetch_all ( MYSQLI_ASSOC ) ;
    }

    public function admin_get_product ( $id ) {
        $result = Db::get () -> query ( "select p.id as id , p.name as name , p.price as price,p.quantity,p.describtion , pi.name as picname,p.serialnumber,p.category_id, p.status   "
                . "from product p inner join product_picture pi on p.id=pi.product_id where p.id='$id' " ) ;
        return $result -> fetch_assoc () ;
    }

    public function admin_get_count () {
        $result = Db::get () -> query ( "select count(*) from product " ) ;
        $result -> fetch_all ( MYSQLI_ASSOC ) ;
        $c      = $result -> fetch_row () ;
        return $c[ 0 ] ;
    }

    public function admin_delete_product ( $id ) {
        Db::get () -> query ( "delete from product where id=$id" ) ;
        Db::get () -> query ( "delete from product_comment  where product_id=$id" ) ;
        Db::get () -> query ( "delete from `like`  where product_id=$id" ) ;
        Db::get () -> query ( "delete from product_picture  where product_id=$id" ) ;
    }

    public function admin_get_comment () {
        $result = Db::get () -> query ( "select pc.id , pc.create_at as time , pc.body, u.firstname , u.lastname ,pi.name as picname ,pc.body as comment "
                . "from product_comment pc inner join user u on pc.user_id = u.id inner join product_picture pi on pc.product_id=pi.product_id  where pc.status='reject' or pc.status='waiting'  " ) ;
        return $result -> fetch_all ( MYSQLI_ASSOC ) ;
    }

    public function get_list ( $f = 0 , $condition = NULL ) {
        if ( $f != 0 ) {
            $f = ($f - 1) * $this -> n ;
        }
        $cat_id = $this -> get_category_id ( $condition ) ;
        if($cat_id==FALSE)
            return FALSE;
        $x      = $this -> n ;
        $query  = ( "select p.id as id , p.name as name , p.price as price , pi.name as picname , p.like_count"
                . " from product p  inner join product_picture pi  on p.id=pi.product_id  "
                . "where p.status='visible' and p.category_id='$cat_id'  limit $f , $x" ) ;
        $result = Db::get () -> query ( $query ) ;
        return $result -> fetch_all ( MYSQLI_ASSOC ) ;
    }

    public function get_like () {
        $query  = ( "select * from `like` ") ;
        $result = Db::get () -> query ( $query ) ;
        return $result -> fetch_all ( MYSQLI_ASSOC ) ;
    }

    public function get_product ( $id ) {
        $result = Db::get () -> query ( "select p.id as id , p.quantity , p.name as name,p.describtion , p.price as price , pi.name as picname ,p.category_id  "
                . "from product p  inner join product_picture pi  on p.id=pi.product_id  where status='visible'  and p.id='$id' " ) ;
        return $result -> fetch_assoc () ;
    }

    public function get_count ( $type ) {
        $id     = $this -> get_category_id ( $type ) ;
        if($id==FALSE)
            return FALSE;
        $result = Db::get () -> query ( "select count(*) from product where status='visible' and category_id=$id" ) ;
        $c      = $result -> fetch_row () ;
        return $c[ 0 ] ;
    }

    private function get_category_id ( $category_name ) {
        $result = Db::get () -> query ( "select id from category where name='$category_name' " ) ;
        if($result->num_rows==0)
            return FALSE;
        list($category_id) = $result -> fetch_row () ;
        return $category_id ;
    }

    public function get_category_name ( $category_id ) {
        $result = Db::get () -> query ( "select * from category where id='$category_id' " ) -> fetch_assoc () ;
        $name   = $result[ 'name' ] ;
        return $name ;
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

    public function get_comment_of_product ( $id ) {
        $result = Db::get () -> query ( "select pc.create_at as time , pc.body, u.firstname , u.lastname ,pc.body "
                        . "from product_comment pc inner join user u on pc.user_id = u.id where pc.status='approved'  and pc.product_id=$id " ) -> fetch_all ( MYSQLI_ASSOC ) ;
        return $result ;
    }

    public function set_comment ( $pid , $uid , $comment ) {
        Db::get () -> query ( "insert into product_comment set product_id=$pid , user_id=$uid , body='$comment' ,status='waiting' " ) ;
    }

    public function like ( $pid ) {
        $uid    = $_SESSION[ 'userId' ] ;
        $resule = Db::get () -> query ( "select * from`like` where  product_id=$pid and user_id=$uid " ) ;
        if ( $resule -> num_rows == 1 )
            return ;
        else {
            Db::get () -> query ( "insert into `like` set product_id=$pid , user_id=$uid " ) ;
            Db::get () -> query ( "update product set like_count=like_count+1  where id=$pid" ) ;
            return ;
        }
    }

    public function edite_comment ( $id , $status ) {
        Db::get () -> query ( "update product_comment set status='$status' where id=$id " ) ;
    }
    public function get_top_product() {
        $query=Db::get()->  query("SELECT p.id , pi.name as picname  FROM product p inner join product_picture  pi on p.id=pi.product_id ORDER BY visit_count LIMIT 0 , 7");
        $result=$query->  fetch_all(MYSQLI_ASSOC);
        return $result;
        
    }

}
