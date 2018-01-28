@extends('layouts.backend')
@section('title')
    {{ $compact['title'] }}
@endsection
@section('content')
    @include('pages.includes.breadcrumb')

    <h1 class="page-title">
        @lang($compact['title'].'.name')
    </h1>

    @include('pages.product.table')

@endsection
@section('styles')
    {!! Html::style('/backend/models/'.$compact['title'].'/css/style.css') !!}
    {!! Html::style('/backend/global/plugins/datatables/datatables.min.css') !!}
    {!! Html::style('/backend/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!}
    {!! Html::style('/css/datatable.css') !!}
    {!! Html::style('/backend/global/plugins/sweetalert2/sweetalert2.min.css') !!}
@endsection
@section('scripts')
    {!! Html::script('/backend/global/plugins/jquery.blockui.min.js') !!}
    {!! Html::script('/backend/global/scripts/datatable.js') !!}
    {!! Html::script('/backend/global/plugins/datatables/datatables.min.js') !!}
    {!! Html::script('/backend/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}
    {!! Html::script('/backend/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') !!}
    {!! Html::script('/backend/global/plugins/sweetalert2/sweetalert2.min.js') !!}
    {!! Html::script('/backend/models/'.$compact['title'].'/js/index.js') !!}
@endsection