<?php

require '../../Includes/init.php';

$category=new Category();
$name="";
if(is_post()){
    $name=  get_post_data('name');
    
}

echo $twig->render("admin/products/add-category.html.twig" , array( 'categories' =>$category->admin_add_new_category($name) ) );

