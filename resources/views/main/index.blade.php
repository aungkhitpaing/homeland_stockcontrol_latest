@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <h3>Head Quater Transaction </h3>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green-gradient">
                    <div class="inner">
                        <h4><b>{{$getTotalIncomeCash}}</b> <span>Kyats</span></h4>

                        <p>Cash Income Total</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-arrow-up-a"></i>
                    </div>
                    <a href="/head_quater/alltransaction" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red-gradient">
                    <div class="inner">
                        <h4><b> {{$getTotalExpendCash}} </b> <span>Kyats</span></h4>

                        <p>Cash Expense Total</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-arrow-down-a"></i>
                    </div>
                    <a href="/head_quater/alltransaction" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h4><b>{{$getTotalIncomeBank}}</b> <span>Kyats</span></h4>

                        <p>Bank Income Total</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-arrow-up-a"></i>
                    </div>
                    <a href="/head_quater/alltransaction" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h4> <b> {{$getTotalExpendBank}} </b> <span>Kyats</span></h4>
                        <p>Bank Expense Total</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-arrow-down-a"></i>
                    </div>
                    <a href="/head_quater/alltransaction" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>

        {{--For HQ--}}
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <h3>HQ Infomation </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$headQuaterInfos['project']}}</h3>

                        <p>Project</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="/project" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{$headQuaterInfos['investor']}}</h3>

                        <p>Investor</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="/investor" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{$headQuaterInfos['bank_loan']}}</h3>

                        <p>Loan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="/head_quater/income_cashbook/bank_loan" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green-active">
                    <div class="inner">
                        <h3>{{$headQuaterInfos['tinder']}}</h3>

                        <p>PO / PG</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="/head_quater/income_cashbook/po_pg" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        {{-- for stock --}}

        <div class="row">
            <div class="col-lg-12 col-xs-6">
                <h3 class="pull-left">Warehouse</h3>
                <h3 class="pull-right"> Exchange Transfer</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Warehouse Overview</h3>
                        <a href="/warehouse" class="btn btn-info btn-sm pull-right"><b>Show Lists</b></a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="warehousetable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Project</th>
                                <th>Stock</th>
                                <th>Left Qty</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($getWarehouseData as $data)
                                <tr>
                                    <?php
                                    $created_at = explode(" ",$data->created_at);
                                    ?>
                                    <td>{{$created_at[0]}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->stock_name}}</td>
                                    <td>{{($data->total_quantity) - ($data->used_quantity) }}</td>
                                </tr>

                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Date</th>
                                <th>Project</th>
                                <th>Stock</th>
                                <th>Left Qty</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-lg-6 col-xs-12">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Exchange Transfer</h3>
                            <a href="/exchange_transfer" class="btn btn-info btn-sm pull-right"><b>Show Lists</b></a>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" action="/exchange_transfer/store">
                            {{ csrf_field() }}
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="accountHead" class="col-sm-2 control-label"> Account Head</label>
                                    <div class="col-sm-10">
                                        <!-- select -->
                                        <select class="form-control" name="accountHead" required>
                                            <option disabled selected value="">Select your Account Head</option>
                                            @foreach($accountHeads as $accountHead)
                                                <option value="{{$accountHead->id}}">{{$accountHead->account_head_type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="amount" class="col-sm-2 control-label">Amount To Exchange</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter the Transfer Amount" required>
                                    </div>
                                </div>

                                <!--  <div class="radio">
                                   <label style="margin-left: 17%;">
                                       <input type="radio" name="optionsRadios" id="optionsRadios1" value="Cash" required>
                                       Cash
                                   </label>
                                   <label style="margin-left: 2%;">
                                       <input type="radio" name="optionsRadios" id="optionsRadios2" value="Bank" required>
                                       Bank
                                   </label>
                                 </div> -->

                                <br>

                                <div class="radio">
                                    <label style="margin-left: 17%;">
                                        <input type="radio" name="exchangeTypeRadios" id="optionsRadios1" value="0" required>
                                        Cash to Bank
                                    </label>
                                    <label style="margin-left: 2%;">
                                        <input type="radio" name="exchangeTypeRadios" id="optionsRadios2" value="1" required>
                                        Bank to Cash
                                    </label>
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="inputamount" class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <textarea class="form-control" name="description" id="exampleFormControlTextarea5" rows="3" cols="200"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- /.box-body -->
                            <div class="box-footer">
                                <a href="/exchange_transfer/" class="btn btn-default">Back</a>
                                <input type="submit" class="btn btn-info pull-right" name="exchange" value="Exchange">
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
                    <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->

@endsection
@section('page_scripts')
    <script src="/adminlte/bower_components/chart.js/Chart.js"></script>
    <script>
        $(function () {
            $('#warehousetable').DataTable();
        })
    </script>
@endsection
