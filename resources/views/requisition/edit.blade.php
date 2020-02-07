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

<div class="card">
    <div class="card-header">
        Edit Requisition Items
        <button type="button" class="add-modal btn btn-xs btn-primary" data-toggle="modal" data-target="#addModal">
            Add Item
        </button>
    </div>

    <div class="card-body">
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
                    </tr>
                </thead>
                <tbody class="item-row">
                    <form autocomplete="off" method="POST" action="{{ route('requisition_item.store') }}" enctype="multipart/form-data">
                        <input type="hidden" name="r_id" value="{{ $requisition->id }}" class="form-control">
                        @csrf
                    <tr>
                        <td>
                            <input type="number" name="qty" class="form-control quantity" required>  
                        </td>    
                        <td>
                            <input type="text" name="unit" class="form-control unit" required>  
                        </td>    
                        <td>
                            <input type="text" name="description" class="form-control description" required>  
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
                <tbody>
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