@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Edit Bill
    </div>

    <div class="card-body">
        <div class="form-group">
            <a class="btn btn-info" href="{{ route('bill.show', $bill->id) }}">
                Back
            </a>
            <a class="btn btn-default" href="{{ route('bill.index') }}">
                Bills
            </a>
        </div>
        <form autocomplete="off" method="POST" action="{{ route("bill.update", [$bill->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-group">
                <label class="required" for="bill_name">Name of Bill</label>
                <input class="form-control" type="text" name="bill_name" id="bill_name" value="{{ old('bill_name', $bill->bill_name) }}" required>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="required" for="received_date">Received Date</label>
                <input class="form-control" type="date" name="received_date" id="received_date"  value="{{ old('received_date', $bill->received_date) }}"required>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="required" for="requested_by">Requested By</label>
                <input class="form-control" type="text" name="requested_by" id="requested_by" value="{{ old('requested_by', $bill->requested_by) }}" required>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="required" for="acc_num">Account Number</label>
                <input class="form-control" type="text" name="acc_num" id="acc_num" value="{{ old('acc_num', $bill->acc_num) }}" required>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="required" for="soa_num">SOA Number</label>
                <input class="form-control" type="text" name="soa_num" id="soa_num" value="{{ old('soa_num', $bill->soa_num) }}" required>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="required" for="amount">Amount</label>
                <input class="form-control" type="number" name="amount" id="amount" step="0.01" min="0" value="{{ old('amount', $bill->amount) }}" required>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="required" for="statement_date">Statement Date</label>
                <input class="form-control" type="date" name="statement_date" id="statement_date" value="{{ old('statement_date', $bill->statement_date) }}" required>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="required" for="filename">Upload Image File</label>
                <div class="input-group control-group increment" >
                    <input type="file" name="filename[]" class="form-control" required>
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

<!--div class="card">
    <div class="card-header">
        Replace Image
    </div>

    <div class="card-body">
        <form autocomplete="off" method="POST" action="#" enctype="multipart/form-data">
           {{-- @csrf --}}
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
</div-->



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