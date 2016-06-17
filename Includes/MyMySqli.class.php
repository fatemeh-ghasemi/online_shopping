<?php


class MyMySqli  extends mysqli{
       /**
         * 
         * @param type $query
         * @return mysqli_result
         */
        public function query($query) {
            return parent::query($query);
        }

}
