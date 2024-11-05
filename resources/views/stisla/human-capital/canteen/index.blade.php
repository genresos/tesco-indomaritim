@extends('stisla.layouts.app-datatable')

@section('table')
@php
$canAction = $canUpdate || $canDelete;
@endphp

<div>
    <div class="d-flex justify-content-between mb-3">
        <div>
            <a href="{{ route('canteen.fetchData') }}" class="btn btn-success">
                <i class="fas fa-file-import"></i> Sync Data
            </a> <!-- Import Worker button with icon -->
        </div>
    </div>
</div>



</br>

<table class="table table-striped" id="datatable" data-export="true" data-title="{{ $title }}">
    <thead>
        <tr>
            <th>{{ __('PIN') }}</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Check In') }}</th>
            <th>{{ __('Check Out') }}</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->checkin }}</td>
            <td>{{ $item->checkout }}</td>

        </tr>
        @endforeach
    </tbody>
</table>

@endsection