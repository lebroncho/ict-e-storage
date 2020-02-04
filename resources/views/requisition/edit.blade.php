@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Edit Requisition
    </div>

    <div class="card-body">
        <div class="form-group">
            <a class="btn btn-info" href="{{ route('requisition.show', $requisition->id) }}">
                Back
            </a>
            <a class="btn btn-default" href="{{ route('requisition.index') }}">
                Requisitions
            </a>
        </div>
        <form autocomplete="off" method="POST" action="{{ route("requisition.update", [$requisition->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="purpose">Purpose</label>
                <input class="form-control" type="text" name="purpose" id="purpose" value="{{ old('purpose', $requisition->purpose) }}"  required>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="required" for="requisition_date">Date</label>
                <input class="form-control" type="date" name="requisition_date" id="requisition_date" value="{{ old('requisition_date', $requisition->requisition_date) }}" required>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="required" for="requested_by">Requested By</label>
                <input class="form-control" type="text" name="requested_by" id="requested_by" value="{{ old('requested_by', $requisition->requested_by) }}" required>
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