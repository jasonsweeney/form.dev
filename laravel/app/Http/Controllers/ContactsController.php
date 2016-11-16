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
            'lastname'  => '',
            'email'     => '',
            'action'    => 'create'
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

            $data = [
                'firstname' => Input::get('firstname'),
                'lastname'  => Input::get('lastname'),
                'email'     => Input::get('email')
            ];

            $contact = new Contact;
            $contact->addContact($data);

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

        return view(Request::segment(1) . '.show', compact('array'));
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
            'id'        => $id,
            'firstname' => $data['firstname'],
            'lastname'  => $data['lastname'],
            'email'     => $data['email']
        ];

        if ($errors = $contactsForm->validate($data)) {
            return $errors;
        } else {
            $contact = new Contact;
            $contact->updateContact($data, $id);

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
        Request::session()->flash('success', trans('database.delete-success'));

        return Response::json(array('redirect' => '/contacts', 200));

        //return redirect()->to('contacts')->with('success', trans('database.delete-success'));
    }
}
