@extends('stisla.layouts.app-table')

@section('title')
  {{ $title = 'Transaction' }}
@endsection

@section('content')
  <div class="section-header">
    <h1>{{ $title }}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active">
        <a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a>
      </div>
      <div class="breadcrumb-item">{{ $title }}</div>
    </div>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4><i class="fa fa-table"></i> Device Transaction</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="datatable">
                <thead>
                  <tr>
                    <th class="text-center">
                      #
                    </th>
                    <th>PIN</th>
                    <th>Name</th>
                    <th>Time</th>
                    <th>Device</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $index => $transaction)
                    <tr>
                      <td class="text-center">{{ $index + 1 }}</td>
                      <td>{{ $transaction->pin }}</td>
                      <td>{{ $transaction->name }}</td>
                      <td>{{ \Carbon\Carbon::parse($transaction->checktime)->format('d/m/y H:i:s') }}</td>
                      <td>{{ $transaction->device }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
