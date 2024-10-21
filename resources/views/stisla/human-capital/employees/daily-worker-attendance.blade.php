@extends('stisla.layouts.app-datatable')

@section('table')
@php
$canAction = $canUpdate || $canDelete;
@endphp
<div>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->


    <a href="{{ route('employees.daily-worker.attendance-upload') }}" class="btn btn-primary">Upload Attendance</a>
    <a href="{{ route('employees.daily-worker.attendance-test', ['fromDate' => '', 'toDate' => '']) }}" class="btn btn-success" id="exportButton">
        <i class="fas fa-file-export"></i> Export Attendance
    </a>
</a>

</div>
@if(session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
@endif

</br>
<div class="row mb-3">
    <div class="col-md-6">
        <label for="fromDate" class="form-label">From Date:</label>
        <div class="input-group">
            <input type="date" id="fromDate" class="form-control">
            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
        </div>
    </div>
    <div class="col-md-6">
        <label for="toDate" class="form-label">To Date:</label>
        <div class="input-group">
            <input type="date" id="toDate" class="form-control">
            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
        </div>
    </div>
</div>

<table class="table table-striped" id="datatable" data-export="true" data-title="{{ $title }}">
    <thead>
        <tr>
            <th>{{ __('#') }}</th>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Time') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->badgenumber }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ \Carbon\Carbon::parse($item->checktime)->format('Y-m-d H:i:s') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    var table = $('#datatable').DataTable();

    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();
            var date = new Date(data[3]); // Mengambil data dari kolom waktu
            var formattedDate = date.toISOString().split('T')[0]; // Format ke YYYY-MM-DD

            if (
                (fromDate === "" && toDate === "") ||
                (fromDate === "" && formattedDate <= toDate) ||
                (fromDate <= formattedDate && toDate === "") ||
                (fromDate <= formattedDate && formattedDate <= toDate)
            ) {
                return true;
            }
            return false;
        }
    );

    $('#fromDate, #toDate').on('change', function() {
        table.draw();
    });

    $('#exportButton').on('click', function(e) {
        e.preventDefault(); // Mencegah default action dari link

        // Ambil nilai dari input tanggal
        var fromDate = $('#fromDate').val();
        var toDate = $('#toDate').val();

        // Buat URL baru dengan parameter
        var url = "{{ route('employees.daily-worker.attendance-test', ['fromDate' => ':fromDate', 'toDate' => ':toDate']) }}";
        url = url.replace(':fromDate', fromDate).replace(':toDate', toDate);

        // Redirect ke URL baru
        window.location.href = url;
    });
});
</script>
@endpush
