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

   <div class="text-right">
    {{ $total }}
   </div>

  </div>

 </div>
</div>
@endsection