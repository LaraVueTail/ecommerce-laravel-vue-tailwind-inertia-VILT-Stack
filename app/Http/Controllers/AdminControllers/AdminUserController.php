<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\FileManagement;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;
use Mockery\Undefined;

class AdminUserController extends Controller
{
    //
    public function index()
    {
        return Inertia::render(
            'AdminDashboard/Users/Index',
            [
                'users' => User::filter(
                    request(['search','dateStart','dateEnd','sortBy']))
                    ->paginate(10)->withQueryString(),
                'filters' => Request::only(['search', 'dateStart', 'dateEnd','sortBy'])
            ]
        );

    }

    public function show(User $user)
    {

        return Inertia::render('AdminDashboard/Users/Show', [
            'user' => $user
        ]);

    }

    public function create()
    {

        return Inertia::render('AdminDashboard/Users/Create');

    }

    public function store(FileManagement $fileManagement)
    {
        // dd(request()->all());

        
        $attributes = $this->validateUser();
        if($attributes['avatar'] ?? false){
            $attributes['avatar'] = 
            $fileManagement->uploadFile(
                file:$attributes['avatar'] ?? false,
                path:'images/users/'.$attributes['email'].'/avatar',
                storeAsName:'avatar'
            );
        }

        User::create($attributes);

        return redirect('/admin-dashboard/users')->with('success', 'User Created!');
    }

    public function edit(User $user)
    {

        return Inertia::render('AdminDashboard/Users/Edit', [
            'user' => $user
        ]);

    }

    public function update(User $user, FileManagement $fileManagement)
    {
        $attributes = $this->validateUser($user);

        if($attributes['avatar'] ?? false) {
            $attributes['avatar'] = 
            $fileManagement->uploadFile(
                file:$attributes['avatar'] ?? false,
                deleteOldFile: true, 
                oldFile: $user->avatar,
                path:'images/users/'.($user['email'] !== $attributes['email'] ? $attributes['email'] : $user['email']).'/avatar',
                storeAsName: 'avatar'
            );  
        }

        if($user['email'] !== $attributes['email']){
            $fileManagement->moveFiles(
                oldPath:'images/users/'.$user['email'].'/avatar',
                newPath:'images/users/'.$attributes['email'].'/avatar',
                deleteDirectory: 'images/users/'.$user['email']
            );
            $attributes['avatar'] = str_replace($user['email'],$attributes['email'],$user['avatar']);
        }

        $user->update($attributes);

        return back()->with('success', 'User Updated!');
    }


    public function destroy(User $user)
    {
        $user->delete();
        Storage::deleteDirectory('images/users/'.$user['email']);

        return redirect('/admin-dashboard/users')->with('success', 'User Deleted!');
    }

    protected function validateUser(?User $user = null): array
    {
        $user ??= new User();

        return request()->validate([
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|max:50',
            'avatar' => 'nullable|mimes:jpeg,png |max:2096',
            'email' => ['required','email', Rule::unique('users', 'email')->ignore($user)],
            'gender' => 'nullable',
            'birthday' => 'required',
            'phone_number' => 'required',
            'password' => (request()->input('password') ?? false || !$user->exists ) ? 'required|confirmed|min:6': 'nullable',
            'address_line_1' => 'nullable',
            'address_line_2' => 'nullable',
            'city' => 'nullable',
            'pin_code' => 'nullable',
            'country' => 'nullable',
            'tac'=>'required|accepted'

        ],[
            'avatar' => 'Upload Profile image as jpg/png format with size less than 2MB',
        ]);
    }



}