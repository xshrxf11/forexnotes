@extends('layouts.app')

@section('content')

    <h1>Edit Note</h1>
            {!! Form::open(['action' => ['NotesController@update', $note->notes_id] , 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    {{Form::label('news','News')}}
                    {{Form::text('news', $note->notes_news, ['class' => 'form-control', 'placeholder'=>'News'])}}
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            {{Form::label('currency','Currency')}}
                            {{Form::select('currency', ['RM' => 'Ringgit Malaysia', 'USD' => 'US Dollar'], $note->notes_currency, ['class' => 'form-control','placeholder' => 'Currency'])}}
                        </div>
                        <div class="col-md-6">
                            {{Form::label('moving_market','Moving Market')}}
                            {{Form::select('moving_market', ['Buy' => 'Buy', 'Sell' => 'Sell'], $note->notes_moving_market, ['class' => 'form-control','placeholder' => 'Moving Market'])}}

                        </div>
                    </div>    
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            {{Form::label('previous','Previous')}}
                            {{Form::text('previous', $note->notes_prev, ['class' => 'form-control', 'placeholder'=>'Previous'])}}
                            
                        </div>
                        <div class="col-md-6">
                            {{Form::label('constant','Constant')}}
                            {{Form::text('constant', $note->notes_const, ['class' => 'form-control', 'placeholder'=>'Constant'])}}
                            
                        </div>
                    </div>
                    
                </div>

                <hr>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            {{--  Before Image  --}}
                                {{Form::label('Before Image')}}
                                {{Form::file('before_image')}}
                        </div>

                        <div class="col-md-6">
                            {{--  After Image  --}}
                                {{Form::label('After Image')}}
                                {{Form::file('after_image')}}
                        </div>
                    </div>
                </div>
                <hr>


                {{--  Bloomberg Status  --}}
                <div class="form-group">
                            {{Form::label('bloomberg_status','Bloomberg')}}
                            &nbsp;
                            @if ($note->notes_bloomberg_status == 1)
                                {{Form::radio('bloomberg_status', '1', true)}} Yes
                                {{Form::radio('bloomberg_status', '0')}} No
                            @else
                                {{Form::radio('bloomberg_status', '1')}} Yes
                                {{Form::radio('bloomberg_status', '0', true)}} No
                            @endif
                            
                </div>

                <hr>

                <div class="form-group">
                    {{Form::label('summary','Summary')}}
                    {{Form::textarea('summary', $note->notes_summary, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder'=>'Summary'])}}
                </div>

                {{Form::hidden('_method','PUT')}}
                {{Form::submit('Edit', ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
    
@endsection