@extends('stisla.layouts.app-datatable')

@section('table')
@php
$canAction = $canUpdate || $canDelete;
@endphp

</br>

<table class="table table-striped" id="datatable" data-export="true" data-title="{{ $title }}">
    <thead>
        <tr>
            <th>{{ __('#') }}</th>
            <th>{{ __('Site') }}</th>
            <th>{{ __('Est. Date') }}</th>
            <th>{{ __('Est. Time') }}</th>
            <th>{{ __('Arrival Date') }}</th>
            <th>{{ __('Arrival Time') }}</th>
            <th>{{ __('WO No.') }}</th>
            <th>{{ __('PO No.') }}</th>
            <th>{{ __('Vendor') }}</th>
            <th>{{ __('Project Name') }}</th>
            <th>{{ __('Status') }}</th>
            <th>{{ __('Company') }}</th>
            <th>{{ __('Update') }}</th>


        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->site }}</td>
            <td>{{ $item->est_date }}</td>
            <td>{{ $item->est_time }}</td>
            <td>{{ $item->arrival_date }}</td>
            <td>{{ $item->arrival_time }}</td>
            <td>{{ $item->wo_number }}</td>
            <td>{{ $item->po_number }}</td>
            <td>{{ $item->vendor }}</td>
            <td>{{ $item->project_name }}</td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->company }}</td>
            <td>
                @include('stisla.includes.forms.buttons.btn-edit', ['link' => route('warehouse.inbound.edit', [$item->id])])

            </td>

        </tr>
        @endforeach
    </tbody>
</table>

@endsection