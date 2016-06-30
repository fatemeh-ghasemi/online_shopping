<?php

require './Includes/init.php';
$msg="";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $register=new Register();
    
    $fname=  Db::get()->real_escape_string($_POST['fname']);
    $lname=  Db::get()->real_escape_string($_POST['lname']);
    $email=  Db::get()->real_escape_string($_POST['email']);
    $password=  Db::get()->real_escape_string($_POST['password']);
    try{
    $register->add_new_user($fname, $lname, $email, $password);
    $msg ='ثبتنام کامل شد';
    }  catch (Exception $e){
        if($e->getCode() == 1062){
            $msg = 'ایمیل تکراری هست. ';
        }
    }
    echo $msg;
    }

echo $twig->render('register.html.twig', array('msg' => $msg));