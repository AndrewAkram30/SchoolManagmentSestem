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

        <div class="col-xl-12 mb-30">
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

                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        اضافه صف
                    </button>


                    <button type="button" class="button x-small" id="btn_delete_all">
                        حذف الصفوف المختاره
                    </button>
                    <br><br>


                    <form action="{{ route('Filter_Classes') }}" method="POST">
                        {{ csrf_field() }}
                        <select class="selectpicker" data-style="btn-info" name="Grade_id" required
                            onchange="this.form.submit()">
                            <option value="" selected disabled>البحث باسم المرحله
                            </option>
                            @foreach ($Grades as $grade)
                                <option value="{{ $grade->id }}">{{ $grade->Names }}</option>
                            @endforeach
                        </select>
                    </form>


                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th><input name="select_all" id="example-select-all" type="checkbox"
                                            onclick="CheckAll('box1', this)" /></th>

                                    <th>#</th>
                                    <th>اسم الصف</th>
                                    <th>اسم المرحله</th>
                                    <th> العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>

                                @foreach ($Classrooms as $classroom)
                                    <tr>
                                        <td><input type="checkbox" value="{{ $classroom->id }}" class="box1"></td>
                                        <td> <?php $i++; ?> {{ $i }} </td>
                                        <td>{{ $classroom->Name_Class }}</td>
                                        <td>{{ $classroom->Grades->Names }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $classroom->id }}" title="تعديل"><i
                                                    class="fa fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $classroom->id }}" title=" حذف"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>


                                    <!-- edit_modal_Grade -->
                                    <div class="modal fade" id="edit{{ $classroom->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        تعديل الدراجات
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- add_form -->
                                                    <form action="{{ route('classroom.update', 'test') }}" method="post">
                                                        {{ method_field('patch') }}
                                                        @csrf

                                                        <input id="id" type="hidden" name="id"
                                                            class="form-control" value="{{ $classroom->id }}">
                                                        <div class="row">

                                                            <div class="form-group">
                                                                <label for="Name_Class" class="mr-sm-2">اسم الصف
                                                                    :</label>
                                                                <input class="form-control" type="text" name="Name_Class"
                                                                    value="{{ $classroom->Name_Class }}" />
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="Grade_id" class="mr-sm-2">المرحله الدراسيه
                                                                    :</label>
                                                                <select class="form-control" name="Grade_id">
                                                                    @foreach ($Grades as $grade)
                                                                        <option value="{{ $grade->id }}">
                                                                            {{ $grade->Names }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>

                                                        <br><br>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">حذف</button>
                                                            <button type="submit" class="btn btn-success">تاكيد</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- delete_modal_Grade -->
                                    <div class="modal fade" id="delete{{ $classroom->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        حذف الصف
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('classroom.destroy', 'test') }}"
                                                        method="post">
                                                        {{ method_field('Delete') }}
                                                        @csrf
                                                        هل انت متاكد من حذف المراحل الدراسيه
                                                        <input id="id" type="hidden" name="id"
                                                            class="form-control" value="{{ $classroom->id }}">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">اغلاق</button>
                                                            <button type="submit" class="btn btn-danger">حذف</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>



        <!-- حذف مجموعة صفوف -->
        <div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            حذف الفصول الدراسيه
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('delete_all') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            هل تريد حذف المرحل الدراسيه ؟
                            <input class="text" type="hidden" id="delete_all_id" name="delete_all_id"
                                value="">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>





        <!-- add_modal_class -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            اضافه صف
                        </h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form class=" row mb-30" action="{{ route('classroom.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">


                                    <div class="form-group">
                                        <label for="Name_Class" class="mr-sm-2">اسم الصف
                                            :</label>
                                        <input class="form-control" type="text" name="Name_Class" />
                                    </div>

                                    <div class="form-group">
                                        <label for="Grade_id" class="mr-sm-2">المرحله الدراسيه
                                            :</label>
                                        <select class="form-control" name="Grade_id">
                                            @foreach ($Grades as $grade)
                                                <option value="{{ $grade->id }}">{{ $grade->Names }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-success">حفظ البيانات</button>
                    </div>


                </div>
            </div>
            </form>
        </div>


    </div>

    </div>

    </div>
    </div>
    </div>

    </div>

    <!-- row closed -->
@endsection
