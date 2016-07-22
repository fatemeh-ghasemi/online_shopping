<?php

require '../../Includes/init.php';

$category=new Category();

if(is_post()){
    $name=  get_post_data('name');
    $result=$category->  admin_add_new_category($name);
    if($result==false){
        add_flash_message("This category is exist .");
        redirect($_SERVER['PHP_SELF']);        
    }
    else{
        redirect("category-list.php");   
    }
}

echo $twig->render("admin/products/add-category.html.twig" , array( 'category'=>$category->  admin_get_categories () ) );

