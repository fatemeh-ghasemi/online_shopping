<?php

class Order {

    public function add($user, Cart $cart) {
        Db::get()->query("INSERT INTO order1 SET user_id=$user[id], status='waiting'");
        $id = Db::get()->insert_id;

        $items = $cart->get();
        foreach ($items as $item) {
            $this->  create_order_item($id, $item);
        }

        return $id;
    }

    public function create_order_item($orderId, $item) {
        $id=$item['id'];
        $count=$item['count'];
        $price=$item['price'];
        Db::get()->query("INSERT INTO order_item SET order_id='$orderId' , product_id=$id, count=$count,price=$price");
    }

}
