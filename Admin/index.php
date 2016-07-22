<?php

require '../Includes/init.php' ;
$login = new Login() ;
if ( $login -> is_login () && $login -> is_admin () ) {
    redirect ( PATH . "/Admin/products/index.php" ) ;
}
if ( $_SERVER[ 'REQUEST_METHOD' ] == "POST" ) {
    $email      = Db::get () -> real_escape_string ( $_POST[ 'email' ] ) ;
    $password   = Db::get () -> real_escape_string ( $_POST[ 'password' ] ) ;
    $rememberme = isset ( $_POST[ 'remember' ] ) ;
    $captcha    = get_post_data ( 'cap' ) ;
    if ( $login -> check ( $email , $password , $rememberme ) ) {
        if ( $captcha == get_captcha_code () ) {
            if ( $login -> is_admin () ) {
                redirect ( PATH . "/Admin/products/index.php" ) ;
            }
            else {

                add_flash_message ( "You are not admin . " ) ;
                redirect ( $_SERVER[ 'PHP_SELF' ] ) ;
            }
        }
        else {
            add_flash_message ( "The captcha incorrect . " ) ;
            redirect ( $_SERVER[ 'PHP_SELF' ] ) ;
        }
    }
    else {
        add_flash_message ( "Your informatin invalid . " ) ;
        redirect ( $_SERVER[ 'PHP_SELF' ] ) ;
    }
}
$category = new Category() ;
$c        = $category -> admin_get_categories () ;
echo $twig -> render ( "admin/index.html.twig" , array ( 'category' => $c ) ) ;

