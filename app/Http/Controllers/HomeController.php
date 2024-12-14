<?php

namespace App\Http\Controllers;

use App\Services\Models\User\UserService;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return (new UserService())->redirectToPanel();
    }

    public function register()
    {
        return view('dashboard.pages.register');
    }
}
