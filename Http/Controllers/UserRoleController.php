<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kunden;

class UserRoleController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
    }
    

    public function index()
    {
        if (auth()->user()->role === "admin") {
            return redirect()->route("admin.dashboard");
        } elseif (auth()->user()->role === "seller") {
            return redirect()->route("ukunden.listing");
        } elseif (auth()->user()->role === "freelancer") {
            return redirect()->route("freelancer.dashboard");
        } else {
            return redirect()
                ->route("/")
                ->with("error", "Email and password are wrong");
        }
    }


    public function changeStatus(Request $request)
    {
        $user = User::find($request->user_id);

        $user->status = $request->status;

        $user->save();

        return response()->json(["success" => "Status change successfully."]);
    }


    public function adminDashboard()
    {
        return view("backend.admin.index");
    }


    public function adminProfile()
    {
        return view("backend.admin.profile");
    }


    public function sellerDashboard()
    {
        return view("backend.seller.index");
    }


    public function sellerProfile()
    {
        return view("backend.seller.profile");
    }


    public function freelancerDashboard()
    {
        return view("backend.freelancer.index");
    }


    // Auth logout
    public function logout(Request $request)
    {
        $request->session()->invalidate(); 
        return redirect("/")->with(Auth::logout());
         return redirect('login')->with(Auth::logout());
    }
}
