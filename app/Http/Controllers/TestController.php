<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\Mail;


class TestController extends Controller
{
    public function index()
    {
        return view('test');
    }
    public function store(Request $request)
    {
        Mail::to('raymartnayreitanong11@gmail.com')->send(new EmailVerificationMail());
    }
}
