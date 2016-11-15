<?php
namespace App\Validation;

use Response;
use Request;
use Validator;

class ContactsForm
{

    function validate($data)
    {
        // Check for duplicate email
        if (array_key_exists('id', $data)) {
            $rule_email = ',email,' . $data['id'] . ',id,deleted_at,NULL';
        } else {
            $rule_email = ',email,NULL,id,deleted_at,NULL';
        }
        $validator = Validator::make(
            [
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'email' => $data['email'],
            ],
            [
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|email|unique:contacts' . $rule_email
            ]
        );
        // Your first name is required!
        $niceNames = [
            'firstname' => 'first name',
            'lastname' => 'last name'
        ];
        $validator->setAttributeNames($niceNames);

        if ($validator->fails()) {

            if (Request::ajax()) {
                return Response::json(array('errors' => $validator->messages(), 200));
            }
            return redirect()->back()->withInput($data)->withErrors($validator);
        }

        return false;

    }

}



