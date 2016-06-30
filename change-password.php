<?php

require './Includes/init.php';

$token = escape_string($_GET['token']);
$id = (int) $_GET['id'];

$register = new Register();
$flag = $register->is_valid_token($token, $id);
if ($flag) {
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        if ($_POST['password'] == $_POST['password2']) {
            $password = escape_string($_POST["password"]);
            $register->set_password($id, $password);
            $register->remove_token($id, $token);
            add_flash_message("تغییرات اعمال شد .");
            redirect("index.php");
        } else {
            add_flash_message("رمز عبور وتکرار آن مطابقت ندارد لطفا دوباره امتحان کنید .");
            redirect($_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING']);
        }
    }
    echo $twig->render('change-password.html.twig');
} else {
    add_flash_message("آدرس اشتباه هست .");
    redirect("index.php");
}