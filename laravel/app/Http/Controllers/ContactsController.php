<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Validation\ContactsForm;
use Illuminate\Support\Facades\Input;
use Request;
use Response;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $array = [
            'firstname' => '',
            'lastname' => '',
            'email' => '',
            'action' => 'create'
        ];
        return view('contacts.index', compact('array'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactsForm $contactsForm)
    {
        $data = Input::only('firstname', 'lastname', 'email');

        if ($errors = $contactsForm->validate($data)) {
            return $errors;
        } else {
            $contact = new Contact;
            $contact->firstname = Input::get('firstname');
            $contact->lastname = Input::get('lastname');
            $contact->email = Input::get('email');

            $contact->save();

            Request::session()->flash('success', trans('database.create-success'));
            return Response::json(array('redirect' => 'contacts', 200));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show()
    {
        $array['action'] = 'update';

        return view(Request::segment(1).'.show', compact('array'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(ContactsForm $contactsForm, $id)
    {
        $data = Input::only('firstname', 'lastname', 'email');

        $data = [
            'id' => $id,
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email']
        ];

        if ($errors = $contactsForm->validate($data)) {
            return $errors;
        } else {
            $contact = Contact::find($id);
            $contact->firstname = Input::get('firstname');
            $contact->lastname = Input::get('lastname');
            $contact->email = Input::get('email');

            $contact->save();
             $return = '/contacts/' . $id;
            Request::session()->flash('success', trans('database.update-success'));
            return Response::json(array('redirect' => "$return", 200));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        Contact::find($id)->delete();
        return redirect()->to(Request::segment(1))->with('success', trans('database.delete-success'));
    }
}
