<?php

namespace App\Http\Controllers;


use App\Http\Requests\Admin\MailRequest;
use App\Mail\ContactEmail;
use App\Models\Language;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(string $lang, MailRequest $request)
    {
        if ($request->method() == 'POST') {
//            $request->validate([
//                'name' => 'required|string|max:55',
//                'mail' => 'required|email',
//                'message' => 'required|max:1024'
//            ]);

            $data = [
                'full_name' => $request->name,
                'mail' => $request->mail,
                "subject" => "subject",
                'message' => $request->message
            ];
            $mailTo = Setting::where(['key' => 'contact_email'])->first();

//            dd($mailTo->language());
            if (($mailTo !== null) && $mailTo->language()) {
//                dd($mailTo->language()->value );
                Mail::to($mailTo->language()->value)->send(new ContactEmail($data));
            }

        }

        return redirect()->back();
//        $page = Page::where(['status' => true, 'type' => 'contact-us'])->with('availableLanguage')->first();
//        if (!$page) {
//            return abort('404');
//        }
//        return view('pages.contact-us.index', [
//            'page' => $page
//        ]);
    }

}
