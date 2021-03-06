<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Contact extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firstname', 'lastname', 'email'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = ['password', 'remember_token'];

    public function getAll()
    {
        $result = Contact::all();

        return $result;
    }

    public function getByID($id)
    {
        $result = Contact::where('id', $id)->first();

        return $result;
    }

    public function addContact($data)
    {
        $this->firstname = $data['firstname'];
        $this->lastname  = $data['lastname'];
        $this->email     = $data['email'];

        $this->save();
    }

    public function updateContact($data, $id)
    {
        $update = $this->getByID($id);

        $update->firstname = $data['firstname'];
        $update->lastname  = $data['lastname'];
        $update->email     = $data['email'];

        $update->save();
    }
}
