@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            WareHouse Data Tables
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
                                    {{--<div class="col-md-2 pull-right">--}}
                                        {{--<a href="/stock_payable/create" class="btn btn-block btn-primary btn-sm">Add</a>--}}
                                    {{--</div>--}}
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
                                                        <th>Project</th>
                                                        <th>Stock</th>
                                                        <th>Unit</th>
                                                        <th>Total Qty</th>
                                                        <th>Used Qty</th>
                                                        <th>Left Qty</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($getAllData as $data)
                                                        <tr>
                                                            <?php
                                                            $created_at = explode(" ",$data->created_at);
                                                            ?>
                                                            <td>{{$created_at[0]}}</td>
                                                            <td>{{$data->name}}</td>
                                                            <td>{{$data->stock_name}}</td>
                                                            <td>{{$data->unit}}</td>
                                                            <td>{{$data->total_quantity}}</td>
                                                            <td>{{$data->used_quantity}}</td>
                                                            <td>{{($data->total_quantity) - ($data->used_quantity) }}</td>
                                                            <td>
                                                                <a href="/warehouse/{{$data->id}}/instock_detail" class="btn btn-success btn-sm">Show Instock</a>
                                                                <a href="/warehouse/{{$data->id}}/outstock_detail" class="btn btn-danger btn-sm">Show Outstock</a>
                                                               @if(($data->total_quantity) == $data->used_quantity)
                                                                    {{--<a href="warehouse/{{$data->id}}/add_outstock" disabled="" class="btn btn-warning btn-sm">Add Outstock</a>--}}
                                                               @else
                                                                    <a href="warehouse/{{$data->id}}/add_outstock" class="btn btn-warning btn-sm">Add Outstock</a>
                                                               @endif
                                                            </td>
                                                        </tr>

                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Project</th>
                                                        <th>Stock</th>
                                                        <th>Unit</th>
                                                        <th>Total Qty</th>
                                                        <th>Used Qty</th>
                                                        <th>Left Qty</th>
                                                        <th>Action</th>
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