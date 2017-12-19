@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
            
                <div class="panel-heading breadcrumb">

                    Dashboard -
                    <li class="breadcrumb-item">{{$year}}</li>
                    <li class="breadcrumb-item active">{{$month = date("M", mktime(0, 0, 0, $month, 10))}}</li>      
                    <div class="pull-right" ><a href="/notes/create" class="btn btn-sm btn-primary" ><i class="fa fa-plus" aria-hidden="true" title="Create Note"></i>&nbsp; Create Note</a></div>
                    
                    
                    
                    
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                            
                        </div>
                    @endif
                    {{--  </div>  --}}
                    @if(count($notes)>0)
                        @foreach($notes as $n)
                            {{--  <div class="panel-body">  --}}
                                <div class="row">
                                    {{--  <div class="col-md-4 col-sm-4">
                                        <img style="width:100%" src="/storage/before_images/{{$n->notes_before_image}}">
                                    </div>  --}}
                                    
                                    <div class="col-md-12 col-sm-12">
                                    <div class="well">
                                            <span class="label label-default">{{$n->created_at->format('d M Y')}}</span>
                                            <span class="label label-primary">Currency - {{$n->notes_currency}}</span>
                                            <span class="label label-success">Action - {{$n->notes_moving_market}}</span>
                                            <span class="label label-danger">Author - {{$n->user->name}}</span>
                                            <h3><a href="/notes/{{$n->notes_id}}">{{$n->notes_news}}</a></h3>
                                            <div class="text-justify">{!!$n->notes_summary!!}</div>
                                            @if ($n->notes_bloomberg_status == 1)
                                                <p>Source : Bloomberg</p>
                                            @endif
                                        </div><hr>
                                    </div>
                                    
                                </div>     
                                    
                                
                            {{--  </div>  --}}
                        @endforeach
                        
                    @else
                        <p>No Notes found</p>
                    @endif
                </div>
                <div class="pull-right">
                    {{$notes->links()}}
                </div>


                   
                
            </div>
        </div>
    </div>
</div>
@endsection
