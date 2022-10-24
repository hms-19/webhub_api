<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function contactMessage(Request $request) {

        // Form validation
       $valid = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'message' => 'required'
         ]);

         if($valid->fails()){
            return response()->json([
                'message' => 'Invalid',
                'errors' => $valid->errors()
            ]);
         }

         $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
         ];

        Mail::to('admin@webhubmm.com')->send(new Contact($data));
        return response()->json([
            'message' => 'Message was sent successfully'
        ]);
    }
}
