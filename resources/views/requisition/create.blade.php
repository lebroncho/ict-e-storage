@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Add Requisition
    </div>

    <div class="card-body">
        <div class="form-group">
            <a class="btn btn-default" href="{{ route('requisition.index') }}">
            Back to Requisitions
            </a>
        </div>
        <form autocomplete="off" method="POST" action="{{ route("requisition.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="purpose">Purpose</label>
                <input class="form-control" type="text" name="purpose" id="purpose" required>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="required" for="requisition_date">Date</label>
                <input class="form-control" type="date" name="requisition_date" id="requisition_date" required>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="required" for="requested_by">Requested By</label>
                <input class="form-control" type="text" name="requested_by" id="requested_by" required>
                <span class="help-block"></span>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="required">Qty</th>    
                        <th class="required">Unit</th>    
                        <th class="required">Description</th>   
                        <th>
                            <a class="btn addRow"><i class="fas fa-plus"></i></a>    
                        </th> 
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="number" name="qty[]" class="form-control quantity" required>  
                        </td>    
                        <td>
                            <input type="text" name="unit[]" class="form-control unit" required>  
                        </td>    
                        <td>
                            <input type="text" name="description[]" class="form-control description" required>  
                        </td> 
                        <td>
                             
                        </td>   
                    </tr>    
                </tbody>    
            </table>

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

    $('.addRow').on('click', function(){
          addRow();
    }); 

    function addRow()
    {
        var i = $('.quantity').length; // get the count of rows.

        var tr = '<tr>'+
        '<td><input type="number" name="qty[]" class="form-control quantity"></td>'+
        '<td><input type="text" name="unit[]" class="form-control unit"></td>'+
        '<td><input type="text" name="description[]" class="form-control description"></td>'+
        '<td><a class="btn btn-danger remove"><i class="fas fa-times"></i></a></td>'+
        '</tr>';
        
        $('tbody').append(tr);
    }

      $('.remove').live('click', function(){
        $(this).parent().parent().remove();
      });
</script>

@endsection