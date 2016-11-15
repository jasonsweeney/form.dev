@inject('contact','App\Contact')
@extends('app')

@section('content')
    <div class='row'>
        <div class='small-11 small-centered columns'>
            <h1>Contacts</h1>
        </div>
    </div>
    <div class='row'>
        <div class='small-11 small-centered columns'>
            <table class="hover stacked">
                <thead>
                <th>Forename</th>
                <th>Lastname</th>
                <th class="show-for-medium">Email</th>
                <th class="show-for-medium">Delete</th>
                </thead>
                <tbody>
                @foreach($contact->getAll() as $row)
                    <tr>
                        <td><a href="{{ Request::segment(1) }}/{{ $row['id'] }}">{{ ucfirst($row['firstname']) }}</a></td>
                        <td>{{ ucfirst($row['lastname']) }}</td>
                        <td class="show-for-medium">{{ $row['email'] }}</td>
                        <td class="show-for-medium">
                            {!! Form::open(['route' => ['contacts.destroy' , $row['id'] , 'method' => 'DELETE']]) !!}
                            <div class="form-group">
                                {!! Form::button('<span class="fa fa-trash"></span>' , ['type' => 'submit' , 'class' => 'delete-button' , 'name' => 'delete']) !!}</i>
                            </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class='row'>
        <div class='small-11 small-centered columns'>
            <a id="asd" href="#" data-open="myModal" class="button">Create A New Contact&nbsp;<i
                        class="fa fa-plus-square-o"
                        aria-hidden="true"></i></a>
        </div>
    </div>
    @include('contacts.form')
@endsection

@section('scripts')
    <script>
        $(function () {
            $("form").submit(function (e) {

                e.preventDefault();

                // Clear the errors
                $(".ajax-remove").remove();
                $(".row").removeClass('has-error');

                var $form = $(this);

                $('.save').addClass('disabled');

                $.post($form.attr("action"), $form.serialize())
                        .done(function (result) {
                            if (result['errors']) {

                                $('.save, .button').removeClass('disabled');

                                $.each(result['errors'], function (k, v) {
                                    $('#' + k).closest('.row').addClass('has-error').prepend('<div class="small-12 columns ajax-remove help-block">' + v + '</div>');
                                });
                                return;
                            } else if (result['redirect']) {
                                return window.top.location.href = result['redirect'];
                            }
                        });
            });
        });
    </script>
@endsection