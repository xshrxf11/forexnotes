@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-sm-10 col-md-offset-1">
            <div class="pull-left">
                <a href="/dashboard" class="btn btn-default"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-sm-10 col-md-offset-1">
            <hr>
        </div>    
    </div>
    
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <table>
                        <tr>
                            <td class="col-sm-12">ForexNotes</td>
                            <td class="col-sm-2"><a href="/notes/create" class="btn btn-sm btn-primary" ><i class="fa fa-plus" aria-hidden="true" title="Create Note"></i>&nbsp; Create Note</a></td>
                        </tr>
                    </table>
                    
                    
                    
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped datatable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Notes</th>
                                    <th>Currency</th>
                                    <th>Moving Market</th>
                                    <th>Previous</th>
                                    <th>Constant</th>
                                    <th>Action</th>  
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{--  {data: 'action', name: 'action', orderable: false, searchable: false}  --}}

@section('script')
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 5,
        ajax: '{{ route('getNotes') }}',
        columns: [
            {data: 'created_at', name: 'created_at'},
            {data: 'notes_news', name: 'notes_news'},
            {data: 'notes_currency', name: 'notes_currency'},
            {data: 'notes_moving_market', name: 'notes_moving_market'},
            {data: 'notes_prev', name: 'notes_prev'},
            {data: 'notes_const', name: 'notes_const'},
            {data: 'Action', name: 'Action', orderable: false, searchable: false}
            
        ]
    });
});
</script>
@endsection

{{--  @section('content')
    <h1>Notes</h1>
    @if(count($notes)>0)
        @foreach($notes as $n)
            <div class="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width:100%" src="/storage/before_images/{{$n->notes_before_image}}">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <span class="label label-default">{{$n->created_at->format('d M Y')}}</span>
                        <span class="label label-primary">Currency - {{$n->notes_currency}}</span>
                        <span class="label label-success">Action - {{$n->notes_moving_market}}</span>
                        <span class="label label-danger">Author - {{$n->user->name}}</span>
                    
                    
                    
                        <h3><a href="/notes/{{$n->notes_id}}">{{$n->notes_news}}</a></h3>
                        <p>{!!$n->notes_summary!!}</p>
                    </div>
                </div>     
                    
                
            </div>
        @endforeach
        {{$notes->links()}}
    @else
        <p>No Notes found</p>
    @endif
@endsection  --}}