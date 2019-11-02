@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Supplier</h3>
                </div>
                <form class="form-horizontal" method="POST" action="/supplier/{{$suppliers->id}}/update">
                    {{ csrf_field() }}
                    <div class="box-body">
                        
                        <div class="form-group">
                            <label for="investor_name" class="col-sm-2 control-label">Supplier Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$suppliers->supplier_name}}" name="supplier_name">                                
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">Edit Supplier</button>
                          </div>
                    </form>
                </div>
                <!-- /.box -->
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