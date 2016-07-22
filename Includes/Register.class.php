<?php

class Register {
 
    public function add_new_user($fname , $lname , $email , $password) {
        $pass=  get_hash_password($email, $password);
        Db::get()->query("insert into user set firstname='$fname' , lastname = '$lname' ,email = '$email' , password='$pass' ");
        
        return Db::get()->insert_id ;
        
    }
    
    public function change_password_request($email) {
        $result=Db::get()->query("select id from user where email='$email' ");
        list($id) = $result->fetch_row();
        
        if($id){
            $token=  $this->create_token($id);
            $this->save_token($id, $token);
            $url= $this->email_change_password($id ,$email, $token);
            return "Please enter this address in browser for change password : ".$url;
        }
        else{
            return "This email not exist . ";
        }
        
    }
    
      public function is_valid_token($token ,$id) {
        $result=Db::get()->query("select * from user_token where token='$token' and user_id='$id' and ADDDATE(create_at , INTERVAL 24 HOUR ) > NOW() ");
        list($c) = $result ->fetch_row();
        if($c > 0){
           return TRUE;
        }
        else{
            return FALSE;
        }
        
    }
    
    public function set_password($id,$email , $password) {
        $pass=  get_hash_password($email , $password);
        Db::get()->query("update user set password='$pass' where id='$id' ");
        
    }
      public function remove_token($id , $token) {
        Db::get()->query("delete from user_token where user_id='$id' and token='$token' ");
        
    }
    private function create_token($id) {
        $token=sha1(uniqid());
        return $token;
        
    }
    
       private function save_token($id ,$token) {
        Db::get()->query("insert into user_token set user_id='$id' , token='$token' ");
        
    }
    
    private function email_change_password ($id,$email , $token){
        $url="http://localhost:8080/ShopProject/change-password.php?token=$token&id=$id";
        $subject="Change Password";
        $body="لطفا روی آدرس زیر کلیک کنید"."<br>".$url;
        $to="fatemeh.ghasemi20@gmail.com";
       // sendEmail($to, $subject, $body);
        return $url;
    }
    
}
