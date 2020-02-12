@extends('layouts.app')

@section('content')
    <div class="container vh-100">
        <div class="d-flex align-items-center justify-content-center">

            <div class="col-md-10 ">
                <form action="{{ action('CheckoutController@upload')  }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div>
                        <dragger name="pembayaran" />
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-outline-primary ">Upload bukti pembayaran</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
