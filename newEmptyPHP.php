<html>
  <head>
    <title>Google recapcha demo - Codeforgeek</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
  </head>
  <body>
    <h1 style="margin-left:343px;">Google reCAPTHA Demo</h1>
    <div style="padding-left:200px;padding-bottom:15px;padding-top:15px;">
      <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <!-- leaderboard-2 -->
  <ins class="adsbygoogle"
       style="display:inline-block;width:728px;height:90px"
       data-ad-client="ca-pub-1093991142748141"
       data-ad-slot="2273512127"></ins>
  <script>
  (adsbygoogle = window.adsbygoogle || []).push({});
  </script>
    </div>
    <form id="comment_form" action="" method="post" style="border: 1px solid grey;width: 356px;padding: 31px;margin-top: 19px;margin-left: 335px;float: left;">
      <input type="email" placeholder="Type your email" size="40"><br><br>
      <textarea name="comment" rows="8" cols="39"></textarea><br><br>
      <input type="submit" name="submit" value="Post comment"><br><br>
      <div class="g-recaptcha" data-sitekey="6LcX1v4SAAAAAOf5ffTwmpYwTx07N5Df5ztmSkde"></div>
    </form>
  </body>
</html>

<?php
        $email;$comment;$captcha;
        if(isset($_POST['email'])){
          $email=$_POST['email'];
        }if(isset($_POST['comment'])){
          $email=$_POST['comment'];
        }if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
          echo '<h2>Please check the the captcha form.</h2>';
          exit;
        }
        $secretKey = "Put your secret key here";
        $ip = $_SERVER['REMOTE_ADDR'];
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
        $responseKeys = json_decode($response,true);
        if(intval($responseKeys["success"]) !== 1) {
          echo '<h2>You are spammer ! Get the @$%K out</h2>';
        } else {
          echo '<h2>Thanks for posting comment.</h2>';
        }
?>