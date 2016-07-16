<?php

require '../Includes/init.php' ;
$login      = new Login() ;
if($login->  is_login () && $login->  is_admin ()){
    redirect(PATH . "/Admin/products/index.php" );
}
if ( $_SERVER[ 'REQUEST_METHOD' ] == "POST" ) {
    $email      = Db::get () -> real_escape_string ( $_POST[ 'email' ] ) ;
    $password   = Db::get () -> real_escape_string ( $_POST[ 'password' ] ) ;
    $rememberme = isset ( $_POST[ 'remember' ] ) ;
    if ( $login -> check ( $email , $password , $rememberme ) ) {
        if ( $login -> is_admin() ) {
            redirect ( PATH . "/Admin/products/index.php" ) ;
        }
        else {
            
            add_flash_message ( "شما مدیر سایت نمی باشید." ) ;
            redirect ( PATH . "/Admin/index.php" ) ;
        }
    }
    else {
        add_flash_message ( "اطلاعات شما صحیح نمی باشد ." ) ;
        redirect ( PATH . "/Admin/index.php" ) ;
    }
}

echo $twig -> render ( "admin/index.html.twig" , array()) ;

