<?php

require './Includes/init.php' ;
$msg = "" ;
if ( $_SERVER[ 'REQUEST_METHOD' ] == "POST" ) {
    $login      = new Login() ;
    $email      = Db::get () -> real_escape_string ( $_POST[ 'email' ] ) ;
    $password   = Db::get () -> real_escape_string ( $_POST[ 'password' ] ) ;
    $rememberme = isset ( $_POST[ 'remember' ] ) ;
    if ( $login -> check ( $email , $password , $rememberme ) ) {
        if(isset($_SESSION[ 'referer_url' ])){
            redirect($_SESSION[ 'referer_url' ] );
        }
        else {
         redirect ( "index.php" ) ;   
        }
    }
    else {
        add_flash_message( "رمزعبور یا ایمیل اشتباه هست .");
    }
}
else {
    if ( isset ( $_SERVER[ 'HTTP_REFERER' ] ) ) {
        $_SESSION[ 'referer_url' ] = $_SERVER[ 'HTTP_REFERER' ] ;
    }
    else {
        unset($_SESSION[ 'referer_url' ]);
    }
}

echo $twig -> render ( 'login.html.twig') ;
