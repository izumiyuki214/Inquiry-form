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
        $category = Category::find($contact['category_id']);
        return view('confirm', compact('contact', 'category'));
    }

    public function store(Request $request)
    {   
        // 修正を押した場合
        if ($request->has('back')) {
            return redirect()
                ->route('contact')
                ->withInput();
        }

        $contact = $request->only(['category_id', 'first_name','last_name','gender' , 'email', 'tel', 'address', 'building', 'detail']);
        Contact::create($contact);
        return view('thanks');

    }
}
