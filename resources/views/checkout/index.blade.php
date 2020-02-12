@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex row align-items-center justify-content-center">

            <div class="col-md-10">

                @foreach($carts as $cart)
                    <div class="card my-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 font-weight-bold">
                                    <strong class="">{{ $cart->itemPembayaran->nama }}</strong>
                                </div>
                                <div class="col-md-6 text-right ">
                                    {{ $cart->itemPembayaran->harga }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


                <div class="my-3">
                    <div class="d-flex flex-row display-4 text-primary font-weight-bold justify-content-end">
                        <div class="mr-1">Total Rp.</div>
                        <currency price="{{ $total }}"/>
                    </div>

                    <div class="d-flex justify-content-end my-2">
                        <button type="button" class="btn btn-outline-success btn-lg">Lakukan Pembayaran</button>
                    </div>
                </div>


            </div>

        </div>
    </div>
@endsection
