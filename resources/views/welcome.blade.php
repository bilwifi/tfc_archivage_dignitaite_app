@extends('layouts.master')
@include('partials.includes.dataTables.dataTables')
@include('partials.includes.dataTables.buttons')
@section('content')

<div class="row d-flex justify-content-center">
    <div class="col-10">
        <div class="card">

            {{-- <div class="card-header">DDDDD</div> --}}
            <div class="card-body bg-dark text-white">
           		 {!!$dataTable->table() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
  {!!$dataTable->scripts() !!}
@endpush