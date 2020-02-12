@extends('layouts.admin')
@section('content')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <button type="button" class="add-modal btn btn-primary" data-toggle="modal" data-target="#addModal">
            Create User
        </button>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    User Management
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-CrmCustomer">
                            <thead>
                                <tr>
                                    <th width="10">
            
                                    </th>
                                    
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr data-entry-id="">
                                        <td>
            
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>       
                                            <button type="button" class="edit-modal btn btn-xs btn-info" data-toggle="modal" data-target="#editModal" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-username="{{ $user->username }}" data-role="{{ $user->role }}">
                                                Edit
                                            </button>

                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to reset the password?');" style="display: inline-block;">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="submit" class="btn btn-xs btn-danger" value="Reset Password">
                                            </form>
            
                                        </td>
            
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
<!--ADD MODAL-->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Add user</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body"><!--inputs located-->
            <form autocomplete="off" method="POST" action="{{ route("user.store") }}" enctype="multipart/form-data">
                @csrf
    
                <div class="form-group">
                    <label class="required" for="name">Name</label>
                    <input class="form-control" type="text" name="name" id="name" required>
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <label class="required" for="username">Username</label>
                    <input class="form-control" type="text" name="username" id="username" required>
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <label class="required" for="role">Role</label>
                    <select class="form-control" required name="role" required>
                        <option id="role" data-hidden="true" selected="selected"></option>
                        <option value= "Admin">Admin</option>
                        <option value= "Staff">Staff</option>
                    </select>  
                    <span class="help-block"></span>
                </div>
        </div>
        <!-- SUBMIT BUTTON -->
        <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-fill pull-right" id="form-button-add" name="form-button-add">
                    ADD
                </button>

                <button  data-dismiss="modal" aria-hidden="true" class="btn btn-basic pull-right" style="margin-right: 2%">
                    CANCEL
                </button>             
                <div class="clearfix"></div>                    
            </form> 
            <!--end of the form-->            
        </div>
            
        
      </div>
    </div>
</div>

<!--EDIT MODAL-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit user</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body"><!--inputs located-->
            @if(isset($user))
            {!! Form::model($user, ['route' => ['user.update', 'edit-user-id'], 'method' => 'PUT']) !!}
            
            {!! Form::hidden('id', null, ['id' => 'edit-user-id']) !!}

            {!! Form::label('Name:') !!}
            {!! Form::text('name', null, ['id' => 'edit-user-name', 'class' => "form-control"]) !!}

            {!! Form::label('Username:') !!}
            {!! Form::text('username', null, ['id' => 'edit-user-username', 'class' => "form-control"]) !!}

            {!! Form::label('Role:') !!}
            <select class="form-control" required name="role" required>
                <option id="edit-user-role" data-hidden="true" selected="selected"></option>
                <option value= "Admin">Admin</option>
                <option value= "Staff">Staff</option>
            </select>  
                            
        </div>
        <!-- SUBMIT BUTTON -->
        <div class="modal-footer">
                <button type="button" class="btn btn-secondary" style="margin-top:20px" data-dismiss="modal">Cancel</button>
                {!! Form::submit('UPDATE', ['class' => 'btn btn-primary', 'style' => 'margin-top:20px']) !!}           
                <div class="clearfix"></div>                    
            </form> 
            <!--end of the form-->            
        </div>
        {!! Form::close() !!}
        @endif     
      </div>
    </div>
</div>
@endsection    

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-CrmCustomer:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

$(function() {
    $('.edit-modal').on('click', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var username = $(this).data('username');
        var role = $(this).data('role');
        
        $('#edit-user-id').val(id);
        $('#edit-user-name').val(name);
        $('#edit-user-username').val(username);
        $('#edit-user-role').val(role);
        
    });
});

</script>

@endsection