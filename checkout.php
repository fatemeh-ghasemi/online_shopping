<?php

require './Includes/init.php' ;


$cart = new Cart();
$order = new Order();
$login = new Login();
$orderId = $order->add($login->  get_current_user(), $cart);

redirect("#");