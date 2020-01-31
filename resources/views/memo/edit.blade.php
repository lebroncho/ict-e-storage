@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Edit Memo
    </div>

    <div class="card-body">
        <div class="form-group">
            <a class="btn btn-default" href="{{ route('memo.index') }}">
            Back to Memos
            </a>
        </div>
        <form autocomplete="off" method="POST" action="{{ route("memo.update", [$memo->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="type">Memo Type</label>
                <select class="form-control" required id="type" name="type" required>
                    <option value="{{ old('type', $memo->type) }}" data-hidden="true" selected="selected">{{ $memo->type }}</option>
                    @if($memo->type === 'Out')
                    <option value= "In">In</option>
                    @else
                    <option value= "Out">Out</option>
                    @endif
                </select>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="required" for="subject">Subject</label>
                <input class="form-control {{ $errors->has('subject') ? 'is-invalid' : '' }}" type="text" name="subject" id="subject" value="{{ old('subject', $memo->subject) }}" required>
                @if($errors->has('subject'))
                    <span class="text-danger">{{ $errors->first('subject') }}</span>
                @endif
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="required" for="from">From</label>
                <input class="form-control" type="text" name="from" id="from" value="{{ old('from', $memo->from) }}" required>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="required" for="to">To</label>
                <input class="form-control" type="text" name="to" id="to" value="{{ old('to', $memo->to) }}" required>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label for="noted_by">Noted By</label>
                <input class="form-control" type="text" name="noted_by" id="noted_by" value="{{ old('noted_by', $memo->noted_by) }}">
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label for="cc">Cc</label>
                <input class="form-control" type="text" name="cc" id="cc" value="{{ old('cc', $memo->cc) }}">
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="required" for="date_received">Date</label>
                <input class="form-control" type="date" name="date_received" id="date_received" value="{{ old('date_received', $memo->date_received) }}" required>
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