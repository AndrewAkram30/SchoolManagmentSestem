@extends('layouts.main')
@section('title')
    اضافه ولى الامر
@endsection
@section('page-header')
    اضافه ولى الامر
@endsection
@section('css')
    @livewireStyles
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @livewire('add-parent')

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @livewireScripts
@endsection
