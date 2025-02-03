@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="bg-primary text-white text-center p-3">
                        <img src="{{ asset($data->ktp_picture) }}" class="rounded-circle mb-2" width="120" height="120"
                            alt="Profile">
                        <h5 class="mb-1">{{ $data->name }}</h5>
                        <small>NIK: {{ $data->nik }}</small>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="mb-2"><strong>Gender:</strong> {{ $data->gender }}</li>
                            <li class="mb-2"><strong>Phone:</strong> {{ $data->phone }}</li>
                            <li class="mb-2"><strong>City:</strong> {{ $data->city_id }}</li>
                            <li class="mb-2"><strong>Religion:</strong> {{ $data->religion_id }}</li>
                        </ul>
                        <hr>
                        <p class="text-muted">deskripsi: {{ $data->address }}</p>
                    </div>
                    <div class="card-footer text-center ">
                        <button class="btn rounded-pill btn-primary" data-bs-toggle="modal"
                            data-bs-target="#editMerchantModal{{ $data->id }}">
                            Edit Profile
                        </button>
                    </div>
                </div>
                @include('merchant.edit', ['merchantProfile' => $data])
            </div>
        </div>
    </div>
@endsection
