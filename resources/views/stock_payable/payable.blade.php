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
                        <li class="active"><a href="#tab_1" data-toggle="tab">Payable</a></li>
                        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <section class="content">
                                <div class="row">
                                    <div class="col-md-2 pull-right">
                                        <a href="/stock_payable/create" class="btn btn-block btn-primary btn-sm">Add</a>
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
                                                        <th>Date</th>
                                                        <th>Project</th>
                                                        <th>Stock</th>
                                                        <th>Unit</th>
                                                        <th>Price</th>
                                                        <th>Qty</th>
                                                        <th>Total Amount</th>
                                                        <th>Payback</th>
                                                        <th>Left</th>
                                                        <th>Supplier</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($getAllData as $data)
                                                        <?php
                                                        if($data->confirm_flag == 1) {
                                                            $color = "#afafaf";
                                                        } else {
                                                            $color = "white";
                                                        }
                                                        ?>
                                                        <tr style="background-color:{{$color}}">
                                                            <?php
                                                                $created_at = explode(" ",$data->created_at);
                                                            ?>
                                                            <td>{{$created_at[0]}}</td>
                                                            <td>{{$data->name}}</td>
                                                            <td>{{$data->stock_name}}</td>
                                                            <td>{{$data->unit}}</td>
                                                            <td>{{$data->amount}}</td>
                                                            <td>{{$data->quantity}}</td>
                                                            <td>{{$data->total_amount}} Kyats</td>
                                                            <td>{{$data->payback_amount}} </td>
                                                            <td>
                                                                @if(($data->payback_amount) == null)
                                                                    {{$data->total_amount - 0}} Kyats
                                                                    @else
                                                                    {{$data->total_amount - $data->payback_amount}} Kyats
                                                                @endif
                                                            </td>
                                                            <td>{{$data->supplier_name}}</td>
                                                            <td>

                                                                @if($data->confirm_flag == 1)
                                                                    <a href="/stock_payable/{{$data->id}}/show"  class="btn btn-danger btn-sm">Payback</a>
                                                                @else
                                                                    <a href="/stock_payable/{{$data->id}}/confirm"  class="btn btn-success btn-sm">Confirm</a>
                                                                @endif
                                                                    {{--<a href="#" class="btn btn-warning btn-sm">Edit</a>--}}
                                                                    <a href="/stock_payable/{{$data->id}}/payback_detail" class="btn btn-primary btn-sm">Detail</a>
                                                            </td>
                                                        </tr>

                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td>Date</td>
                                                        <td>Project</td>
                                                        <th>Stock</th>
                                                        <th>Unit</th>
                                                        <th>Price</th>
                                                        <th>Qty</th>
                                                        <th>Total Amount</th>
                                                        <th>Payback</th>
                                                        <th>Left</th>
                                                        <th>Supplier</th>
                                                        <th>Action</th>
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