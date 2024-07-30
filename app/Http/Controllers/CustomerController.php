<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function settingPage()
    {
        return view('user.setting');
    }


    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'unique:users,name,' . User::where('id', $request->id)->value('id')],
            'email' => ['required', 'unique:users,email,' . User::where('id', $request->id)->value('id')],
            'phone' => ['required'],
            'address' => ['required']
        ])->validate();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ];

        if ($request->new_image == 'yes') {
            Validator::make($request->all(), [
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048']
            ])->validate();

            $file_name = $this->storeImage($request);
            $data['image'] = $file_name;
            User::where('id', $request->id)->update($data);
        }

        if ($request->new_image == 'no' || $request->new_image == null) {
            User::where('id', $request->id)->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address']
            ]);
        }

        logger()->info('status', [
            'status' => 'Success'
        ]);

        return redirect()->route('user#setting');
    }


    public function deleteAccount($id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('home');
    }


    public function changePasswordPage()
    {
        return view('user.changePassword');
    }

    public function changePasswordSave(Request $request)
    {
        Validator::make($request->all(), [
            'old_password' => ['required', 'min:6', 'max:10'],
            'new_password' => ['required', 'min:6', 'max:10'],
            'confirm_password' => ['required', 'min:6', 'max:10', 'same:new_password']
        ])->validate();

        $user = User::where('id', $request->id)->first();
        $db_old_password = $user->password;
        if (Hash::check($request->old_password, $db_old_password)) {
            $user->update(['password' => Hash::make($request->new_password)]);
            return redirect()->route('user#setting')->with(['password_change_message' => 'Password changed successfully!']);
        } else {
            return back()->with(['password_change_fail' => 'The old password is incorrect']);
        }
    }






    public function storeImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $old_image = User::where('id', $request->id)->value('image');
            if ($old_image != null) {
                Storage::delete('public/' . $old_image);
            }
            $file_name = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $file_name);
            return $file_name;
        } else
            return null;
    }
}
