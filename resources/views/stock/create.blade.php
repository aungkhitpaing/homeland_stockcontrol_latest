@extends('layouts.app')

@section('content')

<section class="connectedSortable">
    
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1>Create Stock</h1>
                <form action="/stock/store" style="margin-top:25px;" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Stock Name:</label>
                        <input type="text" class="form-control" name="stock_name">
                    </div>


                    <div class="form-group">
                        <label for="">Unit:</label>
                        <input type="text" class="form-control" name="unit">
                    </div>

                    <div class="form-group">
                        <label for="">Amount:</label>
                        <input type="number" class="form-control" name="amount">
                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </section>
    @endsection
    