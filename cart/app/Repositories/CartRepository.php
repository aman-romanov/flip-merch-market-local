<?php
namespace App\Repositories;

use App\Models\CartItem;

class CartRepository{
    public function create($data){
        return CartItem::create($data);
    }

    public function update($id, $data){
        return CartItem::where('id', $id)->update($data);
    }

    public function delete($id){
        return CartItem::where('id', $id)->delete();
    }

    public function getByUserId($userId){
        return CartItem::where('user_id', $userId)->get();
    }
}
