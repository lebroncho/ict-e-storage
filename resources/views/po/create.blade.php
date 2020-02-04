@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Add Purchase Order
    </div>

    <div class="card-body">
        <div class="form-group">
            <a class="btn btn-default" href="{{ route('purchase_order.index') }}">
            Back to Purchase Order Lists
            </a>
        </div>
        <form autocomplete="off" method="POST" action="{{ route("purchase_order.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="po_num">PO #</label>
                <input class="form-control" type="text" name="po_num" id="po_num" required>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="required" for="po">PO</label>
                <input class="form-control" type="text" name="po" id="po" required>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="required" for="issuance_num">Issuance #</label>
                <input class="form-control" type="text" name="issuance_num" id="issuance_num" required>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="required" for="po_date">Purchase Order Date</label>
                <input class="form-control" type="date" name="po_date" id="po_date" required>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="required" for="supplier">Supplier</label>
                <input class="form-control" type="text" name="supplier" id="supplier" required>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label class="required" for="released_by">Released By</label>
                <input class="form-control" type="text" name="released_by" id="released_by" required>
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label class="required" for="received_by">Received By</label>
                <input class="form-control" type="text" name="received_by" id="received_by" required>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label for="endorsed_to">Endorsed To</label>
                <input class="form-control" type="text" name="endorsed_to" id="endorsed_to">
                <span class="help-block"></span>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="required">Qty</th>    
                        <th class="required">Unit</th>    
                        <th class="required">Description</th>   
                        <th class="required">Price</th>   
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
                            <input type="text" name="unit[]" class="form-control" required>  
                        </td>    
                        <td>
                            <input type="text" name="description[]" class="form-control" required>  
                        </td> 
                        <td>
                            <input type="number" name="price[]" step="0.01" min="0" class="form-control" required>  
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
        '<td><input type="text" name="price[]" class="form-control description"></td>'+
        '<td><a class="btn btn-danger remove"><i class="fas fa-times"></i></a></td>'+
        '</tr>';

        $('tbody').append(tr);
      }

      $('.remove').live('click', function(){
        $(this).parent().parent().remove();
      });

</script>

@endsection