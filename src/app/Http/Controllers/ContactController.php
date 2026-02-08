<?php

namespace App\Http\Controllers;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('contact', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['category_id', 'first_name','last_name','gender' , 'email', 'address', 'building', 'detail']);
        $tel = $request->tel1 . $request->tel2 . $request->tel3;
        $contact['tel'] = $tel;
        return view('confirm', compact('contact'));
    }
}
