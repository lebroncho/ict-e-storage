@extends('layouts.admin')
@section('content')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('requisition.create') }}">
            Add Requisition
        </a>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Requisition
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-CrmCustomer">
                            <thead>
                                <tr>
                                    <th width="10">
            
                                    </th>
                                    
                                    <th>Purpose</th>
                                    <th>Date</th>
                                    <th>Requested By</th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requisitions as $requisition)
                                    <tr data-entry-id="">
                                        <td>
            
                                        </td>
                                        <td>{{ $requisition->purpose }}</td>
                                        <td>{{ $requisition->requisition_date }}</td>
                                        <td>{{ $requisition->requested_by }}</td>
                                        <td>
                                            <a class="btn btn-xs btn-primary" href="{{ route('requisition.show', $requisition->id) }}">
                                                View
                                            </a>
            
                                            <a class="btn btn-xs btn-info" href="{{ route('requisition.edit', $requisition->id) }}">
                                                Edit
                                            </a>

                                            <form action="{{ route('requisition.destroy', $requisition->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?');" style="display: inline-block;">
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
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-CrmCustomer:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>

@endsection