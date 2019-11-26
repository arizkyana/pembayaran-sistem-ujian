@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex row align-items-center justify-content-center">

        <div class="col-md-10">

            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    <div class>Fulan bin Fulan</div>
                    <div class="text-secondary">Kelas XI</div>
                    <div class="my-3 ">
                        <form action="">
                            <div class="form-group">
                                <select name="semester" id="semester" class="form-control">
                                    <option value="">Pilih semester</option>
                                    @foreach ($semester as $item)
                                    <option value="{{ $item->kode_semester }}">{{ $item->label }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($item_pembayaran as $item)
                <div class="col-md-4 mt-4">
                    <div class="card">
                        <div class="card-body">
                            {{ $item->nama }}
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary btn-sm btn-block">Bayar</button>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>

        </div>

    </div>
</div>
@endsection
