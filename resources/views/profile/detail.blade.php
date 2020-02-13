@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex row align-items-center justify-content-center">
            @if(count($pembayaran->detail) > 0)
                <form class="col-md-12" action="{{ action('PembayaranController@create') }}" method="post">
                    {{ csrf_field() }}
                    <div>
                        @foreach($pembayaran->detail as $detail)
                            <input type="hidden" name="carts[]"
                                   value="{{ implode(",", [$detail->cart->id, $detail->cart->itemPembayaran->harga]) }}"/>

                            <div class="card my-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 font-weight-bold">
                                            <div
                                                class="font-weight-bold">{{ $detail->cart->itemPembayaran->nama }}</div>
                                        </div>
                                        <div
                                            class="col-md-6 text-right ">

                                            <div class="row d-flex justify-content-center align-items-center ">
                                                <div class="col-md-10">
                                                    <currency
                                                        price="{{ intval($detail->cart->itemPembayaran->harga) }}"/>
                                                </div>
                                                <div class="col-md-2 px-2">
                                                    <button-delete-item item="{{ $detail->cart->id  }}"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                        <div class="my-3">
                            <div class="d-flex flex-row display-4 text-primary font-weight-bold justify-content-end">
                                <div class="mr-1">Total Rp.</div>
                                <currency price="{{ intval($total) }}"/>
                            </div>
                            @if(!$pembayaran->is_paid)
                                <div class="d-flex justify-content-end my-2">
                                    <button type="submit" class="btn btn-outline-success btn-lg">Lakukan Pembayaran
                                    </button>
                                </div>
                            @endif
                        </div>


                    </div>
                </form>
            @else
                <div class="col-md-12">
                    <p>Item pembayaran masih kosong</p>
                </div>
            @endif

        </div>
    </div>
@endsection


