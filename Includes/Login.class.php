<?php

class Login {

    public function check ( $email , $password , $rememberMe = false ) {
        $pass   = get_hash_password ( $email , $password ) ;
        $query  = "select * from user where email='$email' and password='$pass' " ;
        $result = Db::get () -> query ( $query ) ;
        if ( $result -> num_rows == 1 ) {
            $user               = $result -> fetch_assoc () ;
            $_SESSION[ 'userId' ] = $user[ 'id' ] ;

            if ( $rememberMe ) {
                setcookie ( 'userId' , $user[ 'id' ] , time () + 3600 * 24 * 14 , "/" ) ;
                setcookie ( "secret" , $this -> get_secret ( $user ) , time () + 3600 * 24 * 14 , "/" ) ;
            }
            return TRUE ;
        }
        return FALSE ;
    }

    private function get_secret ( $user ) {
        $code = md5 ( sha1 ( $user[ 'email' ] ) . md5 ( "f134h&@o$" ) . sha1 ( $user[ 'password' ] ) ) ;
        return $code ;
    }

    public function is_login () {
        if ( isset ( $_SESSION[ 'userId' ] ) && ! empty ( $_SESSION[ 'userId' ] ) ) {
            return true ;
        }
        else {
            if ( isset ( $_COOKIE[ 'userId' ] ) && isset ( $_COOKIE[ 'secret' ] ) ) {
                $user = $this -> get_user_by_id ( $_COOKIE[ 'userId' ] ) ;
                if ( $_COOKIE[ 'secret' ] === $this -> get_secret ( $user ) ) {
                    $_SESSION[ 'userId' ] = $_COOKIE[ 'userId' ] ;
                    $_SESSION[ 'user' ]   = $this -> get_user_by_id ( $_SESSION[ 'userId' ] ) ;
                    return TRUE ;
                }
            }
            return FALSE ;
        }
    }

    private function get_user_by_id ( $userId ) {
        $qry    = "select * from user where id='$userId' " ;
        $result = Db::get () -> query ( $qry ) -> fetch_assoc () ;
        return $result ;
    }

    public function get_current_user () {
        if ( $this -> is_login () ) {
            return $_SESSION[ 'user' ] ;
        }
    }

    public function is_admin () {
        $id = $_SESSION[ 'userId' ] ;

        $result = Db::get () -> query ( "select * from user where id=$id" ) -> fetch_assoc () ;
        $role  = $result[ 'role' ] ;
        if ( $role == "admin" )
            return TRUE ;
        else
            return FALSE ;
    }

}
