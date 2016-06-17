<?php
  function  escape_string($string){
      return Db::get()->real_escape_string($string);
  }

