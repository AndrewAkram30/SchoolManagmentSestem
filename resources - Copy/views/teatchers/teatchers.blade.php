@extends('layouts.main')
@section('css')
    @toastr_css
@section('title')
    teacher list
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    teacher list
@stop
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
                            <a href="{{ route('teatchers.create') }}" class="btn btn-success btn-sm" role="button"
                                aria-pressed="true">Add Teatcher</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">


                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>teatcher name</th>
                                            <th>teatcher's gender</th>
                                            <th>teatcher's specialization</th>
                                            <th>operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        @foreach ($Teatchers as $Teatcher)
                                            <?php $i++; ?>
                                            <td>{{ $i }}</td>
                                            <td>{{ $Teatcher->Name }}</td>
                                            <td>{{ $Teatcher->Genders->Name }}</td>
                                            <td>{{ $Teatcher->Specializations->Name }}</td>

                                            <td>
                                                <a href="{{ route('teatchers.edit', $Teatcher->id) }}"
                                                    class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                        class="fa fa-edit">Edit</i></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#Teatcher{{ $Teatcher->id }}" title="Delete"><i
                                                        class="fa fa-trash">Delete</i></button>
                                            </td>
                                            </tr>

                                            <div class="modal fade" id="delete_Teatcher{{ $Teatcher->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{ route('teatchers.destroy', 'test') }}"
                                                        method="post">
                                                        {{ method_field('delete') }}
                                                        {{ csrf_field() }}
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;"
                                                                    class="modal-title" id="exampleModalLabel">
                                                                    Delete_Teatcher</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p> are u sure u want delete</p>
                                                                <input type="hidden" name="id"
                                                                    value="{{ $Teatcher->id }}">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-danger">submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
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
@section('js')
@toastr_js
@toastr_render
@endsection
