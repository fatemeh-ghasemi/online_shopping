<?php

require './Includes/init.php' ;


$cart = new Cart();
$order = new Order();
$login = new Login();
$orderId = $order->create($login->getCurrentUser(), $cart);

redirect("view-order.php?id=$orderId");