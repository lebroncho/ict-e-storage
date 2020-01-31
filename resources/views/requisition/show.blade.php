@extends('layouts.admin')

@section('styles')

    <style>
        #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #myImg:hover {opacity: 0.7;}

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
        }

        /* Modal Content (image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image */
        #caption {
            margin: auto;
            display: block;
            width: 20%;
            max-width: 50px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 50px;
        }

        /* Add Animation */
        .modal-content, #caption {  
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {-webkit-transform:scale(0)} 
            to {-webkit-transform:scale(1)}
        }

        @keyframes zoom {
            from {transform:scale(0)} 
            to {transform:scale(1)}
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
            }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
            .modal-content {
                width: 100%;
            }
        }

    </style>

@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <strong>{{ $requisition->purpose }}</strong>
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('requisition.index') }}">
                    Back to Requisitions
                    </a>
                    <a class="btn btn-info" href="{{ route('requisition.edit', $requisition->id) }}">
                    Edit
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                Purpose
                            </th>
                            <td>
                                {{ $requisition->requisition }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Requested By
                            </th>
                            <td>
                                {{ $requisition->requested_by }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Date requisitioned
                            </th>
                            <td>
                                {{ $requisition->date_requisitioned }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                            Pictures
                            </th>
                            <td>
                                @if(!$requisition->filename)
                                No Pictures
                                @else
                                <?php foreach(json_decode($requisition->filename) as $picture) {?>
                                    <img id="myImg" src="{{ asset('/images/'.$picture) }}" style="height:120px; width:200px"/>
                                <?php } ?>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Items
                    </div>
    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable datatable-CrmCustomer">
                                <thead>
                                    <tr>
                                        <th>Qty</th>
                                        <th>Unit</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr data-entry-id="">
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ $item->unit }}</td>
                                            <td>{{ $item->description }}</td>
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

@section('modals')
    <!-- The Modal -->
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
    </div>
@endsection

@section('scripts')
@parent
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");
        
        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById("myImg");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function(){
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
        }
        
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() { 
        modal.style.display = "none";
        }

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