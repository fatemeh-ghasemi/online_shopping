<?php

require './Includes/init.php';
if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $register=new Register();
    
    $fname=  Db::get()->real_escape_string($_POST['fname']);
    $lname=  Db::get()->real_escape_string($_POST['lname']);
    $email=  Db::get()->real_escape_string($_POST['email']);
    $password=  Db::get()->real_escape_string($_POST['password']);
    $noerror=true;
    if(empty($fname)){
        add_flash_message("your First name is empty.");
         $noerror=false;
    }
     if(empty($lname)){
        add_flash_message("your Last name is empty.");
         $noerror=false;
    }
     if(empty($email)){
        add_flash_message("your Email is empty.");
         $noerror=false;
             }
     if(empty($password)){
        add_flash_message("your Password is empty.");
         $noerror=false;
    }
    if($noerror==FALSE){
        redirect($_SERVER['PHP_SELF']);
    }
    try{
    $register->add_new_user($fname, $lname, $email, $password);

    redirect(PATH."/index.php");
  
    }  catch (Exception $e){
        if($e->getCode() == 1062)
            {
            add_flash_message('This email is duplicate .');
            redirect($_SERVER['PHP_SELF']);
  
        }
    }
    }
$category=new Category();
$c=$category->admin_get_categories();

echo $twig->render('register.html.twig', array('category'=>$c));