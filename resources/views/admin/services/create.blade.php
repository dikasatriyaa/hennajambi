@extends('admin.layout.main')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Tambah Service
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/service">Services</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Service</li>
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
                    <h4 class="card-title">Form Tambah Service</h4>
                    <form action="/service" method="POST" enctype="multipart/form-data">
                        
                        @csrf
                        <input type="text" class="form-control" id="toko_id" name="toko_id" hidden value="{{auth()->user()->toko->id}}">
                        
                        <div class="form-group">
                            <label for="name">Nama Service</label>
                            <input type="text" class="form-control" id="name" name="name" >
                        </div>
                        <div class="form-group">
                            <label for="price">Harga</label>
                            <input type="text" class="form-control" id="price" name="price" >
                        </div>
                        <div class="form-group">
                            <label for="category">Kategori</label>
                            <input type="text" class="form-control" id="category" name="category" >
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" ></textarea>
                        </div>
                        <div class="form-group">
                            <label for="images">Gambar</label>
                            <input type="file" class="form-control-file" id="images" name="images[]" multiple>
                            <div id="image-preview" class="mt-3">
                                <!-- Gambar yang diupload akan tampil di sini -->
                            </div>
                        </div>
                        <button type="submit" class="btn btn-gradient-primary mr-2">Simpan</button>
                        <a href="/service" class="btn btn-light">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('images').addEventListener('change', function() {
    const previewContainer = document.getElementById('image-preview');
    previewContainer.innerHTML = ''; // Clear previous previews
    const files = this.files;
    Array.from(files).forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const imageDiv = document.createElement('div');
            imageDiv.classList.add('image-preview-item');
            imageDiv.innerHTML = `
                <img src="${e.target.result}" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                <button type="button" class="btn btn-danger btn-sm" onclick="removePreview(this)">X</button>
            `;
            previewContainer.appendChild(imageDiv);
        };
        reader.readAsDataURL(file);
    });
});

function removePreview(button) {
    button.parentElement.remove();
}
</script>
@endsection
