@extends('dashboard.layouts.master')

@push('styles')
@toastr_css
@endpush

@section('title')
{{trans('Students.Student_details')}}
@endsection


<!-- breadcrumb -->
@section('PageTitle')
{{trans('Students.Student_details')}}

<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="card-body">
                    <div class="tab nav-border">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                                    role="tab" aria-controls="home-02"
                                    aria-selected="true">{{trans('Students.Student_details')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02" role="tab"
                                    aria-controls="profile-02"
                                    aria-selected="false">{{trans('Students.Attachments')}}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                aria-labelledby="home-02-tab">
                                <table class="table table-striped table-hover" style="text-align:center">
                                    <tbody>
                                        <tr>

                                            <th scope="row">{{trans('Students.name')}}</th>
                                            <td>{{ $student->name }}</td>
                                            <th scope="row">{{trans('Students.email')}}</th>
                                            <td>{{ $student->email}}</td>
                                            <th scope="row">{{trans('Students.gender')}}</th>
                                            <td>{{ $student->gender->name}}</td>
                                            <th scope="row">{{trans('Students.Nationality')}}</th>
                                            <td>{{ $student->nationality->name}}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{trans('Students.Grade')}}</th>
                                            <td>{{ $student->grade->name }}</td>
                                            <th scope="row">{{trans('Students.classrooms')}}</th>
                                            <td>{{ $student->classroom->name_class}}</td>
                                            <th scope="row">{{trans('Students.section')}}</th>
                                            <td>{{ $student->section->name_section}}</td>
                                            <th scope="row">{{trans('Students.Date_of_Birth')}}</th>
                                            <td>{{ $student->date_birth}}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{trans('Students.parent')}}</th>
                                            <td>{{ $student->myparent->name_father}}</td>
                                            <th scope="row">{{trans('Students.academic_year')}}</th>
                                            <td>{{ $student->academic_year }}</td>
                                            <th scope="row"></th>
                                            <td></td>
                                            <th scope="row"></th>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="profile-02" role="tabpanel" aria-labelledby="profile-02-tab">
                                <div class="card card-statistics">
                                    <div class="card-body">
                                        <form method="post" action="{{ route('upload_attachment')}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="academic_year">{{trans('Students.Attachments')}}
                                                        : <span class="text-danger">*</span></label>
                                                    <input type="file" accept="image/*" name="photos[]" multiple required>
                                                    <input type="hidden" name="student_name" value="{{$student->name}}">
                                                    <input type="hidden" name="student_id" value="{{$student->id}}">
                                                </div>
                                            </div>
                                            <br><br>
                                            <button type="submit" class="button button-border x-small">
                                                {{trans('Students.submit')}}
                                            </button>
                                        </form>
                                    </div>
                                    <br>
                                    <table class="table center-aligned-table mb-0 table table-hover" style="text-align:center">
                                        <thead>
                                            <tr class="table-secondary">
                                                <th scope="col">#</th>
                                                <th scope="col">{{trans('Students.filename')}}</th>
                                                <th scope="col">{{trans('Students.created_at')}}</th>
                                                <th scope="col">{{trans('Students.Processes')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $student->images as $attachment)
                                            <tr style='text-align:center;vertical-align:middle'>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$attachment->filename}}</td>
                                                <td>{{$attachment->created_at->diffForHumans()}}</td>
                                                <td colspan="2">
                                                    <a class="btn btn-outline-info btn-sm"
                                                        href="{{url('download_attachment')}}/{{ $attachment->imageable->name }}/{{$attachment->filename}}"
                                                        role="button"><i class="fas fa-download"></i>&nbsp;
                                                        {{trans('Students.Download')}}</a>

                                                    <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                        data-target="#Delete_img{{ $attachment->id }}"
                                                        title="{{ trans('grades_trans.Delete') }}">{{trans('Students.delete')}}
                                                    </button>

                                                </td>
                                            </tr>
                                            @include('dashboard.students.delete_img')
                                            @endforeach
                                        </tbody>
                                    </table>
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
