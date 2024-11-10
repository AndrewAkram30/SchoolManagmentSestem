@extends('layouts.main')
@section('title')
    ترقيه الطلاب
@endsection
@section('page-header')
    ترقيه الطلاب
@endsection

@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">


                    <div class="col-md-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                @if (Session::has('error_promotions'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ Session::get('error_promotions') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif


                                <h6 style="color: red;font-family: Cairo">المرحلة الدراسية القديمة</h6><br>
                                <form method="post" action="{{ route('student_promotions.store') }}">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="inputState">المرحله الدراسيه</label>
                                            <select class="custom-select mr-sm-2" name="Grade_id" required>
                                                <option selected disabled>choose...</option>
                                                @foreach ($Grades as $grade)
                                                    <option value="{{ $grade->id }}">{{ $grade->Names }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col">
                                            <label for="Classroom_id">الصفوف الدراسيه: <span
                                                    class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="Classroom_id" required>

                                            </select>
                                        </div>

                                        <div class="form-group col">
                                            <label for="Section_id">الاقسام الدرايسيه : </label>
                                            <select class="custom-select mr-sm-2" name="Section_id" required>

                                            </select>
                                        </div>
                                    </div>
                                    <br>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="academic_year">academic_year : <span
                                                    class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="academic_year">
                                                <option selected disabled>Choose...</option>
                                                @php
                                                    $current_year = date('Y');
                                                @endphp
                                                @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <h6 style="color: red;font-family: Cairo">المرحلة الدراسية الجديدة</h6><br>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="inputState"> المراحل الدراسيه الجديده</label>
                                            <select class="custom-select mr-sm-2" name="Grade_id_new">
                                                <option selected disabled>Choose...</option>
                                                @foreach ($Grades as $grade)
                                                    <option value="{{ $grade->id }}">{{ $grade->Names }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col">
                                            <label for="Classroom_id">الصفوف الدراسيه الجديده: <span
                                                    class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="Classroom_id_new">

                                            </select>
                                        </div>
                                        <div class="form-group col">
                                            <label for="section_id">:الاقسام الدراسيه الجديده </label>
                                            <select class="custom-select mr-sm-2" name="section_id_new">

                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="academic_year_new">academic_year_new : <span
                                                        class="text-danger">*</span></label>
                                                <select class="custom-select mr-sm-2" name="academic_year_new">
                                                    <option selected disabled>Choose...</option>
                                                    @php
                                                        $current_year = date('Y');
                                                    @endphp
                                                    @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                                        <option value="{{ $year }}">{{ $year }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-primary">تاكيد</button>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>


                <!-- row closed -->
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
