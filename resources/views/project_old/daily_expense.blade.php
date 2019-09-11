@extends('layouts.app')

@section('content')

<section class="connectedSortable">
    
    <br><br><br>
    @include('project.tab')
    <div class="container">
        <div class="col-md-10">
            
            <form action="/action_page.php" style="margin-top:25px;">
                <div class="form-group">
                    <label for="exampleFormControlSelect1" class="estimate_type">Estimate Type</label>
                    <select class="form-control estimate_type" id="exampleFormControlSelect1">
                        <option>Estimate Type 1</option>
                        <option>Estimate Type 2</option>
                        <option>Estimate Type 3</option>                            
                    </select>
                </div>  
                
                <div class="form-group">
                    <label for="" class="quantity">Quantity:</label>
                    <input type="number" class="form-control quantity" name="stock_name">
                </div>

                <div class="form-group">
                    <label for="" class="invoice_no">Invoice No:</label>
                    <input type="number" class="form-control invoice_no" name="invoice_no">
                </div>
                
                <div class="form-group">
                    <label for="exampleFormControlSelect1" class="unit">Select Unit</label>
                    <select class="form-control unit" id="exampleFormControlSelect1">
                        <option>Unit 1</option>
                        <option>Unit 2</option>
                        <option>Unit 3</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="">Amount</label>
                    <input type="number" class="form-control" name="price">
                </div>

                <div class="form-group">
                    <div class="radio">
                        <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                            Supplier
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                            Output voucher
                        </label>
                    </div>
                </div>

                <br>

                <!-- dropdown -->
                <div class="form-group suppliername">
                    <label for="exampleFormControlSelect1">Supplier Name</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option>Supp 1</option>
                        <option>Supp 2</option>
                        <option>Supp 3</option>
                    </select>
                </div>

                <!-- attachment -->
                <div class="form-group attachment">
                    <label for="">Attachement</label>
                    <input type="file" class="form-control attachement" name="attachement">
                </div>
                <br>

                <a href="/dailyexpense" type="submit" class="btn btn-primary">Create</a>
            </form>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function(){
        $('.invoice_no').hide();
        $('.attachment').hide();                
            $('#optionsRadios2').click(function(){
                if($(this).prop("checked") == true){
                    $('.attachment').show();
                    $('.suppliername').hide();
                    $('.invoice_no').show();
                    $('.estimate_type').hide();
                    $('.quantity').hide();
                    $('.unit').hide();
                }
            });
            $('#optionsRadios1').click(function(){
                if($(this).prop("checked") == true){
                    $('.attachment').hide();
                    $('.suppliername').show();  
                    $('.invoice_no').hide();              
                }
            });

    });
</script>
@endsection
