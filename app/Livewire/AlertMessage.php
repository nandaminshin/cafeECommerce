<?php

namespace App\Livewire;

use Livewire\Component;

class AlertMessage extends Component
{

    public $category_create_message;
    public $created_category_name;
    public $category_update_message;
    public $updated_category_name;
    public $category_delete_message;
    public $deleted_category_name;
    public $product_create_message;
    public $created_product_name;
    public $created_product_category;
    public $product_update_message;
    public $updated_product_name;
    public $product_delete_message;
    public $deleted_product_name;
    public $password_change_message;
    public $password_change_fail;

    public function mount ()
    {
        $this->category_create_message = session()->get('category_create_message');
        $this->created_category_name = session()->get('created_category_name');
        $this->category_update_message = session()->get('category_update_message');
        $this->updated_category_name = session()->get('updated_category_name');
        $this->category_delete_message = session()->get('category_delete_message');
        $this->deleted_category_name = session()->get('deleted_category_name');
        $this->product_create_message = session()->get('product_create_message');
        $this->created_product_name = session()->get('created_product_name');
        $this->created_product_category = session()->get('created_product_category');
        $this->product_update_message = session()->get('product_update_message');
        $this->updated_product_name = session()->get('updated_product_name');
        $this->product_delete_message = session()->get('product_delete_message');
        $this->deleted_product_name = session()->get('deleted_product_name');
        $this->password_change_message = session()->get('password_change_message');
        $this->password_change_fail = session()->get('password_change_fail');


        session()->forget('category_create_message');
        session()->forget('created_category_name');
        session()->forget('category_update_message');
        session()->forget('updated_category_name');
        session()->forget('category_delete_message');
        session()->forget('deleted_category_name');
        session()->forget('product_create_message');
        session()->forget('created_product_name');
        session()->forget('created_product_category');
        session()->forget('product_update_message');
        session()->forget('updated_product_name');
        session()->forget('product_delete_message');
        session()->forget('deleted_product_name');
        session()->forget('password_change_message');
        session()->forget('password_change_fail');
    }

    public function render()
    {
        return view('livewire.alertMessage');
    }
}
