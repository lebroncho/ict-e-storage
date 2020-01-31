@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Edit Request
    </div>

    <div class="card-body">
        <div class="form-group">
            <a class="btn btn-info" href="{{ route('request.show', $request->id) }}">
                Back
            </a>
            <a class="btn btn-default" href="{{ route('request.index') }}">
                Requests
            </a>
        </div>
        <form autocomplete="off" method="POST" action="{{ route("request.update", [$request->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="requested_by">Requested By</label>
                <input class="form-control" type="text" name="requested_by" id="requested_by" value="{{ old('from', $request->requested_by) }}" required>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="required" for="office">Office</label>
                <input class="form-control" type="text" name="office" id="office" value="{{ old('from', $request->office) }}" required>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="required" for="designation">Designation</label>
                <input class="form-control" type="text" name="designation" id="designation" value="{{ old('from', $request->designation) }}" required>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="required" for="request">Request</label>
                <input class="form-control" type="text" name="request" id="request" value="{{ old('from', $request->request) }}" required>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="required" for="date_requested">Date</label>
                <input class="form-control" type="date" name="date_requested" id="date_requested" value="{{ old('date_requested', $request->date_requested) }}" required>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label for="filename">Upload Image File</label>
                <div class="input-group control-group increment" >
                    <input type="file" name="filename[]" class="form-control">
                    <div class="input-group-btn"> 
                    <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                    </div>
                </div>
                
                <div class="clone hide">
                    <div class="control-group input-group" style="margin-top:10px">
                    <input type="file" name="filename[]" class="form-control">
                    <div class="input-group-btn"> 
                        <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                    </div>
                    </div>
                </div>
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