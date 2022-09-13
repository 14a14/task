
<br/>
<div>
    <ul class="nav nav-pills">
    <li class="active" style="float:right;"><a class="btn btn-primary" href="{{ URL::route('user.create') }}">Add New</a></li>    
    </ul><br/>
    </div>

<br/>
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title"><b class="heading-border" style="color:green;">{{strtoupper('User Records')}}</b></h3>
    </div>
    <div class="panel-body">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th >Avatar</th>
                <th> Name</th>
                <th> Email</th>
                <th>Experience</th>
           </tr>
        </thead>
        <tbody>
            @if($ulist->count())
            @foreach ($ulist as $ud)
            <tr>
                <td>{{ $i++; }}</td>
                <td>{{ $ud->image }}</td>
                <td>{{ $ud->name }}</td>
                <td>{{ $ud-> $diff_d }}</td>
                <td class="text-center">
                    {{ Form::open(array('route' => array('user.destroy', $ud->id), 'method' => 'delete', 'data-confirm' => 'Are you sure to delete this record?')) }}
                        <button type="submit" href="{{ URL::route('user.index') }}" class="btn btn-danger btn-mini">Delete</button>
                    {{ Form::close() }}
                </td>
            </tr>
            @endforeach
            @else
                <tr>
                    <td colspan="14" class="text-center">There are no records.</td>
                </tr>
            @endif
        </tbody>
    </table>
        {{ $ulist->appends(Input::except(array('filter'=>Input::old('filter'),'page')))->links() }}
  </div>
</div>
<script>
    $(function() {
        // Confirm deleting resources
        $("form[data-confirm]").submit(function() {
                if ( ! confirm($(this).attr("data-confirm"))) {
                        return false;
                }
        });
    });
</script>
@stop