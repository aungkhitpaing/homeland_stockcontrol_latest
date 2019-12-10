@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            WareHouse Detail Data Tables
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
                        <li class="active"><a href="#tab_1" data-toggle="tab">Warehouse</a></li>
                        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <section class="content">
                                <div class="row">
                                    @if($getLastUrl != "instock_detail")
                                    <div class="col-md-2 pull-right">
                                    <a href="/warehouse/add_outstock" class="btn btn-block btn-primary btn-sm">Add</a>
                                    </div>
                                    @endif
                                    <div class="col-md-12">
                                        <div class="box" style="border: none;">
                                            <div class="box-header">
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Stock</th>
                                                        <th>Unit</th>
                                                        @if($getLastUrl == "instock_detail")
                                                        <th>Instock Amount</th>
                                                        @else
                                                        <th>Outstock Amount</th>
                                                        @endif
                                                        <th>Description</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($getAllData as $data)
                                                        <tr>
                                                            <?php
                                                            $created_at = explode(" ",$data->created_at);
                                                            ?>
                                                            <td>{{$created_at[0]}}</td>
                                                            <td>{{$data->stock_name}}</td>
                                                            <td>{{$data->unit}}</td>
                                                            @if($getLastUrl == "instock_detail")
                                                                    <td>{{$data->instock_amount}}</td>
                                                            @else
                                                                    <td>{{$data->outstock_amount}}</td>
                                                            @endif
                                                            <td>{{$data->description}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Stock</th>
                                                        <th>Unit</th>
                                                        @if($getLastUrl == "instock_detail")
                                                            <th>Instock Amount</th>
                                                        @else
                                                            <th>Outstock Amount</th>
                                                        @endif
                                                        <th>Description</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
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