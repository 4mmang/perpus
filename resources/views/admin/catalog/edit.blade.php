@extends('layouts.admin.master')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <p class="mb-0" style="color: #38527E">
                <a href="" class="text-decoration-none">Perpus SMPN 3 Tapango</a> /
                Katalog Buku / Edit Buku
            </p>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Buku</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('books.update', $book->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Judul -->
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul Buku</label>
                                <input type="text"
                                       name="title"
                                       id="title"
                                       value="{{ old('title', $book->title) }}"
                                       class="form-control @error('title') is-invalid @enderror"
                                       required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Kategori -->
                            <div class="mb-3">
                                <label for="category" class="form-label">Kategori</label>
                                <select name="category_id"
                                        id="category"
                                        class="form-control @error('category_id') is-invalid @enderror"
                                        required>
                                    <option disabled value="">Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Penulis -->
                            <div class="mb-3">
                                <label for="author" class="form-label">Penulis</label>
                                <input type="text"
                                       name="author"
                                       id="author"
                                       value="{{ old('author', $book->author) }}"
                                       class="form-control @error('author') is-invalid @enderror"
                                       required>
                                @error('author')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tahun Terbit -->
                            <div class="mb-3">
                                <label for="publication_year" class="form-label">Tahun Terbit</label>
                                <input type="number"
                                       name="publication_year"
                                       id="publication_year"
                                       value="{{ old('publication_year', $book->publication_year) }}"
                                       class="form-control @error('publication_year') is-invalid @enderror"
                                       min="1900"
                                       max="{{ date('Y') }}"
                                       required>
                                @error('publication_year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Stok -->
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stok</label>
                                <input type="number"
                                       name="stock"
                                       id="stock"
                                       value="{{ old('stock', $book->stock) }}"
                                       class="form-control @error('stock') is-invalid @enderror"
                                       required>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('books.index') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
