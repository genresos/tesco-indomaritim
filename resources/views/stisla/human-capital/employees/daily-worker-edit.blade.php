@extends('stisla.layouts.app')

@section('content')
<div class="section-header">
  <h1>Edit</h1>
</div>
<div class="section-body">

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4><i class="fas fa-user-edit"></i> Edit Worker</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('employees.daily-worker.update', $data->badgenumber) }}" method="POST" enctype="multipart/form-data" id="formAction">
            @csrf
            @method('PUT')

            <div class="row">
              <div class="col-md-6">
                @include('stisla.includes.forms.inputs.input', [
                'id' => 'badgenumber',
                'name' => 'badgenumber',
                'label' => __('PIN'),
                'type' => 'text',
                'value' => $data->badgenumber,
                'required' => true,
                'icon' => 'fas fa-id-card',
                'attributes' => ['readonly' => 'readonly']
                ])
              </div>

              <div class="col-md-6">
                @include('stisla.includes.forms.inputs.input', [
                'id' => 'name',
                'name' => 'name',
                'label' => __('Name'),
                'type' => 'text',
                'value' => $data->name,
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
                'selected' => $data->status,
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
                'value' => $data->nik,
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
                'selected' => $data->site,
                'with_all' => true,
                ])
              </div>

              <div class="col-md-6">
                @include('stisla.includes.forms.inputs.input', [
                'id' => 'department',
                'name' => 'department',
                'label' => __('Department'),
                'type' => 'text',
                'value' => $data->department,
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
                'value' => $data->bank_name,
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
                'value' => $data->bank_account_no,
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
                'value' => $data->bank_account_name,
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
                'value' => $data->rate,
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
                'value' => $data->meal_allowance_perday,
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
                'value' => $data->personal_loan,
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
                'value' => $data->installment_loan,
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
                'value' => $data->rapel,
                'required' => false,
                'icon' => 'fas fa-dollar',
                'step' => 'any',
                ])
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="salary_type">{{ __('Payroll Type') }}</label>
                  <select id="salary_type" name="salary_type" class="form-control" required>
                    <option value="" disabled {{ !$data->salary_type ? 'selected' : '' }}>{{ __('Select Payroll Type') }}</option>
                    <option value="1" {{ $data->salary_type == 1 ? 'selected' : '' }}>1 Week</option>
                    <option value="2" {{ $data->salary_type == 2 ? 'selected' : '' }}>2 Week</option>
                    <option value="3" {{ $data->salary_type == 3 ? 'selected' : '' }}>3 Week</option>
                  </select>
                  <div class="invalid-feedback">
                    Please select a payroll type.
                  </div>
                </div>
              </div>

              <div class="col-md-12" id="formAreaButton">
                <br>
                <div class="d-flex justify-content-between">
                  @include('stisla.includes.forms.buttons.btn-save')
          </form>

          <div class="ml-auto">
            <!-- Delete Button Form -->
            <form action="{{ route('employees.daily-worker.destroy', $data->badgenumber) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this worker?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash"></i> Delete
              </button>
          </div>
        </div>
      </div>

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