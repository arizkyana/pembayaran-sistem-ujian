@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex row justify-content-center align-items-center">
        <div class="col-md-4">
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
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" />
                        </div>

                    </div>

                    <div class="card-footer">
                        <button class="btn btn-small btn-primary btn-block">Masuk</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection
