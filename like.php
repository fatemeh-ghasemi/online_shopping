<?php

require './Includes/init.php' ;
$login=new Login();

$pid   = ( int ) $_GET[ 'id' ] ;
if ($login->  is_login ()) {
    $product=new Product();
    $product->like($pid);
}
if ( isset ( $_SERVER[ 'HTTP_REFERER' ] ) )
    $url = $_SERVER[ 'HTTP_REFERER' ] ;
else {
    $url = PATH . "index.php" ;
}
redirect ( $url ) ;
