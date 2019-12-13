@extends('layouts.app')
@section('content')
    <section class="content-header">
        <h1>
            OutStock
            <small>Preview of UI elements</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Head_quater</a></li>
            <li class="active">Add_Outstock</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Outstock</a></li>
                        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <section class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Add OutStock </h3>
                                        </div>
                                        <form class="form-horizontal" method="POST" action="/warehouse/{{$warehouse_id}}/create_outstock">
                                            {{ csrf_field() }}
                                            <div class="box-body">
                                                <input type="hidden" name="warehouse_id" value="{{$getTotal->id}}">
                                                <div class="form-group" id="selectedPopup">
                                                    <label for="exampleInputEmail1" class="col-sm-2 control-label">OutStock Type</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" id="outting_type" name="outting_type" required>
                                                            <option disabled selected value="" >Select your Type </option>
                                                            <option id="normal" name="normal" value="1">Normal</option>
                                                            <option id="exchange" name="normal" value="2">Exchange</option>
                                                        </select>
                                                    </div>
                                                </div>


                                                {{--<div class="form-group" id="project">--}}
                                                    {{--<label for="exampleInputEmail1" class="col-sm-2 control-label">Project Name</label>--}}
                                                    {{--<div class="col-sm-10">--}}
                                                        {{--<select class="form-control" name="project" >--}}
                                                            {{--<option disabled selected value="">Select your project</option>--}}
                                                                {{--<option value="{{$getTotal->project_id}}">{{$data->name}}</option>--}}
                                                        {{--</select>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}


                                                <div class="form-group" id="project" style="display: none">
                                                    <label for="exampleInputEmail1" class="col-sm-2 control-label">Project Name</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" name="project" >
                                                            <option disabled selected value="">Select your project</option>
                                                            @foreach($getProject as $data)
                                                                @if( ($data->id) == ($getTotal->project_id))
                                                                    <option disabled value="">{{$data->name}}</option>
                                                                @endif
                                                                <option value="{{$data->id}}">{{$data->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputamount" class="col-sm-2 control-label">Outstock Quantity</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group">
                                                            <input type="hidden" id="totalQty" value="{{$getTotal->total_quantity}}"/>
                                                            @if (empty($getTotal->used_quantity))
                                                                <input type="hidden" id="useQty" value = 0 />
                                                            @else
                                                                <input type="hidden" id="useQty" value="{{$getTotal->used_quantity}}"/>
                                                            @endif
                                                            <input type="hidden" id="stockId" name= "stockId" value="{{$getTotal->stock_id}}"/>
                                                            <input type="number" id="outstock" class="form-control" required name="outstock" />
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
                                            </div>
                                            <div class="box-footer">
                                                <a href="/warehouse/" class="btn btn-default">Cancel</a>
                                                @if(($getTotal->total_quantity) == ($getTotal->used_quantity) )
                                                    <button type="submit" class="btn btn-info pull-right" disabled>Add Outstock</button>
                                                @else
                                                    <button type="submit" class="btn btn-info pull-right">Add Outstock</button>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('page_scripts')
    <script type="text/javascript">
        $('#load_date').datepicker({
            autoclose: true
        });

        $('#outting_type').on('change',function(){
            var optionText = $("#outting_type option:selected").text();
            if (optionText == "Exchange") {
                $('#project').show();
            } else {
                $('#project').hide();
            }
        });

        $('#outstock').on('change',function(){
            var total       = parseInt($('#totalQty').val());
            var useQty      = parseInt($('#useQty').val());
            var leftQty     = total - useQty;
            var outstockQty = parseInt($('#outstock').val());
            if((outstockQty > leftQty)){
                alert('Output stock is greater than total !!! Please Check your output quantity');
                $('#outstock').val("").focus();
            }
        });
    </script>
@endsection