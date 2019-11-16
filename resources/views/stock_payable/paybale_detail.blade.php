@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Payable Data Tables
            <small>advanced tables</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Payable payback</a></li>
                        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <section class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box" style="border: none;">
                                            <div class="box-header">
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                        <td>Date</td>
                                                        <td>Payback Amount</td>
                                                        <th>Type</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($getData as $data)

                                                        <tr>
                                                            <?php
                                                            $created_at = explode(" ",$data->create_at);
                                                            ?>
                                                            <td>{{$created_at[0]}}</td>
                                                            <td>{{$data->payable_amount}}</td>
                                                            <td>{{$data->payment_type}}</td>
                                                        </tr>

                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td>Date</td>
                                                        <td>Payback Amount</td>
                                                        <th>Type</th>
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
@endsection

@section('page_scripts')
    <script>
        $(function () {
            $('#example1').DataTable();
        })
    </script>
@endsection