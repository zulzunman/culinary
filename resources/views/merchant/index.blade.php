@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            @forelse($data as $item)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="bg-primary text-white text-center p-3">
                            <img src="{{ asset($item->ktp_picture) }}" class="rounded-circle mb-2" width="120" height="120"
                                alt="Profile">
                            <h5 class="mb-1">{{ $item->name }}</h5>
                            <small>NIK: {{ $item->nik }}</small>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="mb-2"><strong>Gender:</strong> {{ $item->gender }}</li>
                                <li class="mb-2"><strong>Phone:</strong> {{ $item->phone }}</li>
                                <li class="mb-2"><strong>City:</strong> {{ $item->city_id }}</li>
                                <li class="mb-2"><strong>Religion:</strong> {{ $item->religion_id }}</li>
                            </ul>
                            <hr>
                            <p class="text-muted">deskripsi: {{ $item->address }}</p>
                        </div>
                        <div class="card-footer text-center ">
                            <button class="btn rounded-pill btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editMerchantModal{{ $item->id }}">
                                Edit Profile
                            </button>
                        </div>
                    </div>
                    @include('merchant.edit', ['merchantProfile' => $item])
                </div>
            @empty
                <div class="col-12 text-center">
                    <div class="alert alert-info">No merchant profiles found.</div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
