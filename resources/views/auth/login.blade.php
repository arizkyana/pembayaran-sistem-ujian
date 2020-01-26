@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex row justify-content-center align-items-center">
        <div class="col-md-4">
            @if(session('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
            @endif
            <form action="{{ route('login') }}" method="post">
                {{ csrf_field() }}
                <div class="card ">
                    <div class="card-header">
                        <b>Login</b>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" />
                            @if($errors->has('email'))
                            <span class="text-danger text-small">
                                <small>{{ $errors->first('email') }}</small>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" />
                            @if($errors->has('password'))
                            <span class="text-danger text-small">
                                <small>{{ $errors->first('password') }}</small>
                            </span>
                            @endif
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-small btn-primary btn-block">Masuk</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection