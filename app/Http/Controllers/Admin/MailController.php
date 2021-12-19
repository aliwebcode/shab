<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function index() {
        $mails = Mail::all();
        return view('admin.mail.index',compact('mails'));
    }
    public function add() {
        return view('admin.mail.add');
    }
    public function save(Request $request) {
        $mail = new Mail();
        $mail->title = $request->title;
        $mail->message = $request->message;
        $mail->save();
        return redirect()->back()->with('msg','تم إضافة البريد بنجاح');
    }
    public function delete(Request $request) {
        $mail = Mail::find($request->mail_id);
        if(!$mail) {
            return redirect()->route('admin.mail.index');
        }
        $mail->delete();
        return redirect()->back()->with('msg','تم الحذف بنجاح');
    }
}
