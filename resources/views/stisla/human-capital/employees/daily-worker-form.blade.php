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

<div class="section-body">
  <h2 class="section-title">{{ $fullTitle }}</h2>
  <p class="section-lead">{{ __('Menampilkan halaman ' . $fullTitle) }}.</p>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4><i class="{{ $moduleIcon }}"></i> {{ $fullTitle }}</h4>

          <div class="card-header-action">
            @include('stisla.includes.forms.buttons.btn-view', ['link' => $routeIndex])
          </div>
        </div>
        <div class="card-body">
          <form action="{{ $action }}" method="POST" enctype="multipart/form-data" id="formAction">
            @isset($d)
            @method('PUT')
            @endisset

            @csrf
            <div class="row">
              <div class="col-md-6 mx-auto">
                <div class="form-group">
                  <label for="salary_type">{{ __('Payroll Type') }}</label>
                  <select id="salary_type" name="salary_type" class="form-control" required>
                    <option value="" disabled selected>{{ __('Select Payroll Type') }}</option>
                    <option value="1">1 Week</option>
                    <option value="2">2 Week</option>
                    <option value="3">1 Month</option>
                  </select>
                  <div class="invalid-feedback">
                    Please select a payroll type.
                  </div>
                </div>
              </div>

              <div class="col-md-6 mx-auto">
                <div class="form-group">
                  <label>{{ __('Site Work') }}</label>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="site[]" value="TLD" id="siteTLD">
                    <label class="form-check-label" for="siteTLD">Tulodong</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="site[]" value="TM5" id="siteTM5">
                    <label class="form-check-label" for="siteTM5">TM 5 Bekasi</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="site[]" value="TM7" id="siteTM7">
                    <label class="form-check-label" for="siteTM7">TM 7 Indramayu</label>
                  </div>
                  <div class="invalid-feedback">
                    Please select at least one site work.
                  </div>
                </div>
              </div>

              <div class="col-md-12 text-center">
                <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="locked" name="locked">
                  <label class="form-check-label" for="locked">{{ __('Lock Current Period ?') }}</label>
                </div>
              </div>
            </div>


        </div>
        <div class="row justify-content-center">
          <div class="col-md-4 text-center" id="formAreaButton">
            <br>
            @include('stisla.includes.forms.buttons.btn-process', ['class' => 'btn btn-primary']) <!-- Add any additional classes as needed -->
          </div>
        </div>
        </br>
        </form>
      </div>
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