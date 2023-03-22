@extends('dashboard.layouts.master')

@push('styles')
@toaster_css
@endpush

@section('title')
الفواتير الدراسية
@endsection

@section('PageTitle')
الفواتير الدراسية
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>نوع الرسوم</th>
                                            <th>المبلغ</th>
                                            <th>المرحلة الدراسية</th>
                                            <th>الصف الدراسي</th>
                                            <th>البيان</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($fee_invoices as $fee_invoice)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$fee_invoice->student->name}}</td>
                                            <td>{{$fee_invoice->fees->title}}</td>
                                            <td>{{ number_format($fee_invoice->amount, 2) }}</td>
                                            <td>{{$fee_invoice->grade->name}}</td>
                                            <td>{{$fee_invoice->classroom->name_class}}</td>
                                            <td>{{$fee_invoice->description}}</td>
                                            <td>
                                                <a href="#" class="btn btn-info btn-sm" role="button"
                                                    aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        @include('dashboard.fees_invoices.delete')
                                        @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection

@push('scripts')
@toastr_js
@toastr_render
@endpush
