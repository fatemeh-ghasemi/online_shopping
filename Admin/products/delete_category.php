<?php

require '../../Includes/init.php';

$id=(int)$_GET['id'];
$category=new Category();
if(  is_post ()){
    if(  get_post_data ( 'conf')=="no"){
        redirect("category-list.php");
    }
    else {
       $category->admin_delete_category($id);
       redirect("category-list.php");
    }
}



$c=$category->admin_get_categories();
echo $twig->render("admin/products/delete_category.html.twig" , array( 'category'=>$c) );

