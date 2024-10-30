@extends('stisla.layouts.app')

@section('title', 'Finger Machine')

@section('content')
@php
use Carbon\Carbon;
@endphp
<section class="section">
    <div class="section-header">
        <h1>Finger Machine</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a>
            </div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">All Machine</h2>
        <p class="section-lead">All Finger Machine PT. Tesco Indomaritim.</p>
        <div>
            <a href="{{ route('finger-machine.transaction') }}" class="btn btn-success">Show All Transaction</a>
        </div>
        </br>


        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>SN</th>
                    <th>Alias</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $fingerprint)
                <tr>
                    <td>{{ $fingerprint->SN }}</td>
                    <td>{{ $fingerprint->Alias }}</td>
                    <td>
                        @if (Carbon::parse($fingerprint->LastActivity)->isToday())
                        <span class="text-success"><i class="fas fa-check-circle"></i> Online</span>
                        @else
                        <span class="text-danger"><i class="fas fa-times-circle"></i> Offline</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('finger-machine.detail', ['SN' => $fingerprint->SN]) }}" class="btn btn-info btn-sm">
                            Show Data <i class="fas fa-arrow-right"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

<style>
    .table {
        width: 100%;
        margin: 20px 0;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        padding: 12px;
        text-align: left;
        border: 1px solid #dee2e6;
    }

    .table thead th {
        background-color: #343a40;
        color: white;
    }

    .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-info:hover {
        background-color: #138496;
        border-color: #117a8b;
    }
</style>

@endsection