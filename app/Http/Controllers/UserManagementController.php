<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function adminManagementPage ($id)
    {
        $data = User::where('role', 'admin')->orderBy('id', 'desc')->get();
        return view('admin.userManagement.adminManagement', compact('data'));
    }









}
