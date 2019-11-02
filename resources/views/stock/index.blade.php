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
                                    <th>Code No</th>
                                    <th>Stock Name</th>
                                    <th>Price</th>
                                    <th>Avaliable</th>
                                    <th colspan="2">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stocks as $stock)
                                <tr>
                                    <td>{{$stock->code_no}}</td>
                                    <td>{{$stock->stock_name}}</td>
                                    <td>{{$stock->price }}</td>
                                    @if($stock->is_avaliable == 1)
                                    <td>Yes</td>
                                    @else 
                                    <td>No</td>
                                    @endif
                                    <td><a href="/stock/edit" class="btn btn-success btn-sm">edit</a></td>
                                    <td><button type="button" class="btn btn-danger btn-sm">delete</button></td>
                                    
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
    