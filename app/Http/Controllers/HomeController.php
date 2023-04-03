<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\SendMail;
use Mail;
use App\Models\User;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        $data = Template::select('name', 'subject', 'body')->where('user_id', $request->session()->get('user')->id)->get();
        return view('bulk_email', ['templates' => $data]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'templatename' => 'required|unique:templates,name',
            'subject' => 'required',
            'body' => 'required'
        ]);

        Template::create([
            'name' => $request->templatename,
            'subject' => $request->subject,
            'body' => $request->body,
            'user_id' => $request->session()->get('user')->id
        ]);

        Alert::toast('Successfully Added', 'success');
        return redirect()->back();
    }

    public function sendMail(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'body' => 'required'
        ]);

        $users = User::select('email','name')->where('id', '!=', $request->session()->get('user')->id)->get();
        foreach ($users as $user) {
            Mail::to($user->email)->queue(new SendMail($request->subject, $request->body, $user));
        }
        Alert::toast('Mail Sent Successfully', 'success');
        return redirect()->back();
    }
}