<?php
namespace App\Services;


use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class Cart {
    protected Collection $cart;

    public function __construct(){
        if(session()->has('cart')){
            $this->cart = session('cart');
        }else{
            $this->cart = new Collection;
        }
    }

    public function getContent(): Collection{
        return $this->cart->sorBy(['name',['name','asc']]);
    }

    protected function save(): void{
        session()->put('cart', $this->cart);
        session()->save();
    }

    public function addProduct($product, $cant = 1, $change = 0): void{
        $pre = Arr::add($product, 'qty', $cant);
        $this->validate($pre);
        $this->cart->push($pre);
        $this->save();
    }

    public function addChanges($id, $changes){
        $mycart = $this->getContent();
        $oldItem = $mycart->where('id',$id)->first();
        $newItem = $oldItem;
        $newItem->changes = $changes;

        $this->removeProduct($newItem);
        $this->addProduct($newItem);
    }

    public function existsInCart($id): bool{
        $mycart = $this->getContent();
        $cont = $mycart->where('id', $id)->count();
        $res = $cont > 0 ? true : false;

        return $res;
    }

    public function countInCart($id): int{
        $mycart = $this->getContent();
        $cont = $mycart->where('id', $id)->sum('qty');
        return $cont;
    }
    public function updateQuantity($id, $cant = 1){
        $mycart = $this->getContent();
        $oldItem = $mycart->where('id', $id)->first();
        $newItem = $oldItem;
        $newItem->qty += $cant;

        $this->removeProduct($id);
        $this->addProduct($newItem);
    }
    public function decreaseQuantity($id, $cant = 1 ){
        $mycart = $this->getContent();
        $oldItem = $mycart->where('id', $id)->first();
        $newItem = $oldItem;
        $newItem->qty -= $cant;

        $this->removeProduct($id);
        if($newItem->qty > 0) $this->addProduct($newItem);
    }
    public function replaceQuantity($id, $cant = 1): void{
        $mycart = $this->getContent();
        $oldItem = $mycart->where('id', $id)->first();
        $newItem = $oldItem;
        $newItem->qty = $cant;
        $this->validate($newItem);

        $this->removeProduct($id);
        $this->addProduct($newItem);
    }
    public function removeProduct($id): void{
        $this->cart = $this->cart->reject(function(Product $product) use ($id){
            return $product->id === $id;
        });
        $this->save();
    }
    public function totalAmount(){
        $amount = $this->cart->sum(function ($product) {
            return ($product->price * $product->qty);
        });
        return $amount;
    }
    public function hasProducts(): int{
        return $this->cart->count();
    }
    public function totalItems(): int{
        $items = $this->cart->sum(function ($product){
            return $product->qty;
        });
        return $items;
    }
    public function removeChanges($id){
        $mycart = $this->getContent();
        $oldItem = $mycart->where('id',$id)->first();
        $newItem = $oldItem;
        $newItem->changes = '';

        $this->removeProduct($id);
        $this->addProduct($newItem);
    }
    public function clear(){
        $this->cart = new Collection;
        $this->save();
    }
    protected function validate($item){
        $validator = Validator::make($item->toArray(),[
            'id' => 'required',
            'precio' => 'required|numeric',
            'qty' => 'required|numeric|min:1',
            'name' => 'required'
        ]);
        if($validator->fails()){
            throw new \ErrorException($validator->messages());
        }
        return $item;
    }
}