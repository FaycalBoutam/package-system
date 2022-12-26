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
            $packages = PackageResource::collection(Package::with('user')->get());
        } else {
            $packages = PackageResource::collection(
                Package::
                    with('user')
                    ->where('user_id', '=', Auth::user()->id)
                    ->get()
            );
        }
        
        return Inertia::render('Package/Index', ['packages' => $packages]);
    }

    public function create()
    {
        $this->authorize('can_edit_packages', User::class);

        $users = User::all();
        $users = $users->pluck('apartment', 'id');
        return Inertia::render('Package/Create', ['users' => $users]);
    }

    public function store(PackageStoreRequest $request)
    {
        $this->authorize('can_edit_packages', User::class);

        $package = Package::create($request->validated());

        return redirect(RouteServiceProvider::HOME);
    }
}
