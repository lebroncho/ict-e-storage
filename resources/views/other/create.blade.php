@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Add File
    </div>

    <div class="card-body">
        <div class="form-group">
            <a class="btn btn-default" href="{{ route('other.index') }}">
            Back to Other Files
            </a>
        </div>
        <form autocomplete="off" method="POST" action="{{ route("other.store") }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="required" for="title">File</label>
                <input class="form-control" type="text" name="title" id="title" required>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="required" for="created_at">Date</label>
                <input class="form-control" type="date" name="created_at" id="created_at" required>
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