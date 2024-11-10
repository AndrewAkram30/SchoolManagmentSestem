@extends('layouts.main')
@section('title')
    قائمه الصفوف الدراسيه
@endsection
@section('page-header')
    قائمه الصفوف الدراسيه
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
                                <a href="{{ route('students.create') }}" class="btn btn-success btn-sm" role="button"
                                    aria-pressed="true">add_student</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                        data-page-length="50" style="text-align: center">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Gender</th>
                                                <th>Grade</th>
                                                <th>Classrooms</th>
                                                <th>Sections</th>
                                                <th>Processes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Students as $student)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $student->Name }}</td>
                                                    <td>{{ $student->Email }}</td>
                                                    <td>{{ $student->Genders->Name }}</td>
                                                    <td>{{ $student->Grades->Names }}</td>
                                                    <td>{{ $student->Classrooms->Name_Class }}</td>
                                                    <td>{{ $student->Sections->Name_Section }}</td>
                                                    <td>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#"
                                                                role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                العمليات
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('students.show', $student->id) }}"><i
                                                                        style="color: #ffc107"
                                                                        class="far fa-eye "></i>&nbsp; عرض بيانات الطالب</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('students.edit', $student->id) }}"><i
                                                                        style="color:green" class="fa fa-edit"></i>&nbsp;
                                                                    تعديل بيانات الطالب</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('fees_invoices.show', $student->id) }}"><i
                                                                        style="color: #0000cc"
                                                                        class="fa fa-edit"></i>&nbsp;اضافة فاتورة
                                                                    رسوم&nbsp;</a>
                                                                <a class="dropdown-item"
                                                                    data-target="#Delete_Student{{ $student->id }}"
                                                                    data-toggle="modal"
                                                                    href="##Delete_Student{{ $student->id }}"><i
                                                                        style="color: red" class="fa fa-trash"></i>&nbsp;
                                                                    حذف بيانات الطالب</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @include('Students.delete')
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
