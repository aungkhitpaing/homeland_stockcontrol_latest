@extends('layouts.app')
@section('content')


<!-- Main content -->
<section class="content-header">
    
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li><a href="/head_quater/expend_cashbook">Office Expense</a></li>
                        <li class="active"><a href="/head_quater/project">Project</a></li>
                        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    
                    <section class="content">
                        <div class="row">
                            <div class="col-md-2 pull-right">
                                <a href="/head_quater/add_expend/project">
                                    <button type="button" class="btn btn-block btn-primary btn-sm">Add</button>
                                </a>
                            </div>
                            <div class="col-md-12">
                                <div class="box" style="border: none;">
                                    <div class="box-header">
                                        <!-- <h3 class="box-title">Data Table For Income CashBook</h3> -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table id="example2" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Project Name</th>
                                                    <th>Total Balance </th>
                                                    <th>Created Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($getAllProjectExpense as $getprojectexpense)
                                                <tr>
                                                    <td><a href="/head_quater/project_expense_detail/{{$getprojectexpense->project_id}}">{{$getprojectexpense->name}}</a></td>
                                                    <td>{{$getprojectexpense->total_expense_balance}}</td>
                                                    <?php
                                                    $created_at = explode(" ", $getprojectexpense->created_at);
                                                    ?>
                                                    <td>{{$created_at[0]}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Project Name</th>
                                                    <th>Total Balance </th>
                                                    <th>Created Date</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    {{ $getAllProjectExpense->links() }}
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- nav-tabs-custom -->
</div>
<!-- /.col -->
</div>
</section>
</section>
@endsection

@section('page_scripts')
<script>
    $(function () {
      $('#example1').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
        "searching": false
      })
    })
  </script>
@endsection