<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Institute;


class ContactController extends Controller
{
    public function showContactPage($id)
    {
        $institute = Institute::findOrFail($id);

        return view('frontend.profile.profile-contact', ['institute' => $institute]);
    }

    public function sendContactMessage(Request $request, $id)
    {
        $institute = Institute::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $mailData = [
            'institute' => $institute->institute_name,
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'messageContent' => $request->message,
        ];

        Mail::send('emails.contact', $mailData, function ($mail) use ($institute, $request) {
            $mail->to($institute->email)
                ->subject('Contact Message: ' . $request->subject)
                ->from($request->email, $request->name);
        });

        return redirect()->back()->with('success', 'Your message has been sent to the institute.');
    }


}
