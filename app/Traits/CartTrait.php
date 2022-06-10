<?php
namespace App\Traits;

use App\Services\Cart;

trait CartTrait {
    public function getContentCart(){
        $cart = new Cart;
        return $cart->getContent()()->sortBy('name');
    }
    public function getTotalCart(){
        $cart = new Cart;
        return $cart->totalAmount();
    }
    public function countInCart($id){
        $cart = new Cart;
        return $cart->countInCart($id);
    }
    public function getItemsCart(){
        $cart = new Cart;
        return $cart->totalItems();
    }
    public function updateQtyCart($product, $cant = 1){
        $cart = new Cart;
        $cart->updateQuantity($product->id, $cant);
        $this->noty('Cantidad Actualizada');
    }
    public function addProductCart($product, $cant = 1, $changes = ''){
        $cart = new Cart;
        if($cart->existsInCart($product->id)){
            $cart->addProduct($product, $cant, $changes);
            $this->noty('Cantidad Actualizada');
        }else{
            $cart->addProduct($product, $cant, $changes);
            $this->noty('Producto Agregad');
        }
    }
    public function inCart($id){
        $cart = new Cart;
        return $cart->existsInCart($id);
    }
    public function replaceQuantityCart($id,$cant = 1){
        $cart = new Cart;
        $cart->replaceQuantity($id,$cant);
    }
    public function decreaseQtyCart($id){
        $cart = new Cart;
        $cart->decreaseQuantity($id);
        $this->noty('Cantidad Actualizada');
    }    
    public function removeProductCart($id){
        $cart = new Cart;
        $cart->removeProduct($id);
    }
    public function addChangesProduct($id, $changes){
        $cart = new Cart;
        $cart->addChanges($id, $changes);
    }
    public function clearCart(){
        $cart = new Cart;
        $cart->clear();
    }
}