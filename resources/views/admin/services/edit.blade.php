<!-- resources/views/services/edit.blade.php -->

@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Edit Service
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Services</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Service</li>
            </ul>
        </nav>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Edit Service</h4>
                    <form action="{{ route('services.update', ['service' => $service->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Nama Service</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $service->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Harga</label>
                            <input type="text" class="form-control" id="price" name="price" value="{{ $service->price }}" required>
                        </div>
                        <div class="form-group">
                            <label for="category">Kategori</label>
                            <input type="text" class="form-control" id="category" name="category" value="{{ $service->category }}" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required>{{ $service->deskripsi }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Gambar Saat Ini</label><br>
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" style="max-width: 200px;">
                        </div>
                        <div class="form-group">
                            <label for="new_image">Ganti Gambar</label>
                            <input type="file" class="form-control-file" id="new_image" name="new_image">
                        </div>
                        <button type="submit" class="btn btn-gradient-primary mr-2">Simpan Perubahan</button>
                        <a href="{{ route('services.index') }}" class="btn btn-light">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
