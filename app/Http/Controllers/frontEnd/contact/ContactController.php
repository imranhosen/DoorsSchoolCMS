<?php

namespace App\Http\Controllers\frontEnd\contact;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contactIndex()
    {
        return view('frontend.contact_us.contact-index');
    }

    public function contactSave(Request $request)
    {
        //dd($request->all());
        if ($request->phone) {
            if (!is_numeric($request->phone)) {
                return back()->with(['error' => "Mobile number must be a valid number !", 'alert-type' => 'error']);
            }
        }
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:contact_messages',
            'phone' => 'required|numeric|regex:/(01)[0-9]{9}/|unique:contact_messages',
            'subject' => 'required',
        ]);

        $contact_message = new ContactMessage();
        $contact_message->name = $request->name;
        $contact_message->email = $request->email;
        $contact_message->phone = $request->phone;
        $contact_message->subject = $request->subject;
        $contact_message->description = $request->description;
        //dd($contact_message);
        $contact_message->save();
        return back()->with(['message' => "Message Sent Successfully !", 'alert-type' => 'success']);
    }
}
