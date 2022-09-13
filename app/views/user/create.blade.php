@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Add Employee Details</h3>
    </div>
    <div class="panel-body">
    {{ Form::open(array('route' => 'user.store','class'=>'form-horizontal','role'=>"form" ,'files' => true)) }}
        
        <div class="form-group {{ $errors->first('email', 'has-error') }} "> 
            {{ Form::label('email', 'Email:',array('class'=>'col-sm-3 control-label')) }} 
            <div class="col-sm-3">
            {{ Form::text('email', Input::old('email'), array('class' => 'txt form-control','placeholder'=>'0','onKeyUp'=>'isNumberKey(this)')) }}
            {{ $errors->first('email', '<span class="error">:message</span>') }} 
            </div>
        </div>
        <div class="form-group {{ $errors->first('name', 'has-error') }} "> 
            {{ Form::label('name', 'Name:',array('class'=>'col-sm-3 control-label')) }} 
            <div class="col-sm-3">
            {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
            {{ $errors->first('name', '<span class="error">:message</span>') }} 
            </div>
        </div>
        
        <div class="form-group {{ $errors->first('doj', 'has-error') }} "> 
            {{ Form::label('doj', 'Date of Joining:',array('class'=>'col-sm-3 control-label')) }} 
            <div class="col-sm-3">
            {{ Form::text('doj', Input::old('doj'), array('class' => 'txt form-control','placeholder'=>'0','onKeyUp'=>'isNumberKey(this)')) }}
            {{ $errors->first('doj', '<span class="error">:message</span>') }} 
            </div>
        </div>
        <div class="form-group {{ $errors->first('dol', 'has-error') }} "> 
            {{ Form::label('dol', 'Date of Leaving:',array('class'=>'col-sm-3 control-label')) }} 
            <div class="col-sm-3">
            {{ Form::text('dol', Input::old('dol'), array('class' => 'txt form-control','placeholder'=>'0','onKeyUp'=>'isNumberKey(this)')) }}
            {{ $errors->first('dol', '<span class="error">:message</span>') }} 
            </div>
        </div>
        <div class="form-group {{ $errors->first('work', 'has-error') }} "> 
            {{ Form::label('work', 'Still working:',array('class'=>'col-sm-3 control-label')) }} 
            <div class="col-sm-3">
            {{ Form::text('work', Input::old('work'), array('class' => 'txt form-control','placeholder'=>'0','onKeyUp'=>'isNumberKey(this)')) }}
            {{ $errors->first('work', '<span class="error">:message</span>') }} 
            </div>
        </div>
        <div class="form-group {{ $errors->first('image', 'has-error') }} "> 
            {{ Form::label('image', 'Avatar:',array('class'=>'col-sm-3 control-label')) }} 
            <div class="col-sm-3">
            {{ Form::text('image', Input::old('image'), array('class' => 'form-control')) }}
            {{ $errors->first('image', '<span class="error">:message</span>') }} 
            </div>
        </div>
       
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-5">
                {{ Form::submit('Save', array('class' => 'btn btn-success submit')) }}
                {{ link_to_route('user.index', 'Cancel',null,array('class' => 'btn btn-danger cancel')) }}
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
