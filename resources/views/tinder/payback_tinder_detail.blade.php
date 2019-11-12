@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Po / Pg payback detail Data Tables
            <small>advanced tables</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Po / Pg payback detail</a></li>
                        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>

                    <div class="tab-content">
                        <!-- Purchase Order -->
                        <div class="tab-pane active" id="tab_1">
                            <section class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box" style="border: none;">
                                            <div class="box-header">
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <table id="example7" class="table table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>Payback Date</th>
                                                        <th>Payback Amount</th>
                                                        <th>Description</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($getAllData as $data)
                                                        <tr>
                                                            <td>{{$data->payback_date}}</td>
                                                            <td>{{$data->payback_amount}}</td>
                                                            <td>{{$data->description}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th>Payback Date</th>
                                                        <th>Payback Amount</th>
                                                        <th>Description</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <!-- /.tab-pane -->
                        <!-- PG -->
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        {{--<div class="row">--}}
        {{--<div class="col-md-12">--}}
        {{--<div class="box box-default">--}}
        {{--<div class="box-header with-border">--}}
        {{--<i class="fa fa-bullhorn"></i>--}}

        {{--<h3 class="box-title">Total Income Amount</h3>--}}
        {{--</div>--}}
        {{--<!-- /.box-header -->--}}
        {{--<div class="box-body">--}}
        {{--<div class="callout callout-success">--}}
        {{--<h4>Total income amount is <b>Not Define Yet !</b></h4>--}}

        {{--<p>This is all calculation amount of total income</p>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<!-- /.box-body -->--}}
        {{--</div>--}}
        {{--<!-- /.box -->--}}
        {{--</div>--}}
        {{--<!-- /.col -->--}}
        {{--</div>--}}
        {{--</div>--}}
    </section>
    <!-- /.content -->
@endsection

@section('page_scripts')
    <script>
        $(function () {
            $('#example7').DataTable();
        })
    </script>
@endsection