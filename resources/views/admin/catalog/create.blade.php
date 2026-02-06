@extends('layouts.admin.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <p class="mb-0" style="color: #38527E"><a href="" class="text-decoration-none">Perpus SMPN 3 Tapango</a> /
                Katalog Buku / Tambah Buku</p>
        </div>
        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Tambah Buku</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('books.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul Buku</label>
                                <input type="text" value="{{ old('title') }}"
                                    class="form-control @error('title')
                                    is-invalid
                                @enderror"
                                    id="title" name="title" required>
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Kategori</label>
                                <select name="category_id" id="category" class="form-control" required>
                                    <option selected disabled value="">Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="author" class="form-label">Penulis</label>
                                <input type="text" value="{{ old('author') }}"
                                    class="form-control @error('author')
                                    is-invalid
                                @enderror"
                                    id="author" name="author" required>
                                @error('author')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="publication_year" class="form-label">Tahun Terbit (Contoh: 2020)</label>
                                <input type="number" value="{{ old('publication_year') }}"
                                    class="form-control @error('publication_year')
                                    is-invalid
                                @enderror"
                                    id="publication_year" name="publication_year" required>
                                @error('publication_year')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stok</label>
                                <input type="number" value="{{ old('stock') }}"
                                    class="form-control @error('stock')
                                    is-invalid
                                @enderror"
                                    id="stock" name="stock" required>
                                @error('stock')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
