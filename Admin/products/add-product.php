<?php

require '../../Includes/init.php';

$category = new Category();
$noerror=TRUE;
if (is_post()) {
    $product = new Product();
    $name = get_post_data('name');
    $price = get_post_data('price');
    $quantity = get_post_data('count');
    $serialnumber = get_post_data('serialnumber');
    $describtion = get_post_data('describe');
    $category_name = get_post_data('category_name');
    $pic_file = $_FILES['picture'];

    if(empty($product)){
        add_flash_message("The product name is empty.");
         $noerror=false;
    }
      if(empty($price)){
        add_flash_message("The price is empty.");
         $noerror=false;
    }
      if(empty($quantity)){
        add_flash_message("The quantity is empty.");
         $noerror=false;
    }
      if(empty($serialnumber)){
        add_flash_message("The serialnumber is empty.");
         $noerror=false;
    }
      if(empty($describtion)){
        add_flash_message("The describtion is empty.");
         $noerror=false;
    }
    
      if(!isset($category_name )){
        add_flash_message("The category  is empty.");
         $noerror=false;
    }
      if(!isset($pic_file)){
        add_flash_message("The picture is not select.");
         $noerror=false;
    }
       if($noerror==FALSE){
        redirect($_SERVER['PHP_SELF']);
    }
    $id = $product->admin_add_new_product($name, $price, $quantity, $serialnumber, $describtion, $category_name, $pic_file);
    redirect("view.php?id=$id");
}

echo $twig->render("admin/products/add-product.html.twig", array('category' => $category->admin_get_categories()));

