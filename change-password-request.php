<?php

require './Includes/init.php'; 
$msg="";
if($_SERVER['REQUEST_METHOD'] ==="POST"){
$register=new Register();
$email=  escape_string($_POST['email']);
$url=$register->change_password_request($email);
add_flash_message($url);
}

echo $twig->render('change-password-request.html.twig', array());