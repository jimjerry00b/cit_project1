<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserService
{
    const SWW = "Something was wrong.";

    function getUsers()
    {
        try {
            return User::select('id', 'name', 'email', 'profile_photo_path')->paginate(10);
        } catch (Exception $e) {
            throw new Exception(self::SWW, $e->getCode());
        }
    }

    function createNewUser($data)
    {
        $file = $data['profile_photo_path'];
        // return $file->getClientOriginalName();

        $image = null;
        
        //Checking the photo is exists or not

        if ($file->isValid()) {
            $image = $this->fileUpload($file);
        }
        
        
        User::create([
            'name'                  => $data['name'],
            'email'                 => $data['email'],
            'password'              => bcrypt($data['password']),
            'profile_photo_path'    => $image,
        ]);
    }

    function updateUser($data, $user)
    {
        $file = $data['profile_photo_path'];

        if ($file->isValid()) {

            $data['profile_photo_path'] = $this->fileUpload($file);

            if (file_exists($user['profile_photo_path'])) {
                unlink($user['profile_photo_path']);
            }
        }

        if ($data['old_password']) {
            if (Hash::check($data['old_password'], $user->password)) {
                $data['password'] = Hash::make($data['password']);
            } else {
                return redirect()->back()->with('error', 'Password not match');
            }
        }

        if (isset($data['password'])) {
            // Update the password and other fields
            $user->update($data);
        } else {
            // Update other fields, but not the password
            $user->update(collect($data)->except('password')->toArray());
        }
    }

    function deleteUser($user)
    {
        if (file_exists($user['profile_photo_path'])) {
            unlink($user['profile_photo_path']);
        }
        $user->delete();
    }

    function fileUpload($file)
    {
        
        $destinationPath = 'storage/images/users/';
        $filename = $destinationPath . time() . $file->getClientOriginalName();
        $file->move($destinationPath, $filename);


        return $filename;
    }
}
