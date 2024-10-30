@extends('stisla.layouts.app-datatable')

@section('table')
@php
$canAction = $canUpdate || $canDelete;
@endphp

<table class="table table-striped" id="datatable" data-export="true" data-title="{{ $title }}">
  <thead>
    <tr>
      <th>{{ __('ID') }}</th>
      <th>{{ __('PIN') }}</th>
      <th>{{ __('Name') }}</th>
      <th>{{ __('Time') }}</th>
      <th>{{ __('Device') }}</th>
      <th>{{ __('Alias') }}</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($data as $item)
    <tr>
      <td>{{ $item->id }}</td>
      <td>{{ $item->pin }}</td>
      <td>{{ $item->name }}</td>
      <td>{{ \Carbon\Carbon::parse($item->checktime)->format('d/m/y H:i:s') }}</td>
      <td>{{ $item->device }}</td>
      <td>{{ $item->alias }}</td>

    </tr>
    @endforeach
  </tbody>
</table>
@endsection