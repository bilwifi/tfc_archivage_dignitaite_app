@extends('layouts.master')
@include('partials.includes.dataTables.dataTables')
@include('partials.includes.dataTables.buttons')
@section('content')

<div class="row d-flex justify-content-center">
    <div class="col-10">
        <div class="card">

            {{-- <div class="card-header">DDDDD</div> --}}
            <div class="card-body bg-dark text-white">
                <div class="row">
                    <div class="col">
                        <!-- Button trigger modal -->
                        <a href="{{ route('add_dignitaire') }}" class="btn btn-primary text-monospace" >
                          Ajouter
                        </a>
                    </div>
                </div>
                 {!!$dataTable->table() !!}
            </div>
        </div>
    </div>
</div>
    

@endsection
@push('scripts')
  {!!$dataTable->scripts() !!}
@endpush