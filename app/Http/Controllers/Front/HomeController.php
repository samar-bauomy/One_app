<?php

namespace App\Http\Controllers\Front;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('home');

    }

    public function user_locations($user_name)
    {
        $provider = User::where('user_name', $user_name)->first();

        $locations = Location::where('provider_id', $provider->id)->get();

        return view('user_locations', compact('provider', 'locations'));
    }
}
