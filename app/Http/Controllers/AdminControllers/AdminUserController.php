<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;

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
                    ->when(true,fn($query)=>
                        $query->latest())
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
        User::create(array_merge($this->validateProduct(), [
            'profile_pic' => request()->file('profile_pic')->store('images/users/'.$attributes['email'].'/profile_pic'),
        ]));

        User::create($attributes);

        return redirect('/admin-dashboard/users')->with('success', 'User Created!');
    }

    public function edit(User $user)
    {

        return Inertia::render('AdminDashboard/Users/Edit', [
            'user' => $user
        ]);

    }

    public function update(User $user)
    {

        $attributes = $this->validateUser($user);

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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'gender' => 'nullable',
            'birthday' => 'required',
            'phone_number' => 'required',
            'password' => 'required',
        ]);
    }



}