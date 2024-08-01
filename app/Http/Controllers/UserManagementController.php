<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function adminManagementPage($id)
    {
        // Fetch the current authenticated user
        $currentUser = User::find($id);

        // Fetch other admins excluding the current authenticated user
        $otherAdmins = User::where('role', 'admin')
            ->where('id', '!=', $id)
            ->orderBy('id', 'desc')
            ->get();

        // Merge the current user at the top of other admins
        $data = collect([$currentUser])->merge($otherAdmins);

        return view('admin.userManagement.adminManagement', compact('data'));
    }


    public function removeAdmin(Request $request, $id, $current_admin_id)
    {
        $user = User::where('id', $id)->first();
        $current_admin = User::where('id', $current_admin_id)->first();
        if (Hash::check($request->password, $current_admin->password)) {
            $user->update([
                'role' => 'user'
            ]);

            return redirect()->route('admin#admin_management_page', $current_admin_id)->with(['removed_name' => $user->name, 'admin_remove_message' => ' has been removed successfully.']);
        } else {
            return redirect()->route('admin#admin_management_page', $current_admin_id)->with(['admin_remove_fail' => 'Failed to remove! Wrong password.']);
        }
    }


    public function addAdminPage()
    {
        return view('admin.userManagement.addNewAdmin');
    }


    public function addAdminSave($id, Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user->role == 'admin') {
                return redirect()->route('admin#add_new_admin')->with(['admin_already_exists' => 'Admin already exists']);
            } else {
                $user->update([
                    'role' => 'admin'
                ]);
                return redirect()->route('admin#admin_management_page', $id)->with(['admin_add_message' => 'A new admin added successfully']);
            }
        } else {
            return redirect()->route('admin#add_new_admin')->with(['admin_add_fail' => 'Failed to add new admin. Invalid email.']);
        }
    }


    public function adminDetailPage($id)
    {
        $data = User::where('id', $id)->first();
        return view('admin.userManagement.adminDetail', compact('data'));
    }



    public function userManagementPage()
    {
        $data = User::when(request('key'), function ($query) {
            $query->where('name', 'like', '%' . request('key') . '%');
        })->where('role', '=', 'user')->orderBy('created_at', 'desc')->paginate(10);
        $data->appends(request()->all());

        return view('admin.userManagement.userManagement', compact('data'));
    }

    public function userDetailPage($id)
    {
        $data = User::where('id', $id)->first();
        return view('admin.userManagement.userDetail', compact('data'));
    }
}
