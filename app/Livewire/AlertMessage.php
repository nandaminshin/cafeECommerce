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
    public $user_password_change_message;
    public $user_password_change_fail;
    public $removed_name;
    public $admin_remove_message;
    public $admin_remove_fail;
    public $admin_add_message;
    public $admin_add_fail;
    public $admin_already_exists;
    public $admin_account_delete_fail;
    public $user_account_delete_fail;
    public $order_remove_message;
    public $order_does_not_exist;
    public $order_confirm_message;
    public $order_deny_message;
    public $blog_create_message;
    public $blog_update_message;
    public $blog_remove_message;

    public function mount()
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
        $this->user_password_change_message = session()->get('user_password_change_message');
        $this->user_password_change_fail = session()->get('user_password_change_fail');
        $this->admin_remove_message = session()->get('admin_remove_message');
        $this->removed_name = session()->get('removed_name');
        $this->admin_remove_fail = session()->get('admin_remove_fail');
        $this->admin_add_message = session()->get('admin_add_message');
        $this->admin_add_fail = session()->get('admin_add_fail');
        $this->admin_already_exists = session()->get('admin_already_exists');
        $this->admin_account_delete_fail = session()->get('admin_account_delete_fail');
        $this->user_account_delete_fail = session()->get('user_account_delete_fail');
        $this->order_remove_message = session()->get('order_remove_message');
        $this->order_does_not_exist = session()->get('order_does_not_exist');
        $this->order_confirm_message = session()->get('order_confirm_message');
        $this->order_deny_message = session()->get('order_deny_message');
        $this->blog_create_message = session()->get('blog_create_message');
        $this->blog_update_message = session()->get('blog_update_message');
        $this->blog_remove_message = session()->get('blog_remove_message');


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
        session()->forget('user_password_change_message');
        session()->forget('user_password_change_fail');
        session()->forget('admin_remove_message');
        session()->forget('removed_name');
        session()->forget('admin_remove_fail');
        session()->forget('admin_add_message');
        session()->forget('admin_add_fail');
        session()->forget('admin_already_exists');
        session()->forget('admin_account_delete_fail');
        session()->forget('user_account_delete_fail');
        session()->forget('order_remvoe_message');
        session()->forget('order_does_not_exist');
        session()->forget('order_confirm_message');
        session()->forget('order_deny_message');
        session()->forget('blog_create_message');
        session()->forget('blog_update_message');
        session()->forget('blog_remove_message');
    }

    public function render()
    {
        return view('livewire.alertMessage');
    }
}
