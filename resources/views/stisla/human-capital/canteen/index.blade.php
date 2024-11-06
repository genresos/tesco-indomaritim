@extends('stisla.layouts.app-datatable')

@section('table')
@php
$canAction = $canUpdate || $canDelete;
$checkInCount = $totalcekintoday; // Ambil jumlah check-in dari controller
$checkOutCount = $totalcekouttoday; // Ambil jumlah check-out dari controller
@endphp

<div>
    <div class="d-flex justify-content-between mb-3">
        <div>
            <a href="{{ route('canteen.fetchData') }}" class="btn btn-success">
                <i class="fas fa-file-import"></i> Sync Data
            </a> <!-- Import Worker button with icon -->
        </div>
    </div>

    <!-- Statistik Boxes -->
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Check In</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-sign-in-alt fa-3x" style="color: #36A2EB;"></i>
                        </div>
                        <div class="text-right">
                            <h3 class="mb-0">{{ $checkInCount }}</h3>
                            <div class="text-muted">Total Check In</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Check Out</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-sign-out-alt fa-3x" style="color: #FF6384;"></i>
                        </div>
                        <div class="text-right">
                            <h3 class="mb-0">{{ $checkOutCount }}</h3>
                            <div class="text-muted">Total Check Out</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </br>

    <table class="table table-striped" id="datatable" data-export="true" data-title="{{ $title }}">
        <thead>
            <tr>
                <th>{{ __('PIN') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Check In') }}</th>
                <th>{{ __('Check Out') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->checkin }}</td>
                <td>{{ $item->checkout }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection