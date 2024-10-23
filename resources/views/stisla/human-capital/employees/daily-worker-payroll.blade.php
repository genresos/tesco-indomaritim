@extends('stisla.layouts.app-datatable')

@section('table')
@php
$canAction = $canUpdate || $canDelete;
@endphp

<div>
    <a href="{{ route('employees.daily-worker.attendance') }}" class="btn btn-success">Show Attendance</a>
    <a href="{{ route('employees.daily-worker.calculate') }}" class="btn btn-warning">Calculate Payroll</a>
</div>


</br>

<table class="table table-striped" id="datatable" data-export="true" data-title="{{ $title }}">
    <thead>
        <tr>
            <th>{{ __('Periode') }}</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Department') }}</th>
            <th>{{ __('Status') }}</th>
            <th>{{ __('Work Days') }}</th>
            <th>{{ __('Rapel') }}</th>
            <th>{{ __('Bruto') }}</th>
            <th>{{ __('Loan') }}</th>
            <th>{{ __('Tax') }}</th>
            <th>{{ __('Net Income') }}</th>
            <th>{{ __('Actual Paid') }}</th>
            <th>{{ __('GAP') }}</th>
            <th>{{ __('Bank') }}</th>
            <th>{{ __('Bank No.') }}</th>
            <th>{{ __('Account Bank Name') }}</th>



        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $item->periode }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->department }}</td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->working_days }}</td>
            <td>0</td>
            <td>Rp {{ number_format($item->gross_income, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($item->loan, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($item->tax, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($item->net_income, 0, ',', '.') }}</td>
            <td>0</td>
            <td>0</td>
            <td>{{ $item->bank_name }}</td>
            <td>{{ $item->bank_account_no }}</td>
            <td>{{ $item->bank_account_name }}</td>


        </tr>
        @endforeach
    </tbody>
</table>

@endsection