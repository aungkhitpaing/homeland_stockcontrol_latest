@extends('layouts.app')

@section('content')

<section class="connectedSortable">
    
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1>Stock</h1>
                <a href="/stock/create" class="btn btn-success" style="margin-top:15px;">Create</a>
                <div class="box" style="margin-top:15px;">
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Stock Name</th>
                                    <th>Price</th>
                                    <th>Unit</th>
                                    <th>Project </th>
                                    <th colspan="2">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stocks as $stock)
                                <tr>
                                    <td>{{$stock->stock_name}}</td>
                                    <td>{{$stock->amount }}</td>
                                    <td>{{ $stock->unit }}</td>
                                    <td><a href="/stock/edit/{{$stock->id}}" class="btn btn-success btn-sm">edit</a></td>

                                    <form action="/stock/delete/{{$stock->id}}" method="post">
                                        {{ csrf_field() }}
                                    <td><button type="submit" class="btn btn-danger btn-sm">delete</button></td>
                                    </form>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $stocks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
    