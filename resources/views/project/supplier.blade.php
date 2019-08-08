@extends('layouts.app')

@section('content')

<section class="connectedSortable">
    
    <br><br><br>
        @include('project.tab')
        <div class="container">
        <div class="row">
            <div class="col-md-10">
                <a href="/supplier/create" class="btn btn-success" style="margin-top:15px;">Create</a>
                <div class="box" style="margin-top:15px;">
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>    
                                    <th>Project Name</th>
                                    <th>Type</th>
                                    <th>Quantity</th>
                                    <th>Pay Amount</th>
                                    <th>Left Amount</th>
                                    <th colspan="2">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($suppliers as $supplier)
                                <tr>
                                    <td>{{ $supplier->project_name }}</td>
                                    <td>{{ $supplier->type }}</td>
                                    <td>{{ $supplier->quantity }}</td>
                                    <td>{{ $supplier->pay_amount }}</td>
                                    <td>{{ $supplier->left_amount }}</td>
                                    <td>{{ $supplier->created_at }}</td>
                                    <td>{{ $supplier->updated_at }}</td>

                                    <td><a href="/supplier/edit" class="btn btn-success btn-sm">edit</a></td>
                                    <td><button type="button" class="btn btn-danger btn-sm">delete</button></td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $suppliers->links() }}

                    </div>
                </div>
            </div>
        </div>
</section>

@endsection
