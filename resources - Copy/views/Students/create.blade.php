@extends('layouts.main')

@section('title')

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    Add Student

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

                    <form method="post" action="{{ route('students.store') }}" autocomplete="off">
                        @csrf
                        <h6 style="font-family: 'Cairo', sans-serif;color: blue">
                            personal_information</h6><br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name : <span class="text-danger">*</span></label>
                                    <input type="text" name="Name" class="form-control">
                                    @error('Name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email : </label>
                                        <input type="Email" name="Email" class="form-control">
                                        @error('Email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password :</label>
                                        <input type="Password" name="Password" class="form-control">
                                        @error('Password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Date_of_Birth :</label>
                                        <input class="form-control" type="text" id="datepicker-action" name="Date_Birth"
                                            data-date-format="yyyy-mm-dd">
                                    </div>
                                </div>

                            </div>

                            <h6 style="font-family: 'Cairo', sans-serif;color: blue">
                                {{ trans('Students_trans.Student_information') }}</h6><br>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Grade_id">Grade : <span class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="Grade_id">
                                            <option selected disabled>Choose..</option>
                                            @foreach ($Classrooms as $classroom)
                                                <option value="{{ $classroom->id }}">{{ $classroom->Name_Class }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Classroom_id">classrooms : <span class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="Classroom_id">

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="section_id"section>sections : </label>
                                        <select class="custom-select mr-sm-2" name="section_id">

                                        </select>
                                    </div>
                                </div>




                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="academic_year">Attachments: <span class="text-danger">*</span></label>
                                        <input type="file" accept="image/*" name="photos[]" multiple>
                                    </div>
                                </div>


                            </div><br>
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">تاكيد</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
    <script>
        $(document).ready(function() {
            $('select[name="Grade_id"]').on('change', function() {
                var Grade_id = $(this).val();
                if (Grade_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_classrooms') }}/" + Grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="Classroom_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="Classroom_id"]').append(
                                    '<option selected disabled >{{ trans('Parent_trans.Choose') }}...</option>'
                                );
                                $('select[name="Classroom_id"]').append(
                                    '<option value="' + key + '">' + value +
                                    '</option>');
                            });

                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('select[name="Classroom_id"]').on('change', function() {
                var Classroom_id = $(this).val();
                if (Classroom_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_Sections') }}/" + Classroom_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="section_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="section_id"]').append(
                                    '<option value="' + key + '">' + value +
                                    '</option>');
                            });

                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
@endsection
