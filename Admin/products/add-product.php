<?php

require '../../Includes/init.php';

$category = new Category();

if (is_post()) {
    $product = new Product();
    $name = get_post_data('name');
    $price = get_post_data('price');
    $quantity = get_post_data('count');
    $serialnumber = get_post_data('serialnumber');
    $describtion = get_post_data('describe');
    $category_name = get_post_data('category_name');
    $pic_file = $_FILES['picture'];

    $id = $product->admin_add_new_product($name, $price, $quantity, $serialnumber, $describtion, $category_name, $pic_file);
    redirect("view.php?id=$id");
}

echo $twig->render("admin/products/add-product.html.twig", array('categories' => $category->admin_get_categories()));

