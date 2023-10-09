<?php
namespace App\Http\Controllers;
use App\Models\Phone;
use App\Models\Contact;
use Illuminate\Http\Request;
class PhoneController extends Controller
{
    public function create() 
    {
        return view('contacts.phone');
    }
    public function store(Request $request)
    {
        $contactlist = new Contact;
        $request->validate([
            'addMoreInputFields.*.phonelist' => 'required'
        ]);
        foreach ($request->addMoreInputFields as $key => $value) {
            $contactlist->phone[$value];  
            $contactlist->save();
        }
        return back()->with('success', 'New Numbers has been added.');
    }
}