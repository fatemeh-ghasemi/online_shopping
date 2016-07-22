<?php

function escape_string($string) {
    return Db::get()->real_escape_string($string);
}

function get_hash_password($email, $password) {
    $code = md5(sha1($email) . md5("f134h&@o$") . sha1($password));
    return $code;
}

function redirect($url) {
    header("Location: $url");
    exit(); 
}

function sendEmail($to, $subject, $body) {
    $mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'diba.otana.org';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'info@diba.otana.org';                 // SMTP username
    $mail->Password = '1234@qaz';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('info@diba.otana.org', 'Shop');
    $mail->addAddress($to);               // Name is optional

    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $subject;
    $mail->Body = $body;

    return $mail->send();
}
function add_flash_message( $message) {
    if(!isset($_SESSION['flash_messages'])){
        $_SESSION['flash_messages'] = [];
    }
    $_SESSION['flash_messages'][]=$message;
}


function get_flash_message() {
    if(!isset($_SESSION['flash_messages'])){
        return [];
    }
    $messages = $_SESSION['flash_messages'];
     $_SESSION['flash_messages'] = [] ;
     return $messages;
}

function is_post() {
    return ( $_SERVER['REQUEST_METHOD'] == "POST" );
}
function get_post_data($name) {
    return escape_string($_POST[$name]);
}
function generate_captcha_code() {
    $code="";
    for ( $i = 0 ; $i < 5 ; $i++  ) {
        if(rand(0,1)){
            $code .=rand(1, 9);
        }
        else {
            $code .=chr(rand(ord('a'), ord('z')));
        }  
    }
    $_SESSION['captcha']=$code;
}
function get_captcha_code() {
    if(!  isset($_SESSION['captcha'])){
        generate_captcha_code();
    }
    $code=$_SESSION['captcha'];
    return $code ;
    
}
