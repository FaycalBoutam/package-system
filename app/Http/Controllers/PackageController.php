<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PackageResource;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\PackageStoreRequest;

class PackageController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 0 || Auth::user()->role == 1) {
            $packages = PackageResource::collection(Package::with('user')->paginate(8));
        } else {
            $packages = PackageResource::collection(
                Package::
                    with('user')
                    ->where('user_id', '=', Auth::user()->id)
                    ->paginate(8)
            );
        }
        
        return Inertia::render('Package/Index', [
            'packages' => $packages, 
            'user_role' => Auth::user()->role
        ]);
    }

    public function create()
    {
        $this->authorize('isStaff', User::class);

        $users = User::all();
        $users = $users->pluck('apartment', 'id');
        return Inertia::render('Package/Create', ['users' => $users]);
    }

    public function store(PackageStoreRequest $request)
    {
        $this->authorize('isStaff', User::class);

        $package = Package::create($request->validated());

        return redirect(RouteServiceProvider::HOME);
    }

    public function edit(Package $package)
    {
        $this->authorize('isStaff', User::class);

        $users = User::all();
        $users = $users->pluck('apartment', 'id');

        return Inertia::render('Package/Edit', [
            'pack' => $package,
            'users' => $users
        ]);
    }

    public function update(PackageStoreRequest $request, Package $package)
    {
        $this->authorize('isStaff', User::class);

        $package->update($request->validated());

        return redirect(RouteServiceProvider::HOME);
    }

    public function destroy(Package $package)
    {
        $this->authorize('isAdmin', User::class);

        $package->delete();

        return redirect(RouteServiceProvider::HOME);
    }

}
