@extends('dashboard.layouts.master')

@push('styles')
    @toastr_css
@endpush

@section('title')
{{trans('main_trans.list_students')}}
@endsection

<!-- breadcrumb -->
@section('PageTitle')
{{trans('main.list_students')}}

<!-- breadcrumb -->
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
                            <a href="{{route('students.create')}}" class="btn btn-success btn-sm" role="button"
                                aria-pressed="true">{{trans('main_trans.add_student')}}</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('Students.name')}}</th>
                                            <th>{{trans('Students.email')}}</th>
                                            <th>{{trans('Students.gender')}}</th>
                                            <th>{{trans('Students.Grade')}}</th>
                                            <th>{{trans('Students.classrooms')}}</th>
                                            <th>{{trans('Students.section')}}</th>
                                            <th>{{trans('Students.Processes')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($students as $student)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{$student->name}}</td>
                                            <td>{{$student->email}}</td>
                                            <td>{{$student->gender->name}}</td>
                                            <td>{{$student->grade->name}}</td>
                                            <td>{{$student->classroom->name_class}}</td>
                                            <td>{{$student->section->name_section}}</td>
                                            <td>
                                                <a href="{{route('students.edit',$student->id)}}"
                                                    class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                        class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#Delete_Student{{ $student->id }}"
                                                    title="{{ trans('Grades.Delete') }}"><i
                                                        class="fa fa-trash"></i></button>
                                                <a href="{{ route('students.show',$student->id) }}" class="btn btn-warning btn-sm" role="button"
                                                    aria-pressed="true"><i class="far fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        @include('dashboard.students.deleted')
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
