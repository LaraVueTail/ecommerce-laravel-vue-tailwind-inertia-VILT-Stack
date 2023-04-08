<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
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
                'users' => User::query()
                    ->when(
                        Request::input('search') ?? false,
                        fn($query, $search) =>
                                    $query
                                        ->where('email', 'like', "%{$search}%")
                                        ->orWhere('first_name', 'like', "%{$search}%")
                                        ->orWhere('last_name', 'like', "%{$search}%")
                                        ->orWhere('phone_number', '=', $search)
                                        ->orWhere('id', '=', $search)
                                
                    )
                                
                    ->when(Request::input('dateStart') ?? false, function ($query, $dateStart) {
                            // dd($dateStart);
                            $dateStart = Carbon::createFromFormat('m/d/Y', $dateStart)->format('Y-m-d');
                            $query->whereDate('created_at', '>=', $dateStart);
                        }
                    )
                    ->when(
                        Request::input('dateEnd') ?? false,
                        function ($query, $dateEnd) {
                            // dd($dateEnd);
                            $dateEnd = Carbon::createFromFormat('m/d/Y', $dateEnd)->format('Y-m-d');
                            $query->whereDate('created_at', '<=', $dateEnd);
                        }
                    )
                    ->when(
                        Request::input('sortBy') ?? 'default',
                        function ($query, $sortBy) {
                            // dd($dateStart)
                            if ($sortBy === 'date-dsc') {
                                $query->latest();
                            }
                            if ($sortBy === 'date-asc') {
                                $query->oldest();
                            }
                            if ($sortBy === 'price-dsc') {
                                $query->orderBy('price', 'desc');
                            }
                            if ($sortBy === 'price-asc') {
                                $query->orderBy('price', 'asc');
                            }
                            if ($sortBy === 'inventory-asc') {
                                $query->orderBy('inventory', 'asc');
                            }
                            if ($sortBy === 'inventory-dsc') {
                                $query->orderBy('inventory', 'dsc');
                            }
                            if ($sortBy === 'default') {
                                $query->latest();
                            }
                        }
                    )
                    // ->when(true,fn($query)=>
                    //     $query->latest())
                    ->paginate(10)
                    ->withQueryString(),
                'filters' => Request::only(['search', 'dateStart', 'dateEnd'])
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

    public function store()
    {


        $attributes = $this->validateUser();
        $avatar = $attributes['avatar'][0];
        User::create(array_merge($this->validateUser(), [
            'avatar' => $avatar->storeAs('images/users/'.$attributes['email'].'/avatar','avatar.'.$avatar->extension()),
        ]));
        return redirect('/admin-dashboard/users')->with('success', 'User Created!');
    }

    public function edit(User $user)
    {
        // $user->avatar = asset($user->avatar);

        return Inertia::render('AdminDashboard/Users/Edit', [
            'user' => $user
        ]);

    }

    public function update(User $user)
    {

        $attributes = $this->validateUser($user);
        if (request()->file('avatar')[0] ?? false) {
            $avatar = request()->file('avatar')[0];
            Storage::delete($user->avatar);
            $attributes['avatar'] = $avatar->storeAs('images/users/'.$user['email'].'/avatar','avatar.'.$avatar->extension());
        }
        if($user->email !== $attributes['email']){
            Storage::move('images/users/'.$user['email'].'/avatar', 'images/users/'.$attributes['email'].'/avatar');
            $attributes['avatar'] = array_key_exists("avatar",$attributes) ? str_replace($user['email'],$attributes['email'],$attributes['avatar']): str_replace($user['email'],$attributes['email'],$user['avatar']);
            Storage::deleteDirectory('images/users/'.$user['email']);
        }

        $user->update($attributes);

        return back()->with('success', 'User Updated!');
    }


    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/admin-dashboard/users')->with('success', 'User Deleted!');
    }

    protected function validateUser(?User $user = null): array
    {
        $user ??= new User();

        return request()->validate([
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|max:50',
            'avatar' => $user->exists ? 'nullable' : 'required',
            'avatar.*' => 'required|mimes:jpeg,png |max:2096',
            'email' => ['required','email', Rule::unique('users', 'email')->ignore($user)],
            'gender' => 'nullable',
            'birthday' => 'required',
            'phone_number' => 'required',
            'password' => (request()->input('password') ?? false || !$user->exists ) ? 'required|confirmed|min:6': 'nullable',
        ],[
            'avatar.required' => 'Add a profile picture',
            'avatar.*.mimes' => 'Upload Profile image as jpg/png format with size less than 2MB',
            'avatar.*.max' => 'Upload Profile image with size less than 2MB',
        ]);
    }



}