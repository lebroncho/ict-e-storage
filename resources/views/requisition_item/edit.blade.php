@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Edit Requisition Items
    </div>

    <div class="card-body">
        <div class="form-group">
            <a class="btn btn-info" href="{{ route('requisition.show', $id) }}">
                Back
            </a>

            <button type="button" class="add-modal btn btn-primary" data-toggle="modal" data-target="#addModal">
                Add Item
            </button>
        </div>
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-CrmCustomer">
                <thead>
                    <tr>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr data-entry-id="">
                            <td>{{ $item->qty }}</td>
                            <td>{{ $item->unit }}</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                <button type="button" class="edit-modal btn btn-xs btn-info" data-toggle="modal" data-target="#editModal" data-id="{{ $item->id }}" data-qty="{{ $item->qty }}" data-unit="{{ $item->unit }}" data-description="{{ $item->description }}">
                                    Edit
                                </button>

                                <form action="{{ route('requisition_item.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="Delete">
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
@endsection

@section('modals')
<!--ADD MODAL-->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Add Item</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body"><!--inputs located-->
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
                <tbody class="item-row">
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
          <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body"><!--inputs located-->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="required">Qty</th>    
                        <th class="required">Unit</th>    
                        <th class="required">Description</th>
                    </tr>
                </thead>
                <tbody class="item-row">
                    @if(isset($item))
                        {!! Form::model($item, ['route' => ['requisition_item.update', 'edit-item-id'], 'method' => 'PUT']) !!}
                        {!! Form::hidden('id', null, ['id' => 'edit-item-id']) !!}
                        <tr>
                            <td>
                                {!! Form::number('qty', null, ['id' => 'edit-item-qty', 'class' => "form-control"]) !!}  
                            </td>    
                            <td>
                                {!! Form::text('unit', null, ['id' => 'edit-item-unit', 'class' => "form-control"]) !!}  
                            </td>    
                            <td>
                                {!! Form::text('description', null, ['id' => 'edit-item-description', 'class' => "form-control"]) !!}  
                            </td> 
                        </tr>  
                  
                </tbody>    
            </table>
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
        
        $('.item-row').append(tr);
    }

    $('.remove').live('click', function(){
        $(this).parent().parent().remove();
    });

    $(function() {
        $('.edit-modal').on('click', function() {
            var id = $(this).data('id');
            var qty = $(this).data('qty');
            var unit = $(this).data('unit');
            var description = $(this).data('description');
            
            $('#edit-item-id').val(id);
            $('#edit-item-qty').val(qty);
            $('#edit-item-unit').val(unit);
            $('#edit-item-description').val(description);
            
        });
    });
</script>

@endsection