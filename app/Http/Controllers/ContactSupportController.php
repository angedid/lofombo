<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessSendEMailContactUsJob;
use App\Models\Contactus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;

class ContactSupportController extends Controller
{


    public function getContactUsMessage(Request $request, string $locale)
    {
        //dd($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|min:2',
            'email' => 'required|string|email|max:255',
            'subject' => 'required|string|max:255|min:2',
            'message' => 'required|string|max:10000|min:10',
        ], [
            'name.required' => __('Le nom est obligatoire.'),
            'name.min' => __("Le nom est invalide. Minimum 2 caracteres"),
            'name.max' => __("Le nom est invalide. Maximum 255 caracteres"),
            'email.required' => __("L'email est obligatoire."),
            'email.email' => __("L'email est invalide."),
            'subject.required' => __('Le sujet est obligatoire.'),
            'subject.min' => __("Le sujet est invalide. Minimum 2 caracteres"),
            'subject.max' => __("Le sujet est invalide.Maximum 255 caracteres"),
            'message.required' => __('Le message est obligatoire.'),
            'message.min' => __('Le message est invalide. Minimum 10 caracteres'),
            'message.max' => __('Message est invalide. Minimum 10000 caracteres'),

        ]);

        //dd($request->all());

        if ($validator->fails()) {
            session()->flash('error', $validator->errors()->first());
            return back()->withErrors(['error' => $validator->errors()->first()]);
        }

        if ($request->file('phone')) {
            $emailvalidator = Validator::make($request->all(), [
                'phone' => 'required|phone',
            ], [
                'phone.required' => __("Le numéro de téléphone est obligatoire."),
                'phone.phone' => __("Le numéro de téléphone n'est pas reconnu"),
            ]);

            //dd($request->all());

            if ($emailvalidator->fails()) {
                session()->flash('error', $emailvalidator->errors()->first());
                return back()->withErrors(['error' => $emailvalidator->errors()->first()]);
            }
        }

        $emailData = [
            'emails' => ['lofombocm@gail.com', 'didnkallaehawe@gmail.com', 'kanakemda@yahoo.com'],
            'email' => $request->email,
            'subject' => trim($request->get('subject')),
            'phone' => trim($request->get('phone')),
            'mail_subject' => trim($request->get('subject')) . '(' . $request->get('name') . ', ' . $request->get('phone') .')',
            'name' => trim($request->get('name')),
            'message' => $request->message
        ];

        Contactus::create([
            'id' => Str::uuid()->toString(),
            'name' => trim($request->get('name')),
            'email' => trim($request->get('email')),
            'subject' => trim($request->get('subject')),
            'phone' => trim($request->get('phone')),
            'message' => Purifier::clean(trim($request->get('message'))),
        ]);

        ProcessSendEMailContactUsJob::dispatch($emailData);
        session()->flash('status', __('Message envoyé avec succès.'));
        return redirect()->back()->with('status', __('Message envoyé avec succès.'));//->withSuccess(['status' => 'Great! You have Successfully Registered.', 'client' => $client]);
    }
}
