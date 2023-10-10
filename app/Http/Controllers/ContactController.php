<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use App\Models\Phone;


use Illuminate\Http\Request;

use DB;
use Symfony\Component\Console\Input\Input;

class ContactController extends Controller
{

    public function search_data(Request $request)
    {
        $data = $request->input('search');

        $contacts= DB::table('contacts')->where('name','like','%'. $data . '%')->
        orWhere('email','like','%'. $data . '%')->orWhere('number','like','%'. $data . '%')
        ->get();
        return view('contacts.index',compact('contacts'));
        
    }

    public function index()
    {
        
        return view('contacts.index',['contacts'=>Contact::latest()->get()],['phones'=>Phone::latest()->get()]);
    }

    public function create()
    {
        return view('contacts.create');
    }
    public function store(Request $request)
    {
        $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Contact::class],
        'inputs.*.number'=>['required'],['inputs.*.number' => 'The name field is required'],
        'notes' => ['required','max:256']
        ]);

        $contact = new Contact;
        $contact->phone->create($request->only('number'));

        $request->contact()->create([
            'name' => $request->name,
            'email' => $request->email,
            'notes' => $request->notes
        ]);

        $request->contact()->phone()->create([
            'number' => $request->number,
            
        ]);
        
        // Remove empty strings in phone_restrictions array, remove repeated numbers
        if (!empty($contact['number'])) {
            $contact['number'] = array_filter($contact['number'], static function ($item) {
                return !empty($item);
            });
            $contact['number'] = array_unique($contact['number']);
        }

        $contact->name=$request->name;
        $contact->email=$request->email;
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