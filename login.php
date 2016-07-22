<?php

require './Includes/init.php' ;
if ( $_SERVER[ 'REQUEST_METHOD' ] == "POST" ) {
    $login      = new Login() ;
    $email      = Db::get () -> real_escape_string ( $_POST[ 'email' ] ) ;
    $password   = Db::get () -> real_escape_string ( $_POST[ 'password' ] ) ;
    $rememberme = isset ( $_POST[ 'remember' ] ) ;
    $captcha    = get_post_data ( 'cap' ) ;
    if ( $login -> check ( $email , $password , $rememberme ) ) {
        if ( $captcha == get_captcha_code () ) {
            if ( isset ( $_SESSION[ 'referer_url' ] ) ) {
                redirect ( $_SESSION[ 'referer_url' ] ) ;
            }
            else {
                redirect ( "index.php" ) ;
            }
        }
        else {
            add_flash_message ( "The captcha incorrect . " ) ;
            redirect ( $_SERVER[ 'PHP_SELF' ] ) ;
        }
    }
    else {
        add_flash_message ( "Your email or password invalid . " ) ;
        redirect ( $_SERVER[ 'PHP_SELF' ] ) ;
    }
}
else {
    if ( isset ( $_SERVER[ 'HTTP_REFERER' ] ) ) {
        $_SESSION[ 'referer_url' ] = $_SERVER[ 'HTTP_REFERER' ] ;
    }
    else {
        unset ( $_SESSION[ 'referer_url' ] ) ;
    }
}
$category = new Category() ;
$c        = $category -> admin_get_categories () ;

echo $twig -> render ( 'login.html.twig' , array ( 'category' => $c ) ) ;
