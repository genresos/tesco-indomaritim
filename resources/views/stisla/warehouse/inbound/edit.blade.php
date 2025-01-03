@extends('stisla.layouts.app')

@section('content')
<div class="section-header">
    <h1>Update</h1>
</div>
<div class="section-body">

    <!-- Menampilkan pesan error jika ada -->
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-warehouse"></i> Update Data</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('warehouse.inbound.update', ['id' => $id]) }}" method="POST" enctype="multipart/form-data" id="formAction">

                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">{{ __('Status') }}</label>
                                    <select id="status" name="status" class="form-control" required>
                                        <option value="" disabled selected>{{ __('Select Status') }}</option>
                                        <option value="Partially">Partially</option>
                                        <option value="Closed">Closed</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a status.
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
</div>
@endsection

@push('css')
@endpush

@push('js')
@endpush

@push('scripts')
@endpush