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
                
                @if(auth()->user()->name == 'admin')
                <form class="form-horizontal" method="POST" action="/project-expense">
                    {{ csrf_field() }}
                    <div class="box-body">
                        
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Account Head</label>
                            <div class="col-sm-10">
                                <select class="site_accountHead form-control" name="site_accountHead_id" required>
                                    <option disabled selected>--- Select your option ---</option>
                                    @foreach(\DB::table('site_account_head_tb')->get() as $data)
                                    <option value="{{$data->id}}">{{$data->account_head_type}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('site_accountHead_id'))
                                <small class="error" style="color:red;opacity:0.8;">
                                    {{ $errors->first('site_accountHead_id') }}
                                </small>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Project</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="project_id" required>
                                    <option disabled selected>--- Select Your Project ---</option>
                                    @foreach(\DB::table('project_tb')->get() as $data)
                                    <option value="{{$data->name}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('project_id'))
                                <small class="error" style="color:red;opacity:0.8;">
                                    {{ $errors->first('project_id') }}
                                </small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group stock">
                                
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
                            <div class="col-sm-2"></div>
                            <div class="col-md-10">
                                <label style="">
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="Cash" required>
                                    Cash
                                </label>
                                <label style="margin-left: 2%;">
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="Bank" required>
                                    Bank
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            
                            <input type="checkbox" name="check" value="1" checked onclick="this.checked=true"> Sa yin pyout
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
                @else 
                
                <form class="form-horizontal" method="POST" action="/project-expense">
                    {{ csrf_field() }}
                    <div class="box-body">
                        
                        <div class="form-group">
                            <label for="investor_name" class="col-sm-2 control-label">Project Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$projectName->name}}" name="project_id" readonly>                                
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
                            <div class="col-sm-2"></div>
                            <div class="col-md-10">
                                <label style="">
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="Cash" required>
                                    Cash
                                </label>
                                <label style="margin-left: 2%;">
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="Bank" required>
                                    Bank
                                </label>
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
                    @endif
              
            </div>
            
        </section>

       
        @endsection
        @section('page_scripts')
        <script>

            $(document).ready(function(){
                $('.site_accountHead').change(function(){
                    $('.stock').html('');
                    var val = $('.site_accountHead').val();
                    $.ajax({
                    type: "GET",
                    url: "/check-account-head-stock/"+val,
                    data: val,
                    success: function(data){
                        if(data == 1){
                            $('.stock').append(

                                `
                                <label for="" class="col-sm-2 control-label">stock</label>
                                <div class="col-sm-10">
                                    <select class="form-control stock-form" name="stock_id" required>
                                        <option disabled selected>--- Select Your Stock ---</option>
                                        @foreach(\DB::table('stocks_tb')->get() as $data)
                                        <option value="{{$data->id}}">{{$data->stock_name}}</option>
                                        @endforeach
                                    </select>

                                    <input type='number' name='qty' class='stock-qty' placeholder='enter qty of stock'>
                                </div>



                                `
                            )
                        }
                    }
                    });
                });
            });

            $(document).on('change', '.stock-form','.stock-qty', function() {
                $('.stock-qty').val('');
                $('#inputamount').val('');
                var val = $('.stock-form').val();
                $.ajax({
                    type: "GET",
                    url: "/get-stock/"+val,
                    data: val,
                    success: function(data){
                        var amount = data;
                    }
                    });
            });

            $(document).on('keyup','.stock-qty', function() {
                var val = $('.stock-form').val();
                var qty = $('.stock-qty').val();
                $.ajax({
                    type: "GET",
                    url: "/get-stock/"+val,
                    data: val,
                    success: function(data){
                        var amount = data * qty;
                        $('#inputamount').val(amount);

                    }
                    });
            });


            $(function () {
                $('#example1').DataTable()
            })
        </script>
        @endsection