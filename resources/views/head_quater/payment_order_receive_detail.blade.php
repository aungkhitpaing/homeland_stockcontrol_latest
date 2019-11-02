@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Income Data Tables
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
                        <li class="active"><a href="#tab_1" data-toggle="tab">Receive Payment Orders</a></li>
                        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>

                    <div class="tab-content">
                        <!-- Investor tab-pane -->
                        <div class="tab-pane active" id="tab_1">
                            <section class="content">
                                <div class="row">
                                    <div class="col-md-2 pull-right">
                                        <a href="/head_quater/create" class="btn btn-block btn-primary btn-sm">Add</a>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="box" style="border: none;">
                                            <div class="box-header">
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>PO Name</th>
                                                            <th>Receive Amount</th>
                                                            <th>Receive Date</th>
                                                            <th>Description</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($receivePaymentOrder as $data)
                                                        <tr>
                                                            <td>{{$data->name}}</td>
                                                            <td>{{$data->receive_amount}}</td>
                                                            <td>{{$data->receive_date}}</td>
                                                            <td>{{$data->description}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>PO Name</th>
                                                            <th>Receive Amount</th>
                                                            <th>Receive Date</th>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection

@section('page_scripts')
    <script>
        $(function () {
            $('#example1').DataTable()
        })
    </script>
@endsection