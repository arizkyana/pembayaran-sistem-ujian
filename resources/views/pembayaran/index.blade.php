@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex row align-items-center justify-content-center">

            <div class="col-md-12 bg-white p-3">

                @if(session('status') === 'success')
                    <div class="alert alert-success text-center" role="alert">
                        {{ session('message') }}
                    </div>
                @endif

                <form action="{{ action('PembayaranController@updateAll')  }}"
                      method="post">
                    {{ csrf_field() }}
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="font-weight-bold">Tanggal</th>
                            <th class="font-weight-bold">No Kwitansi</th>
                            <th class="font-weight-bold">Status</th>
                            <th class="font-weight-bold text-right">Bukti pembayaran</th>
                            <th class="font-weight-bold text-center">Verifikasi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pembayaran as $item)
                            <tr>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->no_kwitansi }}</td>
                                <td>
                                <span class="badge badge-pill badge-{{ $item->is_paid ? 'success' : 'secondary'  }}">
                                    {{ $item->is_paid ? 'Lunas' : 'Belum lunas'  }}
                                </span>
                                </td>
                                <td class="text-right">
                                    @if($item->bukti_pembayaran)
                                        <a href="{{ route('checkout:download', ['no_kwitansi' => $item->no_kwitansi]) }}"
                                           class="btn btn-primary btn-sm">download</a>
                                    @else
                                        <button type="button" class="btn btn-secondary btn-sm" disabled>download
                                        </button>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($item->bukti_pembayaran)
                                        <div class="form-group form-check">
                                            <input type="checkbox" name="verified[]" class="form-check-input"
                                                   value="{{ $item->id  }}">
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-right">

                            </td>
                            <td class="text-center">
                                <button type="submit" class="btn btn-outline-primary btn-block">Update</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>

        </div>
    </div>
@endsection

