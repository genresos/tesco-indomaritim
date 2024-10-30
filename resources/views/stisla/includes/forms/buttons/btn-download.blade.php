@php
$icon = $icon ?? 'fa fa-download'; // Changed to download icon
$isAjax = $isAjax ?? false;
$isAjaxYajra = $isAjaxYajra ?? false;
@endphp
<a @if ($isAjax || $isAjaxYajra) onclick="showModalForm(event, 'download', '{{ $link }}')" @endif class="btn btn-sm btn-primary @if ($icon ?? false) btn-icon icon-left @endif"
  href="{{ $link }}" @if (!$isAjax) data-toggle="tooltip" @endif title="{{ $tooltip ?? ($label ?? __('Download Payslip')) }}">
  @if ($icon ?? false)
  <i class="{{ $icon }}"></i>
  @endif
  {{ $label ?? false }}
</a>