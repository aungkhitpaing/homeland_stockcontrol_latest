@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Bank Transfer Detail
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
                <form method="POST" action="/head_quater/loan_detail/{{$loanDetailId->id}}">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="form-group">

                        <input type="hidden" name="bank_detail_id" value="{{$loanDetailId->bank_detail_id}}" >
                        <input type="hidden" name="payment_type" value="{{$loanDetailId->payment_type}}" >
                        <input type="hidden" name="accountHead" value="{{$loanDetailId->account_head_id}}" >
                        <input type="hidden" name="payback_amount" value="{{$loanDetailId->payback_amount}}" >


                        <label for="email">Transfer Income</label>
                        <input type="number" class="form-control" name="amount"
                               value="{{$loanDetailId->loan_amount}}">
                    </div>
                    <button type="submit" class="btn btn-success">Change</button>
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