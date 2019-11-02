@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Supplier</h3>
                </div>
                <form class="form-horizontal" method="POST" action="/supplier">
                    {{ csrf_field() }}
                    <div class="box-body">
                        
                        <div class="form-group">
                            <label for="investor_name" class="col-sm-2 control-label">Supplier Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="" name="supplier_name">                                
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">Add Supplier</button>
                          </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (right) -->
            <div class="box box-body">
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Supplier</th>
                    <th colspan="2">Option</th>
                </thead>
                <tbody>
                  @foreach($suppliers as $supplier)
                <tr>
                    <td>{{$supplier->supplier_name}}</td>
                    <td><a href="/supplier/{{$supplier->id}}/edit" class="btn btn-warning">Edit</a>
                        <form method="POST" action="/supplier/{{$supplier->id}}/delete">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
        </div>
    </section>
    
    @endsection
    @section('page_scripts')
    <script>
        $(function () {
            $('#example1').DataTable()
        })
    </script>
    @endsection