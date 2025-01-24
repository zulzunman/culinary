@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="card">
        <h5 class="card-header">Pembayaran Pertama</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>nominal</th>
                        <th>tanggal tf</th>
                        <th>bukti tf</th>
                        <th>status</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>1</td>
                        <td>{{ $iPay->currency }}</td>
                        <td>{{ $iPay->date }}</td>
                        <td>
                            @if ($iPay->photo)
                                <img src="{{ asset($iPay->photo) }}" class="preview-image" id="booth_preview"
                                    alt="Transfer Proof" width="100">
                            @else
                                No image available
                            @endif
                        </td>
                        <td>{{ $iPay->status }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
