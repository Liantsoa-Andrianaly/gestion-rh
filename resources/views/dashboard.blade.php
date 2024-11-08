@extends('layouts.template')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h2 class="page-title" style="color:#227BFF; font-family:poppins">TABLEAU DE BORD</h2>
    <a href="{{ route('configurations') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-fw fa-chart-area"></i> Configuration
    </a>
</div>

@if (!empty($paymentNotification))
    <div class="alert alert-warning"><b>Attention: </b>{{ $paymentNotification }}</div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Content Row -->
<div class="row">

    <!-- Total des employés -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Total des employés</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalEmployes }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x "></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tous les projets terminés -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tous les projets terminés</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $totalProjects }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x "></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Prix total des projets -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Prix total des projets</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($remainingProjectPrice, 0, ',', ' ') }} Ar</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-coins fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                        Total des paiements en {{ Carbon\Carbon::create(null, $currentMonth)->locale('fr')->monthName }} {{ $currentYear }} </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($sum, 2, ',', ' ') }} Ar</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-coins fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
</div>

@endsection
