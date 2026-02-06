@extends('layouts.admin.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <p class="mb-0" style="color: #38527E"><a href="" class="text-decoration-none">Perpus SMPN 3 Tapango</a> /
                Kategori Buku / Tambah Kategori</p>
        </div>
        <!-- Content Row -->
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="col-md-12">
                            <h5 class="mb-4">Tambah Kategori Buku</h5>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="name">Nama Kategori</label>
                                <input type="text" value="{{ old('name') }}"
                                    class="form-control @error('name')
                                    is-invalid
                                @enderror"
                                    id="name" name="name">

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
