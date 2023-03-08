@extends('dashboard.layouts.master')
@push('styles')
    @toastr_css
    @endpush
@section('title')
    {{trans('main_trans.add_student')}}
@endsection
<!-- breadcrumb -->
@section('PageTitle')
    {{trans('main.add_student')}}
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post"  action="{{ route('students.store') }}" autocomplete="off">
                    @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{trans('Students.personal_information')}}</h6><br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('Students.name_ar')}} : <span class="text-danger">*</span></label>
                                    <input  type="text" name="name_ar"  class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('Students.name_en')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" name="name_en" type="text" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('Students.email')}} : </label>
                                    <input type="email"  name="email" class="form-control" >
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('Students.password')}} :</label>
                                    <input  type="password" name="password" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="gender">{{trans('Students.gender')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="gender_id">
                                        <option selected disabled>{{trans('Parent.Choose')}}...</option>
                                        @foreach($genders as $gender)
                                            <option  value="{{ $gender->id }}">{{ $gender->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nal_id">{{trans('Students.Nationality')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="nationalitie_id">
                                        <option selected disabled>{{trans('Parent.Choose')}}...</option>
                                        @foreach($nationals as $national)
                                            <option  value="{{ $national->id }}">{{ $national->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bg_id">{{trans('Students.blood_type')}} : </label>
                                    <select class="custom-select mr-sm-2" name="blood_id">
                                        <option selected disabled>{{trans('Parent.Choose')}}...</option>
                                        @foreach($bloods as $blood)
                                            <option value="{{ $blood->id }}">{{ $blood->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('Students.Date_of_Birth')}}  :</label>
                                    <input class="form-control" type="text"  id="datepicker-action" name="date_birth" data-date-format="yyyy-mm-dd">
                                </div>
                            </div>

                        </div>

                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{trans('Students.Student_information')}}</h6><br>
                    <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="grade_id">{{trans('Students.Grade')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="grade_id">
                                        <option selected disabled>{{trans('Parent.Choose')}}...</option>
                                        @foreach($my_classes as $my_classe)
                                            <option  value="{{ $my_classe->id }}">{{ $my_classe->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="classroom_id">{{trans('Students.classrooms')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="classroom_id">

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="section_id">{{trans('Students.section')}} : </label>
                                    <select class="custom-select mr-sm-2" name="section_id">

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="parent_id">{{trans('Students.parent')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="parent_id">
                                        <option selected disabled>{{trans('Parent.Choose')}}...</option>
                                       @foreach($parents as $parent)
                                            <option value="{{ $parent->id }}">{{ $parent->name_father }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="academic_year">{{trans('Students.academic_year')}} : <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="academic_year">
                                    <option selected disabled>{{trans('Parent.Choose')}}...</option>
                                    @php
                                        $current_year = date("Y");
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        </div><br>
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Students.submit')}}</button>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@push('scripts')
    @toastr_js
    @toastr_render
    <script>
        $(document).ready(function () {
            $('select[name="grade_id"]').on('change', function () {
                var grade_id = $(this).val();
                if (grade_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_classrooms') }}/" + grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="classroom_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="classroom_id"]').append('<option selected disabled >{{trans('Parent.Choose')}}...</option>');
                                $('select[name="classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                }
                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('select[name="classroom_id"]').on('change', function () {
                var classroom_id = $(this).val();
                if (classroom_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_sections') }}/" + classroom_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="section_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                }
                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
@endpush
