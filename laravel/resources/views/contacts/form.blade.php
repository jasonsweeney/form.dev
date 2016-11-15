<div id="myModal" class="reveal" data-reveal>
    <div class='row'>
        <div class='small-12 columns'>
            @if($array['action'] == 'create')
                {!! Form::open(array('route' => 'contacts.store','role' => 'form','class' => 'ajax-form')) !!}
                <h2>Create a new contact</h2>
            @else
                {!! Form::model($contact->getByID(Request::segment(2)), ['route' => ['contacts.update', $contact->getByID(Request::segment(2))->id],'method' => 'patch','role' => 'form','class' => 'ajax-form']) !!}
                <h2>Edit a contact</h2>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="small-12 columns">{!! Form::label('firstname', 'First name') !!}</div>
        <div class="small-12 columns">{!! Form::text('firstname') !!}</div>
    </div>

    <div class="row">
        <div class="small-12 columns">{!! Form::label('lastname', 'Last name') !!}</div>
        <div class="small-12 columns">{!! Form::text('lastname') !!}</div>
    </div>

    <div class="row">
        <div class="small-12 columns">{!! Form::label('email', 'email') !!}</div>
        <div class="small-12 columns">{!! Form::text('email') !!}</div>
    </div>

    <div class="form-group">
        <br>
        {!! Form::button('Save', array('type' => 'submit', 'class' => 'button save')) !!}
    </div>
    {!! Form::close() !!}
    <a class="close-button" data-close>&#215;</a>
</div>

