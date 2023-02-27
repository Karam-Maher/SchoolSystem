@extends('dashboard.layouts.master')

@push('styles')
@endpush
@section('title')
    {{ trans('classroom.title_page') }}
@endsection


@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <livewire:add-parent/>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@push('scripts')
@livewireScripts
@endpush

