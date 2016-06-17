<?php

require './Includes/init.php';
$msg="";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $login=new Login();
    //$email=  Db::get()->real_escape_string($_POST['email']);
    //$password=  Db::get()->real_escape_string($_POST['password']);
    $email=$_POST['email'];
    $password=$_POST['password'];
    $rememberme=  isset($_POST['remember']);
    if($login->check($email, $password,$rememberme)){
       
    }
    else{
        $msg="Invalid email or password";
    }
}

echo $twig->render('login.html.twig', array('msg' => $msg));