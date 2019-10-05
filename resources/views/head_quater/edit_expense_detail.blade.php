@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit Expense Transfer Detail
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
            <div class="col-md-8">

                {{--office expense detail tb--}}
                @if($getEditData['table_name'] == 'office_expense_detail_tb')
                    @foreach($getEditData[0] as $data)
                        <section class="content">
                            <h1><small>Office Expense</small> </h1>
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-horizontal" method="POST" action="/head_quater/office_expense_detail/{{$data->office_expense_detail_id}}">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        <div class="box-body">
                                            <input type="hidden" name="accountHead" value="{{$data->account_head_id}}">
                                            <input type="hidden" name="expense_category" value="{{$data->expense_category}}">
                                            <input type="hidden" name="payment_type" value="{{$data->payment_type}}">
                                            <div class="form-group">
                                                <label for="inputamount" class="col-sm-2 control-label">Expend Amount</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span>
                                                        <input type="text" id="inputamount" class="form-control" name="amount" value={{$data->amount}}>
                                                        <span class="input-group-addon">Kyats</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputamount" class="col-sm-2 control-label">Description</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                                        <textarea class="form-control" name="description" id="exampleFormControlTextarea5" rows="3" cols="200">{{$data->description}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-info pull-right">Edit Amount</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    @endforeach


                {{--project detail tb--}}
                @elseif($getEditData['table_name'] == 'project_expense_detail_tb')
                    @foreach($getEditData[0] as $data)
                        <section class="content">
                            <h1><small>Project Expense</small> </h1>
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-horizontal" method="POST" action="/head_quater/project_expense_detail/{{$data->project_expense_detail_id}}/update">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        <div class="box-body">
                                            <input type="hidden" name="accountHead" value="{{$data->account_head_id}}">
                                            <input type="hidden" name="project_id" value="{{$data->project_id}}">
                                            <input type="hidden" name="project_id" value="{{$data->transfer_type}}">
                                            <input type="hidden" name="payment_type" value="{{$data->payment_type}}">
                                            <div class="form-group">
                                                <label for="inputamount" class="col-sm-2 control-label">Expend Amount</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span>
                                                        <input type="text" id="inputamount" class="form-control" name="amount" value={{$data->amount}}>
                                                        <span class="input-group-addon">Kyats</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputamount" class="col-sm-2 control-label">Description</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                                        <textarea class="form-control" name="description" id="exampleFormControlTextarea5" rows="3" cols="200">{{$data->description}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-info pull-right">Edit Amount</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    @endforeach

                @elseif($getEditData['table_name'] == 'bank_expense_tb' )
                    @foreach($getEditData[0] as $data)
                        <section class="content">
                            <h1><small>Bank Payback</small> </h1>
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-horizontal" method="POST" action="/head_quater/bank_expense_detail/{{$data->id}}/update" >
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        <div class="box-body">
                                            <input type="hidden" name="accountHead" value="{{$data->account_head_type}}">
                                            <input type="hidden" name="loan_transfer_id" value="{{$data->loan_transfer_id}}">
                                            <input type="hidden" name="payment_type" value="{{$data->payment_type}}">
                                                <div class="form-group">
                                                <label for="inputamount" class="col-sm-2 control-label">Edit Payback Amount</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span>
                                                        <input type="text" id="inputamount" class="form-control" name="amount" value={{$data->payback_amount}}>
                                                        <span class="input-group-addon">Kyats</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputamount" class="col-sm-2 control-label">Description</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                                        <textarea class="form-control" name="description" id="exampleFormControlTextarea5" rows="3" cols="200">{{$data->description}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-info pull-right">Edit Amount</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    @endforeach
                        {{-- @elseif( )  PO   --}}
                        {{-- @elseif( )  PG   --}}
                @endif
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
@section('page_scripts')
    <script>
        $(function () {
            $('#example3').DataTable()
        })
    </script>
@endsection