@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row">
        <!-- right column -->
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Assign user to project</h3>
                </div>
                <form class="form-horizontal" method="POST" action="/project-user">
                    {{ csrf_field() }}
                    <div class="box-body">
                        
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Project Name</label>
                            <div class="col-sm-10">
                                <!-- select -->
                                <select class="form-control" name="project_id">
                                    @foreach(\DB::table('project_tb')->get() as $getAllProject)
                                    <option value="{{$getAllProject->id}}">{{$getAllProject->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">User Name</label>
                            <div class="col-sm-10">
                                <!-- select -->
                                <select class="form-control" name="user_id">
                                    @foreach(\DB::table('users')->get() as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">Add</button>
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
                    <th>User</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($projectUsers as $projectUser)
                    <tr>
                        <td>{{ \DB::table('project_tb')->where('id',$projectUser->project_id)->first()->name }}</td>
                        <td>{{ \DB::table('users')->where('id',$projectUser->user_id)->first()->name }}</td>
                        <td>
                            <form action="/project-user/{{$projectUser->id}}/delete" method="POST">
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
    
    @if(Session::has('message'))
    <div class="col-md-4">
        <p class="alert alert-danger">{{ Session::get('message') }}</p>
    </div>
    @endif

    @endsection
    @section('page_scripts')
    <script>
        
    </script>
    @endsection