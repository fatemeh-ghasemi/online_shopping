<?php

require '../../Includes/init.php';

$product=new Product();

if(  is_post ()){
    $cid=  get_post_data('cid');
    $status=  get_post_data('optradio');
    $product->edite_comment($cid,$status);
}
$comment=$product->admin_get_comment();
$category=new Category();
$c=$category->admin_get_categories();
echo $twig->render("admin/products/comment.html.twig" , array( 'category'=>$c , 'comment'=>$comment) );

