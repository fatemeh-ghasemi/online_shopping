<?php

require './Includes/init.php';

$category=new Category();
$c=$category->admin_get_categories();

$token = escape_string($_GET['token']);
$id = (int) $_GET['id'];
$data=Db::get()->  query("select email from user where id=$id")->  fetch_assoc ();
$email=$data['email'];
$register = new Register();
$flag = $register->is_valid_token($token, $id);
if ($flag) {
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        if ($_POST['password'] == $_POST['password2']) {
            $password = escape_string($_POST["password"]);
            $register->set_password($id,$email, $password);
            $register->remove_token($id, $token);
            add_flash_message("Your password is change");
            redirect("index.php");
        } else {
            add_flash_message("The password and confirm password not equal .");
            redirect($_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING']);
        }
    }
    
    echo $twig->render('change-password.html.twig',array('category'=>$c));
} else {
    add_flash_message("This address is invalid .");
    redirect("change-password-request.php");
}