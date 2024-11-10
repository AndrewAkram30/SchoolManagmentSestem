@extends('layouts.main')
@section('title')
    قائمه المراحل الدراسيه
@endsection
@section('page-header')
    قائمه المراحل الدراسيه
@endsection

@section('content')
    <!-- row -->
    <div class="row">


        @if ($errors->any())
            <div class="error">{{ $errors->first('Names') }}</div>
        @endif



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
                        اضافه مرحله
                    </button>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم المرحله</th>
                                    <th>الملاحظات</th>
                                    <th> العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($Grades as $grade)
                                    <tr>
                                        <?php $i++; ?>
                                        <td>{{ $i }}</td>
                                        <td>{{ $grade->Names }}</td>
                                        <td>{{ $grade->Notes }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $grade->id }}" title="تعديل"><i
                                                    class="fa fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $grade->id }}" title=" حذف"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>

                                    {{-- لازم التعديل والحذف يكونو جوه الforeach --}}
                                    <!-- edit_modal_Grade -->
                                    <div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        تعديل الدرجات
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- add_form  -->
                                                    <form action="{{ route('grade.update', 'test') }}" method="post">
                                                        {{ method_field('patch') }}
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="Names" class="mr-sm-2">اسم المرحله باللغه
                                                                    العربيه
                                                                    :</label>
                                                                <input id="Names" type="text" name="Names"
                                                                    class="form-control" value="{{ $grade->Names }}"
                                                                    required>
                                                                <input id="id" type="hidden" name="id"
                                                                    class="form-control" value="{{ $grade->id }}">
                                                            </div>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlTextarea1">الملاحظات
                                                                :</label>
                                                            <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1" rows="3">{{ $grade->Notes }}</textarea>
                                                        </div>
                                                        <br><br>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">اغلاق</button>
                                                            <button type="submit" class="btn btn-success">تاكيد</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- delete_modal_Grade -->
                                    <div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        حذف الدراجات
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('grade.destroy', 'test') }}" method="post">
                                                        {{ method_field('Delete') }}
                                                        @csrf
                                                        هل انت متاكد من عمليه الجذف ؟
                                                        <input id="id" type="hidden" name="id"
                                                            class="form-control" value="{{ $grade->id }}">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">اغلاق</button>
                                                            <button type="submit" class="btn btn-danger">تاكيد</button>
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

        {{-- اول حاجه عندى  --}}
        <!-- add_modal_Grade -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            اضافه مرحله
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- add_form -->
                        <form action="{{ route('grade.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="Names" class="mr-sm-2"> اسم المرحله باللغه العربيه
                                        :</label>
                                    <input id="Names" type="text" name="Names" class="form-control">
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1"> ملاحظات
                                    :</label>
                                <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <br><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-success">تاكيد</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

    <!-- row closed -->
@endsection
