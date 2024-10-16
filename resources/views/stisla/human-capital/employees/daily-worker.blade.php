@extends('stisla.layouts.app-datatable')

@section('table')
@php
$canAction = $canUpdate || $canDelete;
@endphp

<div>
    <a href="{{ route('employees.daily-worker.attendance') }}" class="btn btn-success">Show Attendance</a>
    <a href="{{ route('employees.daily-worker.listpayroll') }}" class="btn btn-primary">Payroll</a>
    <a href="{{ route('employees.daily-worker.calculate') }}" class="btn btn-warning">Calculate Payroll</a>

</div>


</br>

<table class="table table-striped" id="datatable" data-export="true" data-title="{{ $title }}">
    <thead>
        <tr>
            <th>{{ __('PIN') }}</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Site') }}</th>
            <th>{{ __('Department') }}</th>
            <th>{{ __('Family Status') }}</th>
            <th>{{ __('Bank Name') }}</th>
            <th>{{ __('Bank Account No') }}</th>
            <th>{{ __('Bank Account Name') }}</th>
            <th>{{ __('Daily Rate') }}</th>
            <th>{{ __('Payroll Type') }}</th>
            <th>{{ __('Action') }}</th> <!-- New Action Header -->
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $item->badgenumber }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->site }}</td>
            <td>{{ $item->department }}</td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->bank_name }}</td>
            <td>{{ $item->bank_account_no }}</td>
            <td>{{ $item->bank_account_name }}</td>
            <td>Rp {{ number_format($item->rate, 0, ',', '.') }}</td> <!-- Format rate as Rupiah -->
            <td>{{ $item->type }}</td>

            <td>
                @include('stisla.includes.forms.buttons.btn-edit', ['link' => route('employees.daily-worker.edit', [$item->badgenumber])])

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection