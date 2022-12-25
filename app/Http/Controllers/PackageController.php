<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function create()
    {
        $users = User::get()->toArray();
        return Inertia::render('Package/Create', ['users' => $users]);
    }

    public function store(Request $request)
    {
        
    }
}
