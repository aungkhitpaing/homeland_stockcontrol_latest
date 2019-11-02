@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row">
        <!-- right column -->

       
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Project Expense</h3>
                </div>
                <form class="form-horizontal" method="POST" action="/project-expense">
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
                                    <input type="number" id="inputamount" name="amount" class="form-control">
                                    <span class="input-group-addon">.00</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputamount" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                  <textarea class="form-control" name="description" id="exampleFormControlTextarea5" rows="3" cols="200"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">Add Amount</button>
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
                    <th>Project</th>
                    <th>Description</th>
                    <th>Income</th>
                    <th>Expend</th>
                    <th>Balance</th>
                    <th>Created Date</th>
                    <th>Option</th>
                </thead>
                <tbody>
                
                    @php $balance = 0 @endphp
                  @foreach($datas as $data)
                  @if($data->edit_status)
                  <tr style="font-weight:bold">
                    <td>{{ $data->project_name->name }}</td>
                    <td>{{ $data->description }}</td>
                    @if($data->income > 0)
                    <td>{{ $data->income }}</td>
                    @else 
                    <td>0</td>
                    @endif
                    <td>{{ $data->expend }}</td>

                    @if($data->income)

                        <td>{{$balance = $balance + $data->income }}</td>
                        
                    @else
                    <td>{{ $balance = $balance - $data->expend }}</td>
                    @endif
                    <td>{{ $data->created_at }}</td>
                    <td>
                        {{-- <a href="/project-expense/{{$data->id}}/record" class="btn btn-danger">Edit History</a> --}}
                        <a href="/project-expense/{{$data->id}}/edit" class="btn btn-warning">Edit</a>
                    </td>
                </tr>
                @else 
                <tr>
                    <td>{{ $data->project_name->name }}</td>
                    <td>{{ $data->description }}</td>
                    @if($data->income > 0)
                    <td>{{ $data->income }}</td>
                    @else 
                    <td>0</td>
                    @endif
                    <td>{{ $data->expend }}</td>

                    @if($data->income)
                        <td>{{$balance = $balance + $data->income }}</td>
                    @else
                    <td>{{ $balance = $balance - $data->expend }}</td>
                    @endif
                    <td>{{ $data->created_at }}</td>
                    <td>
                        @if(!$data->income)
                        <a href="/project-expense/{{$data->id}}/edit" class="btn btn-warning">Edit</a>
                        @endif
                    </td>
                </tr>
                @endif
                @endforeach
                </tbody>
              </table>
              {{ $datas->links() }}
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