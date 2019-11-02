@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            PO Transfer Detail
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
                <form method="POST" action="/head_quater/receive_paymentorder/{{$payment_order_id}}/update">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="form-group">
                        <label for="email">Transfer Income</label>
                        <input type="number" class="form-control" name="amount"
                               value="{{$editOrderId->receive_amount}}">
                    </div>
                    {{--<p>/{{$investor_id}}/invester_detail/{{$investorDetailId->investor_detail_id}}</p>--}}
                    <button type="submit" class="btn btn-success">Change</button>
                    {{--<a href="/head_quater/invester_detail/{{$investorDetailId->investor_detail_id}}/" class="btn btn-default">Cancel</a>--}}
                </form>
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