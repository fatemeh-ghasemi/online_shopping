<?php
require './Includes/init.php' ;
$login=new Login();
$pid=(int)$_GET['id'];
if(!$login->  is_login ()){
    redirect("login.php");
}
else{
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $product=new Product();
        $uid=$_SESSION['userId'];
        $comment=  get_post_data('comment');

        $product->set_comment($pid,$uid,$comment);
        redirect(PATH."/properties.php?id=".$pid);
        
    }
}

echo $twig -> render ( 'comment.html.twig') ;

