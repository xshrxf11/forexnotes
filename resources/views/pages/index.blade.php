@extends('layouts.app')

@section('content')   
    <div class="jumbotron text-center">
    @if (Route::has('login'))
        
        
            {{--  <a class="btn btn-primary btn-lg" href="/login" role="button">Login</a>
            <a class="btn btn-success btn-lg" href="/register" role="button">Register</a>  --}}
            
                    @auth
                        <h1>Welcome, <?php echo $username; ?></h1>
                        <a class="btn btn-primary btn-lg" href="/dashboard">Get Started <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                    @else
                        <h1><?php echo $title; ?></h1>
                        <p>Notes that track your Forex</p>
                        <p>
                            <a class="btn btn-primary btn-lg" href="{{ route('login') }}" role="button">Login</a>
                            <a class="btn btn-success btn-lg" href="{{ route('register') }}" role="button">Register</a>
                        </p>
                    @endauth
    @endif
        
    </div>
@endsection

