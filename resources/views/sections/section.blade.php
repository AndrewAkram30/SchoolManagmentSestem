@extends('layouts.main') @section('title')
    قائمه الاقسام الدراسيه
    @endsection @section('page-header')
    قائمه الاقسام الدراسيه
    @endsection @section('content')

    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        اضافه قسم
                    </button>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <?php $x = 0; ?>
                                        @foreach ($Grades as $grade)
                                            <?php $x++; ?>
                                            <div class="panel-group1" id="accordion<?php echo $x; ?>">
                                                <div class="panel panel-default" style="margin-bottom: 35px;">
                                                    <div class="panel-heading1"
                                                        style="padding: 15px; background-color: green;">
                                                        <h4 class="panel-title1">
                                                            <a class="accordion-toggle collapsed" data-toggle="collapse"
                                                                data-parent="#accordion<?php echo $x; ?>"
                                                                href="#collapse<?php echo $x; ?>"
                                                                aria-expanded="false">{{ $grade->Names }}</a>
                                                        </h4>
                                                    </div>

                                                    <div id="collapse<?php echo $x; ?>" class="panel-collapse collapse"
                                                        role="tabpanel" aria-expanded="false">
                                                        <div class="panel-body border">
                                                            <div class="table-responsive">
                                                                <table class="table key-buttons text-md-nowrap">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="wd-5p border-bottom-0">#</th>
                                                                            <th class="wd-15p border-bottom-0">
                                                                                اسم القسم
                                                                            </th>
                                                                            <th class="wd-20p border-bottom-0">
                                                                                اسم الفصل
                                                                            </th>
                                                                            <th class="wd-20p border-bottom-0">
                                                                                الحاله
                                                                            </th>
                                                                            <th class="wd-15p border-bottom-0">
                                                                                العمليات
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php $i = 0; ?>
                                                                        @foreach ($grade->Sections as $item)
                                                                            <tr>
                                                                                <td><?php $i++; ?>{{ $i }}
                                                                                </td>
                                                                                <td>{{ $item->Name_Section }}</td>
                                                                                <td>{{ $item->Classrooms->Name_Class }}</td>
                                                                                <td>
                                                                                    @if ($item->Status == 1)
                                                                                        <span
                                                                                            class="badge badge-success">active</span>
                                                                                    @else
                                                                                        <span
                                                                                            class="badge badge-danger">disactive</span>
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    <button type="button"
                                                                                        class="btn btn-info btn-sm"
                                                                                        data-toggle="modal"
                                                                                        data-target="#edit{{ $item->id }}"
                                                                                        title="تعديل"><i
                                                                                            class="fa fa-edit"></i></button>
                                                                                    <button type="button"
                                                                                        class="btn btn-danger btn-sm"
                                                                                        data-toggle="modal"
                                                                                        data-target="#delete{{ $item->id }}"
                                                                                        title=" حذف"><i
                                                                                            class="fa fa-trash"></i></button>

                                                                                    <!-- edit_modal_Grade -->
                                                                                    <div class="modal fade"
                                                                                        id="edit{{ $item->id }}"
                                                                                        tabindex="-1" role="dialog"
                                                                                        aria-labelledby="exampleModalLabel"
                                                                                        aria-hidden="true">
                                                                                        <div class="modal-dialog"
                                                                                            role="document">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                    <h5 style="font-family: 'Cairo', sans-serif;"
                                                                                                        class="modal-title"
                                                                                                        id="exampleModalLabel">
                                                                                                        تعديل القسم
                                                                                                    </h5>
                                                                                                    <button type="button"
                                                                                                        class="close"
                                                                                                        data-dismiss="modal"
                                                                                                        aria-label="Close">
                                                                                                        <span
                                                                                                            aria-hidden="true">&times;</span>
                                                                                                    </button>
                                                                                                </div>
                                                                                                <div class="modal-body">
                                                                                                    <!-- add_form -->
                                                                                                    <form
                                                                                                        action="{{ route('section.update', 'test') }}"
                                                                                                        method="post">
                                                                                                        {{ method_field('patch') }}
                                                                                                        @csrf

                                                                                                        <input
                                                                                                            id="id"
                                                                                                            type="hidden"
                                                                                                            name="id"
                                                                                                            class="form-control"
                                                                                                            value="{{ $item->id }}" />
                                                                                                        <div class="row">
                                                                                                            <div
                                                                                                                class="col">
                                                                                                                <input
                                                                                                                    type="text"
                                                                                                                    name="Name_Section"
                                                                                                                    class="form-control"
                                                                                                                    placeholder="اسم القسم"
                                                                                                                    value="{{ $item->Name_Section }}" />
                                                                                                            </div>
                                                                                                            <br />
                                                                                                            <div
                                                                                                                class="col">
                                                                                                                <label
                                                                                                                    for="inputName"
                                                                                                                    class="control-label">اسم
                                                                                                                    المرحله
                                                                                                                    الدراسيه</label>
                                                                                                                <select
                                                                                                                    name="Grade_id"
                                                                                                                    class="custom-select"
                                                                                                                    onchange="console.log($(this).val())">
                                                                                                                    <!--placeholder-->
                                                                                                                    <option
                                                                                                                        value=""
                                                                                                                        selected
                                                                                                                        disabled>
                                                                                                                        اختار
                                                                                                                        المرحله
                                                                                                                        الدراسيه
                                                                                                                    </option>
                                                                                                                    @foreach ($Grades as $grade)
                                                                                                                        <option
                                                                                                                            value="{{ $grade->id }}">
                                                                                                                            {{ $grade->Names }}
                                                                                                                        </option>
                                                                                                                    @endforeach
                                                                                                                </select>
                                                                                                            </div>
                                                                                                            <br />
                                                                                                            <div
                                                                                                                class="col">
                                                                                                                <label
                                                                                                                    for="inputName"
                                                                                                                    class="control-label">اسم
                                                                                                                    الصف
                                                                                                                </label>
                                                                                                                <select
                                                                                                                    name="Class_id"
                                                                                                                    class="custom-select">
                                                                                                                </select>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col">
                                                                                                <label for="inputName"
                                                                                                    class="control-label">اسم
                                                                                                    الصف </label>
                                                                                                <select name="Class_id"
                                                                                                    class="custom-select">
                                                                                                </select>
                                                                                            </div><br>

                                                                                            <div class="col">
                                                                                                <label for="inputName"
                                                                                                    class="control-label">{{ trans('Sections_trans.Name_Teacher') }}</label>
                                                                                                <select multiple
                                                                                                    name="teacher_id[]"
                                                                                                    class="form-control"
                                                                                                    id="exampleFormControlSelect2">
                                                                                                    @foreach ($Sections->Teatchers as $teatcher)
                                                                                                        <option selected
                                                                                                            value="{{ $teatcher['id'] }}">
                                                                                                            {{ $teatcher['Name'] }}
                                                                                                        </option>
                                                                                                    @endforeach

                                                                                                    @foreach ($Teatchers as $teatcher)
                                                                                                        <option
                                                                                                            value="{{ $teatcher->id }}">
                                                                                                            {{ $teatcher->Name }}
                                                                                                        </option>
                                                                                                    @endforeach
                                                                                                </select>




                                                                                                <div class="modal-footer">
                                                                                                    <button type="button"
                                                                                                        class="btn btn-secondary"
                                                                                                        data-dismiss="modal">حذف</button>
                                                                                                    <button type="submit"
                                                                                                        class="btn btn-success">تاكيد</button>
                                                                                                </div>
                                                                                                </form>
                                                                                            </div>
                                                                                        </div>



                                                                                        <!-- delete_modal_Grade -->
                                                                                        <div class="modal fade"
                                                                                            id="delete{{ $item->id }}"
                                                                                            tabindex="-1" role="dialog"
                                                                                            aria-labelledby="exampleModalLabel"
                                                                                            aria-hidden="true">
                                                                                            <div class="modal-dialog"
                                                                                                role="document">
                                                                                                <div class="modal-content">
                                                                                                    <div
                                                                                                        class="modal-header">
                                                                                                        <h5 style="font-family: 'Cairo', sans-serif;"
                                                                                                            class="modal-title"
                                                                                                            id="exampleModalLabel">
                                                                                                            حذف القسم
                                                                                                        </h5>
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="close"
                                                                                                            data-dismiss="modal"
                                                                                                            aria-label="Close">
                                                                                                            <span
                                                                                                                aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="modal-body">
                                                                                                        <form
                                                                                                            action="{{ route('section.destroy', 'test') }}"
                                                                                                            method="post">
                                                                                                            {{ method_field('DELETE') }}
                                                                                                            @csrf هل انت
                                                                                                            متاكد
                                                                                                            من حذف القسم
                                                                                                            <input
                                                                                                                id="id"
                                                                                                                type="hidden"
                                                                                                                name="id"
                                                                                                                class="form-control"
                                                                                                                value="{{ $item->id }}" />
                                                                                                            <div
                                                                                                                class="modal-footer">
                                                                                                                <button
                                                                                                                    type="button"
                                                                                                                    class="btn btn-secondary"
                                                                                                                    data-dismiss="modal">اغلاق</button>
                                                                                                                <button
                                                                                                                    type="submit"
                                                                                                                    class="btn btn-danger">حذف</button>
                                                                                                            </div>
                                                                                                        </form>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--اضافة قسم جديد -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                                    اضافه قسم
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('section.store') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" name="Name_Section" class="form-control"
                                                placeholder="اسم القسم" />
                                        </div>
                                    </div>
                                    <br />

                                    <div class="col">
                                        <label for="inputName" class="control-label">اسم المرحله الدراسيه</label>
                                        <select name="Grade_id" class="custom-select"
                                            onchange="console.log($(this).val())">
                                            <!--placeholder-->
                                            <option value="" selected disabled>
                                                اختار المرحله الدراسيه
                                            </option>
                                            @foreach ($Grades as $grade)
                                                <option value="{{ $grade->id }}"> {{ $grade->Names }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <br>
                                    <div class="col">
                                        <label for="inputName" class="control-label">اسم الصف </label>
                                        <select name="Class_id" class="custom-select"> </select>
                                    </div><br>

                                    <div class="col">
                                        <label for="inputName" class="control-label">Name Teatcher</label>
                                        <select multiple name="teatcher_id[]" class="form-control"
                                            id="exampleFormControlSelect2">
                                            @foreach ($Teatchers as $teatcher)
                                                <option value="{{ $teatcher['id'] }}">{{ $teatcher['Name'] }}</option>
                                            @endforeach
                                    </div>

                                    @foreach ($Sections as $teatcher)
                                        <option value="{{ $teatcher->id }}">{{ $teatcher->Name }}</option>
                                    @endforeach
                                    </select>


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
            </div>
        </div>
        <!-- row closed -->
        @endsection @section('js')
        @toastr_js @toastr_render
        <script>
            $(document).ready(function() {
                $('select[name="Grade_id"]').on("change", function() {
                    var Grade_id = $(this).val();
                    if (Grade_id) {
                        $.ajax({
                            url: "{{ URL::to('classes') }}/" + Grade_id,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                $('select[name="Class_id"]').empty();
                                $.each(data, function(key, value) {
                                    $('select[name="Class_id"]').append('<option value="' +
                                        key + '">' + value + "</option>");
                                });
                            },
                        });
                    } else {
                        console.log("AJAX load did not work");
                    }
                });
            });
        </script>
    @endsection
</div>
