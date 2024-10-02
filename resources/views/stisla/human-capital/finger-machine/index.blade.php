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
        <center>
            <a href="{{ route('finger-machine.transaction') }}" class="btn btn-success">Show All Transaction</a>
        </center>  
        </br>


        <div class="row">
            @foreach ($data as $fingerprint)
            <div class="col-12 col-md-2 col-lg-2">
                <div class="pricing" style="padding: 10px;">
                    <div class="pricing-title" style="font-size: 1.2rem;">
                        {{ $fingerprint->Alias }} <!-- Tampilkan value dari 'Alias' -->
                    </div>
                    <div class="pricing-padding">
                        <div class="pricing-price">
                            <div style="font-size: 1.5rem;">
                                <strong class="fas fa-fingerprint" style="font-size: 2rem;"></strong>
                            </div>
                        </div>
                        <div class="pricing-details">
                            <div class="pricing-item">
                                @if (Carbon::parse($fingerprint->LastActivity)->isToday())
                                    <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                    <div class="pricing-item-label" style="font-size: 0.8rem;">Online</div>
                                @else
                                    <div class="pricing-item-icon bg-danger text-white"><i class="fas fa-times"></i></div>
                                    <div class="pricing-item-label" style="font-size: 0.8rem;">Offline</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="pricing-cta">
                        <a href="{{ route('finger-machine.detail', ['SN' => $fingerprint->SN]) }}" style="font-size: 0.9rem;">Show Data <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
