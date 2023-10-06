<?php

namespace App\Http\Controllers;
use App\Models\Contact;


use Illuminate\Http\Request;

use DB;

class ContactController extends Controller
{

    public function search_data(Request $request)
    {
        $data = $request->input('search');

        $contacts= DB::table('contacts')->where('name','like','%'. $data . '%')->
        orWhere('email','like','%'. $data . '%')->orWhere('phone','like','%'. $data . '%')
        ->get();
        return view('contacts.index',compact('contacts'));
        
    }

    public function index()
    {
        return view('contacts.index',['contacts'=>Contact::latest()->get()]);
    }

    public function create()
    {
        return view('contacts.create');
    }
    public function store(Request $request)
    {
        // $request->validate([
        //     'moreFields.*.phone' => 'required'
        // ]);
     
        // foreach ($request->moreFields as $key => $value) {
        //     Contact::create($value);
        // }
     
        // return back()->with('success', 'New Contact has been added.');

        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Contact::class],
            'phone' => ['required'],
            'notes' => ['required','max:256']]);
        $contact = new Contact;
        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->phone=$request->phone;
        $contact->notes=$request->notes;

        $contact->save();
        return back()->withSuccess('Contact is created'); 

    }

    public function edit($id)
    {
        $contact = Contact::where('id',$id)->first();
        return view('contacts.edit',['contact'=>$contact]);
    }

    public function update(Request $request,$id)
    {


        
        
        $contact=Contact::where('id',$id)->first();

        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->phone=$request->phone;
        $contact->notes=$request->notes;

        $contact->save();
        return back()->withSuccess('Contact is Updated');

    }

    public function destroy($id)
    {
        $contact=Contact::where('id',$id)->first();
        $contact->delete();
        
        return back()->withSuccess('Contact is Deleted');
    }
    public function show($id)
    {
        $contact=Contact::where('id',$id)->first();
        
        return view('contacts.show',['contact'=>$contact]);
    }
}