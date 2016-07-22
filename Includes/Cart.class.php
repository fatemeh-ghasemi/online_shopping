<?php

class Cart {

    public function add ( $id , $count ) {
        $cart = $this -> get_cart_array () ;
        $cart[ $id ] +=$count ;
        if ( $cart[ $id ] < 0 ) {
            $cart[ $id ] = 0 ;
        }
        $_SESSION[ 'cart' ] = $cart ;
    }

    public function get_item_count () {
        return count ( $this -> get_cart_array () ) ;
    }

    public function get () {
        $cart0   = $this -> get_cart_array () ;
        if(empty($cart0))
            return ;
        $product = new Product() ;
        $cart ;
        foreach ( $cart0 as $id => $count ) {
            $p = $product -> get_product ( $id ) ;
            if ( $p[ 'quantity' ] > $count ) {
                $p[ 'count' ] = $count ;
            }
            else {
                $p[ 'count' ] = $p[ 'quantity' ] ;
            }
            $cart[] = $p ;
        }
        return $cart ;
    }

    private function get_cart_array () {
        if ( isset ( $_SESSION[ 'cart' ] ) )
            return $_SESSION[ 'cart' ] ;
        else {
            return [ ] ;
        }
    }

}
