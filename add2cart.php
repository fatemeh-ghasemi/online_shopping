<?php

require './Includes/init.php' ;

$cart = new Cart() ;
$id   = ( int ) $_GET[ 'id' ] ;
if ( isset ( $_GET[ 'count' ] ) ) {
    $count = ( int ) $_GET[ 'count' ] ;
}
else {
    $count = 1 ;
}
$cart -> add ( $id , $count ) ;

if ( isset ( $_SERVER[ 'HTTP_REFERER' ] ) )
    $url = $_SERVER[ 'HTTP_REFERER' ] ;
else {
    $url = PATH . "index.php" ;
}

redirect ( $url ) ;
