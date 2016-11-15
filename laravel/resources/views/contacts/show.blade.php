@inject('contact' , 'App\Contact')
@extends('app')

@section('content')
    <div class='row'>
        <div class='small-11 small-centered columns'>
            <h1>Contact</h1>
        </div>
    </div>
    <div class='row'>
        <div class='small-11 small-centered columns'>
            <table class="hover stacked">
                <thead>
                <th>Forename</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Delete</th>
                </thead>
                <tbody>
                <tr>
                    <td>{{ ucfirst($contact->getByID(Request::segment(2))->firstname) }}</td>
                    <td>{{ ucfirst($contact->getByID(Request::segment(2))->lastname) }}</td>
                    <td>{{ ucfirst($contact->getByID(Request::segment(2))->email) }}</td>
                    <td>
                        {!! Form::open(['route' => ['contacts.destroy' , $contact->getByID(Request::segment(2))->id] , 'method' => 'DELETE']) !!}
                        <div class="form-group">
                            {!! Form::button('<span class="fa fa-trash"></span>' , ['type' => 'submit' , 'class' => 'delete-button' , 'name' => 'delete']) !!}</i>
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class='row'>
        <div class='small-11 small-centered columns'>
            <a href="#" data-open="myModal" class="button">Edit Contact</a>
        </div>
    </div>
    @include('contacts.form')

@endsection
@section('scripts')
    @include('scripts.errors')
@endsection
