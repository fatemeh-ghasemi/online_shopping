<?php

class Order {

    public function add($user, Cart $cart) {
        Db::get()->query("INSERT INTO order1 SET user_id=$user[id], status='waiting'");
        $id = Db::get()->insert_id;

        $items = $cart->get();
        foreach ($items as $item) {
            $this->createOrderItem($id, $item);
        }

        return $id;
    }

    public function create_order_item($orderId, $item) {
        Db::get()->query("INSERT INTO `order_item` SET order_id=$orderId, product_id=$item[id], count=$item[count],price=$item[price]");
    }

}
