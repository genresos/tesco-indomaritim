@extends('stisla.layouts.app')

@section('title')
{{ $fullTitle }}
@endsection

@section('content')
<div class="section-header">
  <h1>{{ $title }}</h1>
  @include('stisla.includes.breadcrumbs.breadcrumb', [
  'breadcrumbs' => $breadcrumbs,
  ])
</div>
@if(session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
@endif
<div class="section-body">
  <h2 class="section-title">{{ $fullTitle }}</h2>
  <p class="section-lead">{{ __('Menampilkan halaman ' . $fullTitle) }}.</p>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4><i class="{{ $moduleIcon }}"></i> {{ $fullTitle }}</h4>

        </div>
        <div class="card-body">
          <form action="{{ route('employees.daily-worker.attendance-upload-store') }}" method="POST" enctype="multipart/form-data" id="formAction">
            @isset($d)
            @method('PUT')
            @endisset

            @csrf
            
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="attendance">{{ __('Upload Attendance') }}</label>
              <input type="file" id="attendance" name="attendance" class="form-control" required>
              <div class="invalid-feedback">
                Please upload the attendance file.
              </div>
            </div>
          </div>

          <div class="col-md-12" id="formAreaButton">
            <br>
            @include('stisla.includes.forms.buttons.btn-save')
            @include('stisla.includes.forms.buttons.btn-reset')
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
@endpush

@push('scripts')
@include('stisla.includes.scripts.disable-form')
@endpush
