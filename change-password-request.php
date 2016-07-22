<?php

require './Includes/init.php'; 

$category=new Category();
$c=$category->admin_get_categories();

if($_SERVER['REQUEST_METHOD'] ==="POST"){
$register=new Register();
$email=  escape_string($_POST['email']);
$url=$register->change_password_request($email);
add_flash_message($url);
redirect ( PATH . "/change-password-request.php" ) ;
}

echo $twig->render('change-password-request.html.twig', array('category'=>$c));
