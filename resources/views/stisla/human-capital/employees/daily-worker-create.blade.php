@extends('stisla.layouts.app')

@section('content')
<div class="section-header">
  <h1>Add</h1>
</div>
<div class="section-body">

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4><i class="fas fa-user-plus"></i> Add Worker</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('employees.daily-worker.storenew') }}" method="POST" enctype="multipart/form-data" id="formAction">
            @csrf

            <div class="row">
              <div class="col-md-6">
                @include('stisla.includes.forms.inputs.input', [
                'id' => 'badgenumber',
                'name' => 'badgenumber',
                'label' => __('PIN'),
                'type' => 'text',
                'value' => '', // Kosongkan value
                'required' => true,
                'icon' => 'fas fa-id-card'
                ])
              </div>

              <div class="col-md-6">
                @include('stisla.includes.forms.inputs.input', [
                'id' => 'name',
                'name' => 'name',
                'label' => __('Name'),
                'type' => 'text',
                'value' => '', // Kosongkan value
                'required' => true,
                'icon' => 'fas fa-user',
                ])
              </div>

              <div class="col-md-6">
                @include('stisla.includes.forms.selects.select', [
                'id' => 'status',
                'name' => 'status',
                'label' => __('Status'),
                'options' => [
                'TK/0' => 'TK/0',
                'K0' => 'K0',
                'K1' => 'K1',
                'K2' => 'K2',
                'K3' => 'K3',
                ],
                'selected' => null, // Kosongkan selected
                'required' => true,
                'icon' => 'fas fa-comment',
                ])
              </div>

              <div class="col-md-6">
                @include('stisla.includes.forms.inputs.input', [
                'id' => 'nik',
                'name' => 'nik',
                'label' => __('NIK'),
                'type' => 'number',
                'value' => '', // Kosongkan value
                'required' => true,
                'icon' => 'fas fa-credit-card',
                'attributes' => [
                'min' => '0',
                'step' => '1',
                ],
                ])
              </div>

              <div class="col-md-6">
                @include('stisla.includes.forms.selects.select', [
                'id' => 'site',
                'name' => 'site',
                'label' => __('Pilih Site'),
                'options' => [
                'TLD' => 'TLD',
                'TM5' => 'TM5',
                'TM7' => 'TM7',
                ],
                'selected' => null, // Kosongkan selected
                'with_all' => false,
                ])
              </div>

              <div class="col-md-6">
                @include('stisla.includes.forms.inputs.input', [
                'id' => 'department',
                'name' => 'department',
                'label' => __('Department'),
                'type' => 'text',
                'value' => '', // Kosongkan value
                'required' => true,
                'icon' => 'fas fa-sitemap',
                ])
              </div>

              <div class="col-md-6">
                @include('stisla.includes.forms.inputs.input', [
                'id' => 'bank_name',
                'name' => 'bank_name',
                'label' => __('Bank Name'),
                'type' => 'text',
                'value' => '', // Kosongkan value
                'required' => true,
                'icon' => 'fas fa-university',
                ])
              </div>

              <div class="col-md-6">
                @include('stisla.includes.forms.inputs.input', [
                'id' => 'bank_account_no',
                'name' => 'bank_account_no',
                'label' => __('Bank Account No'),
                'type' => 'text',
                'value' => '', // Kosongkan value
                'required' => true,
                'icon' => 'fas fa-credit-card',
                ])
              </div>

              <div class="col-md-6">
                @include('stisla.includes.forms.inputs.input', [
                'id' => 'bank_account_name',
                'name' => 'bank_account_name',
                'label' => __('Bank Account Name'),
                'type' => 'text',
                'value' => '', // Kosongkan value
                'required' => true,
                'icon' => 'fas fa-user-circle',
                ])
              </div>

              <div class="col-md-6">
                @include('stisla.includes.forms.inputs.input', [
                'id' => 'rate',
                'name' => 'rate',
                'label' => __('Daily Rate'),
                'type' => 'number',
                'value' => '', // Kosongkan value
                'required' => true,
                'icon' => 'fas fa-dollar',
                'step' => 'any',
                ])
              </div>

              <div class="col-md-6">
                @include('stisla.includes.forms.inputs.input', [
                'id' => 'meal_allowance_perday',
                'name' => 'meal_allowance_perday',
                'label' => __('Meal Allowance Per Day'),
                'type' => 'number',
                'value' => '', // Kosongkan value
                'required' => false,
                'icon' => 'fas fa-money-bill-wave',
                'step' => 'any',
                ])
              </div>

              <div class="col-md-6">
                @include('stisla.includes.forms.inputs.input', [
                'id' => 'personal_loan',
                'name' => 'personal_loan',
                'label' => __('Personal Loan'),
                'type' => 'number',
                'value' => '', // Kosongkan value
                'required' => false,
                'icon' => 'fas fa-dollar',
                'step' => 'any',
                ])
              </div>

              <div class="col-md-6">
                @include('stisla.includes.forms.inputs.input', [
                'id' => 'installment_loan',
                'name' => 'installment_loan',
                'label' => __('Installment Loan'),
                'type' => 'number',
                'value' => '', // Kosongkan value
                'required' => false,
                'icon' => 'fas fa-dollar',
                'step' => 'any',
                ])
              </div>

              <div class="col-md-6">
                @include('stisla.includes.forms.inputs.input', [
                'id' => 'rapel',
                'name' => 'rapel',
                'label' => __('Rapel'),
                'type' => 'number',
                'value' => '', // Kosongkan value
                'required' => false,
                'icon' => 'fas fa-dollar',
                'step' => 'any',
                ])
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="salary_type">{{ __('Payroll Type') }}</label>
                  <select id="salary_type" name="salary_type" class="form-control" required>
                    <option value="" disabled selected>{{ __('Select Payroll Type') }}</option> <!-- Ganti ! untuk selected -->
                    <option value="1">1 Week</option>
                    <option value="2">2 Week</option>
                    <option value="3">3 Week</option>
                  </select>
                  <div class="invalid-feedback">
                    Please select a payroll type.
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