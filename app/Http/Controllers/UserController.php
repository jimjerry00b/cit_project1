<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{

    protected UserService $service;

    function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $users = $this->service->getUsers();
            return view('admin.all_users', compact('users'));
        } catch (Exception $e) {
            return abort($e->getCode(), $e->getMessage());
        }
    }


    public function create()
    {
        return view('admin.create');
    }


    public function store(UserRequest $request)
    {
        $data = $request->all();
    
        try {
            $this->service->createNewUser($request->all());
            return redirect()->route('user.index')->with('success', 'Successfully added.');
        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Something was wrong.');
        }
    }


    public function show(User $user)
    {
        // return with user
    }


    public function edit(User $user)
    {
        return view('admin.edit', compact('user'));
    }


    public function update(UserRequest $request, User $user)
    {

        try {
            $this->service->updateUser($request->validated(), $user);
            return redirect()->route('user.index')->with('success', 'Modified');
        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Something was wrong.');
        }
    }


    public function destroy(User $user)
    {
        $this->service->deleteUser($user);
        return redirect()->route('user.index')->with('success', 'Deleted');
    }
}
