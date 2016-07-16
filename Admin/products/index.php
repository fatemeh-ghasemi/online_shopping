<?php

require '../../Includes/init.php';

$products=new Product();

echo $twig->render("admin/products/index.html.twig" , array( 'products' =>$products->admin_get_list() , 'picture' =>$products->  get_product_pictures ()) );

