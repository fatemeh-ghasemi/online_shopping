<?php


class MyMySqli  extends mysqli{
       /**
         * 
         * @param type $query
         * @return mysqli_result
         */
        public function query($query) {
            $result = parent::query($query);
            
            if( $result === FALSE){
                if(DEBUG){
                    $debugtrace=  debug_backtrace();
                    $errormessage = "DB ERROR : " . Db::get()->error."\n".
                                              "ErrorNumber : ".$this->errno."\n".
                                              "Query : ".$query."\n".
                                              "File : ".$debugtrace[0]['file']."\n".
                                               "Line : ".$debugtrace[0]['line']."\n";
                }
                else{
                    echo 'خطا اتفاق افتاده لطفا دوباره امتحان کنید.';
                }
                throw new Exception($errormessage,  $this->errno);
            }
            return $result;
        }

}
