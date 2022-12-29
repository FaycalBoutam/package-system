<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;

class AdminController extends Controller
{
    public function index()
    {
        $loggedInRole = Auth::user()->role;

        if ($loggedInRole != 0) {
            return;
        }

        $users = User::paginate(8);
        
        return Inertia::render('Admin/Index', [
            'users' => $users,
            'loggedInRole' => $loggedInRole
        ]);
    }

    public function edit($id)
    {
        $this->authorize('isAdmin', User::class);

        $loggedInRole = Auth::user()->role;

        $user = User::where('id', '=', $id)->first();

        return Inertia::render('Admin/EditUser', [
            'user' => $user,
            'loggedInRole' => $loggedInRole
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('isAdmin', User::class);

        $user = User::where('id', '=', $id)->first();

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'apartment' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'role' => 'required|integer',
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'password' => 'string|min:6|max:255',
        ]);

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'apartment' => $request->apartment,
            'email' => $request->email,
            'role' => $request->role,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'User is updated.');
    }
}
