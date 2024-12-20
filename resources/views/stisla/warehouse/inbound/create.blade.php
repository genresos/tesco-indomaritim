@extends('stisla.layouts.app')

@section('content')
<div class="section-header">
    <h1>Create</h1>
</div>
<div class="section-body">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-warehouse"></i> Input Data</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('warehouse.inbound.store') }}" method="POST" enctype="multipart/form-data" id="formAction">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="site">{{ __('Site') }}</label>
                                    <select id="site" name="site" class="form-control" required>
                                        <option value="" disabled selected>{{ __('Select Site') }}</option> <!-- Ganti ! untuk selected -->
                                        <option value="TM5">TM5 Babelan</option>
                                        <option value="TLD">Tulodong</option>
                                        <!-- <option value="3">3 Week</option> -->
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a site.
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                @include('stisla.includes.forms.inputs.input', [
                                'id' => 'est_date',
                                'name' => 'est_date',
                                'label' => __('Est. Date'),
                                'type' => 'date',
                                'value' => '', // Kosongkan value
                                'required' => true,
                                'icon' => 'fas fa-calendar-alt', // Icon for date picker
                                ])
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="est_time">{{ __('Est. Time') }}</label>
                                    <select id="est_time" name="est_time" class="form-control" required>
                                        <option value="" disabled selected>{{ __('Select time') }}</option> <!-- Ganti ! untuk selected -->
                                        <option value="PAGI">PAGI</option>
                                        <option value="SIANG">SIANG</option>
                                        <option value="SORE">SORE</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a time.
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                @include('stisla.includes.forms.inputs.input', [
                                'id' => 'vendor',
                                'name' => 'vendor',
                                'label' => __('Vendor'),
                                'type' => 'text',
                                'value' => '', // Kosongkan value
                                'required' => true,
                                'icon' => 'fas fa-users',
                                ])
                            </div>

                            <div class="col-md-6">
                                @include('stisla.includes.forms.inputs.input', [
                                'id' => 'po_number',
                                'name' => 'po_number',
                                'label' => __('PO. Number'),
                                'type' => 'text',
                                'value' => '', // Kosongkan value
                                'required' => true,
                                'icon' => 'fas fa-file-invoice',
                                ])
                            </div>

                            <div class="col-md-6">
                                @include('stisla.includes.forms.inputs.input', [
                                'id' => 'wo_number',
                                'name' => 'wo_number',
                                'label' => __('WO. Number'),
                                'type' => 'text',
                                'value' => '', // Kosongkan value
                                'required' => false,
                                'icon' => 'fas fa-file-invoice',
                                ])
                            </div>

                            <div class="col-md-6">
                                @include('stisla.includes.forms.inputs.input', [
                                'id' => 'project_name',
                                'name' => 'project_name',
                                'label' => __('Project Name'),
                                'type' => 'text',
                                'value' => '', // Kosongkan value
                                'required' => true,
                                'icon' => 'fas fa-project-diagram',
                                ])
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company">{{ __('Company') }}</label>
                                    <select id="company" name="company" class="form-control" required>
                                        <option value="" disabled selected>{{ __('Select company') }}</option> <!-- Ganti ! untuk selected -->
                                        <option value="TESCO">TESCO</option>
                                        <option value="MARMIN">MARMIN</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a company.
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