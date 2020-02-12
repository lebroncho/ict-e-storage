@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Account Setting
    </div>

    <div class="card-body">
        
        <form autocomplete="off" method="POST" action="{{ route("user.update", [Auth::user()->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf 

            <div class="form-group">
                <label class="required" for="name">Name</label>
                <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="required" for="username">Username</label>
                <input class="form-control" type="text" name="username" id="username" value="{{ old('username', $user->username) }}" required>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="required" for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password" value="{{ old('password', $user->password) }}" required>
                <span class="help-block"></span>
            </div>
           
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
@parent

<script type="text/javascript">


    $(document).ready(function() {

      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });

    });

</script>

@endsection