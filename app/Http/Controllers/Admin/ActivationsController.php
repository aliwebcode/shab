<?php

namespace App\Http\Controllers\Admin;

use App\Activation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivationsController extends Controller
{
    public function index() {
        $activations = Activation::latest()->get();
        return view('admin.activations.index', compact('activations'));
    }
    public function show($id) {
        $activation = Activation::find($id);
        if(!$activation) return redirect()->route('admin.activations.index');
        return view('admin.activations.show', compact('activation'));
    }
    public function change_status(Request $request) {
        $activation = Activation::find($request->id);
        if(!$activation) return redirect()->back();
        $activation->approved = $request->status;
        $activation->save();
        return redirect()->back()->with('msg', 'تم حفظ التغييرات');
    }
}
