@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row">
        <!-- right column -->

       
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Project Expense Edit</h3>
                </div>
                <form class="form-horizontal" method="POST" action="/project-expense/{{$projectExpense->id}}/update">
                    {{ csrf_field() }}
                    <div class="box-body">
                        
                        <div class="form-group">
                            <label for="investor_name" class="col-sm-2 control-label">Project Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$projectName->name}}" name="project" readonly>                                
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label for="inputamount" class="col-sm-2 control-label">Amount</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="number" id="inputamount" name="amount" class="form-control" value="{{$projectExpense->expend}}">
                                    <span class="input-group-addon">.00</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputamount" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                  <textarea class="form-control" name="description" id="exampleFormControlTextarea5" rows="3" cols="200">{{$projectExpense->description}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">Update Amount</button>
                          </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (right) -->
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