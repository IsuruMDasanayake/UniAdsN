<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function profile(){
        return view('frontend.profile');
    }

    public function feed(){
        return view('frontend.feed.feed');
    }

    public function institutions(){
        return view('frontend.institutions.institutions');
    }
    public function showInstitutions()
{
    $approvedInstitutes = Institute::where('status', 'approved')->get();
    return view('frontend.institutions.institutions', compact('approvedInstitutes'));
}


    public function courses(){
        return view('frontend.courses.courses');
    }

    public function courselist(){
        return view('frontend.courses.courselist');
    }

    
}

