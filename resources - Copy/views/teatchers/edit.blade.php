@extends('layouts.main')
@section('css')
    @toastr_css
@section('title')
    Edit Teatcher
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    Edit Teatcher
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <br>
                        <form action="{{ route('teatchers.update', 'test') }}" method="post">
                            {{ method_field('patch') }}
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">Email</label>
                                    <input type="hidden" value="{{ $Teatchers->id }}" name="id">
                                    <input type="Email" name="Email" value="{{ $Teatchers->Email }}"
                                        class="form-control">
                                    @error('Email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">Password</label>
                                    <input type="Password" name="Password" value="{{ $Teatchers->Password }}"
                                        class="form-control">
                                    @error('Password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="col">
                                <label for="title">Name</label>
                                <input type="text" name="Name" value="{{ $Teatchers->Name }}"
                                    class="form-control">
                                @error('Name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="inputCity">Specialization</label>
                            <select class="custom-select my-1 mr-sm-2" name="Specialization_id">
                                <option value="{{ $Teatchers->Specialization_id }}">
                                    {{ $Teatchers->Specializations->Name }}</option>
                                @foreach ($Specialization as $specialization)
                                    <option value="{{ $specialization->id }}">{{ $specialization->Name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('Specialization_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col">
                            <label for="inputState">Gender</label>
                            <select class="custom-select my-1 mr-sm-2" name="Gender_id">
                                <option value="{{ $Teatchers->Gender_id }}">{{ $Teatchers->Genders->Name }}
                                </option>
                                @foreach ($Genders as $gender)
                                    <option value="{{ $gender->id }}">{{ $gender->Name }}</option>
                                @endforeach
                            </select>
                            @error('Gender_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <br>


                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Address</label>
                        <textarea class="form-control" name="Address" id="exampleFormControlTextarea1" rows="4">{{ $Teatchers->Address }}</textarea>
                        @error('Address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>


                    <div class="form-row">
                        <div class="col">
                            <label for="exampleFormControlTextarea1">Phone_number</label>
                            <textarea class="form-control" name="Phone_number" id="exampleFormControlTextarea1" rows="4">{{ $Teatchers->Phone_number }}</textarea>
                            @error('Phone_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <br>

                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">Submit</button>
                    </form>
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
