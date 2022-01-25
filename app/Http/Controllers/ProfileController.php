<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }

    public function create(){
        return view("profile.create");
    }

    public function store(Request $request){
        $this->validate($request, [
            "firstname" => "required|max:25",
            "lastname" => "required|max:25"
        ]);
        $data = $request->all();
        Profile::updateOrCreate(
            [
                "user_id" => auth()->user()->id
            ],
            [
                "firstname" => $data['firstname'],
                "middlename" => $data['middlename'],
                "lastname" => $data['lastname']
            ]
        );

    }
}
