@extends('layouts.app')

@section('content')
    
    
    
    {{--  <hr>  --}}
       
            <div class="well">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <table class="table table-responsive table-striped">
                            <tr>
                                <th>Before Image :</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>After Image  :</th>
                            </tr>
                            <tr>
                                <td><img style="width:100%" src="/storage/before_images/{{$note->notes_before_image}}"></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><img style="width:100%" src="/storage/after_images/{{$note->notes_after_image}}"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <span class="label label-default">{{$note->created_at->format('d M Y')}}</span>
                        <span class="label label-primary">Currency - {{$note->notes_currency}}</span>
                        <span class="label label-success">Action - {{$note->notes_moving_market}}</span>
                        <span class="label label-danger">Author - {{$note->user->name}}</span>
                    
                    
                        <h3>{{$note->notes_news}}</h3>
                        <p>{!!$note->notes_summary!!}</p>
                        @if ($note->notes_bloomberg_status == 1)
                            <p>Source : Bloomberg</p>
                        @endif
                    </div>
                </div>        
                   
                    
                
            </div>

            @if(!Auth::guest())
                @if(Auth::user()->id == $note->user_id) 
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="pull-left">
                                <a href="/dashboard" class="btn btn-default">Back</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                        
                            <div class="pull-right">
                                <table>
                                <tr>
                                    <td>
                                        <a href="/notes/{{$note->notes_id}}/edit" class="btn btn-default">Edit</a>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        {{--  {!! Form::open(['action' => ['', $note->notes_id] , 'method' => 'POST']) !!}
                                            {{Form::hidden('_method','DELETE')}}
                                            {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
                                        {!! Form::close() !!}  --}}

                                        {!! Form::model($note, ['method' => 'delete', 'route' => ['notes.destroy', $note->notes_id], 'class' =>'form-inline form-delete']) !!}
                                        {!! Form::hidden('id', $note->notes_id) !!}
                                        {!! Form::submit(trans('Delete'), ['class' => 'btn btn-danger delete', 'name' => 'delete_modal']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                    
                                    
                                </tr>
                                </table>
                                
                            </div>
                        </div>
                    </div>    
                @endif
            @endif
    
@endsection

@section('script')
<script type="text/javascript">
    $('table[data-form="deleteForm"]').on('click', '.form-delete', function(e){
    e.preventDefault();
    var $form=$(this);
    $('#confirm').modal({ backdrop: 'static', keyboard: false })
        .on('click', '#delete-btn', function(){
            //$form.submit();
        });
});
</script>
@endsection
