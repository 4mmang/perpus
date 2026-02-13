@extends('layouts.admin.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <p class="mb-0" style="color: #38527E"><a href="" class="text-decoration-none">Perpus SMPN 3 Tapango</a> /
                Dashboard</p>
        </div>
        <!-- Content Row -->
        <div class="row"> 
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 ms-3">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Kategori Buku</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCategory }}</div>
                            </div>
                            <div class="col-auto mr-3">
                                <i class="fas fa-blog fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 ms-3">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Buku</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBook }}</div>
                            </div>
                            <div class="col-auto mr-3">
                                <i class="fas fa-bullhorn fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 ms-3">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Status Pending</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalStatusPending }}</div>
                            </div>
                            <div class="col-auto mr-3">
                                <i class="fas fa-question-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 ms-3">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Status Dipinjam</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalStatusBorrowed }}</div>
                            </div>
                            <div class="col-auto mr-3">
                                <i class="fas fa-question-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 ms-3">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Status Dikembalikan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalStatusReturned }}</div>
                            </div>
                            <div class="col-auto mr-3">
                                <i class="fas fa-question-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 ms-3">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Status Terlambat</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalStatusOverdue }}</div>
                            </div>
                            <div class="col-auto mr-3">
                                <i class="fas fa-question-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
