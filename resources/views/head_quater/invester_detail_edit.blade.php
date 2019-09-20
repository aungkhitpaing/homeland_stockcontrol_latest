@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Invester Transfer Detail
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
            <form method="POST" action="/head_quater/invester_detail/2/update">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="email">Transfer Income</label>
                    <input type="number" class="form-control" name="amount"
                    value="{{$investorDetail->amount}}">
                </div>
                <button type="submit" class="btn btn-success">Change</button>
                <a href="/head_quater/invester_detail/2/" class="btn btn-default">Cancel</a>
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