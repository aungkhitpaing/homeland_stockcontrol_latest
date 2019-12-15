        @extends('layouts.app')
        
        @section('content')
        
        @if(auth()->user()->name == 'admin')
        <section class="content">
            <a href="/project-expense/create" class="btn btn-primary">create expense for project</a>
            
            <div class="box box-body"  style="margin-top:15px;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Account Head</th>
                            <th>Project</th>
                            <th>Site Manager</th>
                            <th>Description</th>
                            <th>Payment Type</th>
                            <th>Income</th>
                            <th>Expend</th>
                            <th>Balance</th>
                            <th>Remark</th>
                            <th>Created Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $data)
                        @if($data->is_check == 1)
                        <tr class="danger">
                            @else
                            <tr>
                                @endif
                                @if($data->site_account_head_id)
                                <td>{{ DB::table('site_account_head_tb')->where('id',$data->site_account_head_id)->first()->account_head_type }}</td>
                                @else   
                                <td></td>
                                @endif
                                <td>{{ DB::table('project_tb')->where('id',$data->project_id)->first()->name }}</td>
                                <td>
                                    @php $user_id =  DB::table('project_user')->where('project_id',$data->project_id)->first()->user_id @endphp
                                    {{ DB::table('users')->where('id',$user_id)->first()->name }}
                                </td>
                                <td>{{ $data->description }}</td>
                                <td>{{ $data->payment_type }}</td>
                                <td>{{ $data->income }}</td>
                                <td>{{ $data->expend }}</td>
                                <td> ---- </td>
                                <td>{{ $data->created_at }}</td>
                                <td>{{ $data->updated_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $datas->links() }}
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <form action="/project-expense/exportByAccoutHead" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Select Account Head</label>
                                        <select required class="form-control" id="exampleFormControlSelect1" name="account_head_type">
                                            <option value="">--- Select your option ---</option>
                                            @foreach(\DB::table('site_account_head_tb')->get() as $account_head)
                                            <option value="{{ $account_head->account_head_type }}">{{ $account_head->account_head_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Select Project</label>
                                        <select required class="form-control" id="exampleFormControlSelect1" name="project">
                                            <option value="">--- Select your project ---</option>
                                            @foreach(\DB::table('project_tb')->get() as $project)
                                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Select Payment Type</label>
                                        <select required class="form-control" id="exampleFormControlSelect1" name="payment_type">
                                            <option value="">--- Select your payment type ---</option>
                                            <option value="cash">Cash</option>
                                            <option value="bank">Bank</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary" style="margin-top:22px;">Export Detail Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <form action="/project-expense/exportByAccoutHeadTotal" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Select Project</label>
                                        <select required class="form-control" id="exampleFormControlSelect1" name="project">
                                            <option value="">--- Select your option ---</option>
                                            @foreach(\DB::table('project_tb')->get() as $project)
                                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary" style="margin-top:22px;">Export Total Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        @else
        <section class="content">
            <a href="/project-expense/create" class="btn btn-primary">create expense for project</a>
            
            <div class="box box-body" style="margin-top:15px;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Account Head</th>
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
                                <td>{{ $data->site_account_head_id }}</td>
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
                                <td>{{ $data->site_account_head_id }}</td>
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
        
        
        @endif
        @endsection
        @section('page_scripts')
        <script>
            $(function () {
                $('#example1').DataTable()
            })
        </script>
        @endsection