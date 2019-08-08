@extends('layouts.app')

@section('content')

<section class="connectedSortable">
    
    <br><br><br>
        @include('project.tab')
        <div class="container">
            <div class="col-md-10">

         <form action="/action_page.php" style="margin-top:25px;">
                    <div class="form-group">
                        <label for="">Project Name</label>
                        <input type="text" class="form-control" name="code_no">
                    </div>  

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Select Type</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>Unit 1</option>
                            <option>Unit 2</option>
                            <option>Unit 3</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Quantity:</label>
                        <input type="number" class="form-control" name="stock_name">
                    </div>
                    
                    
                    
                    <div class="form-group">
                        <label for="">Pay Amount</label>
                        <input type="number" class="form-control" name="pay_amount">
                    </div>
                    
                    <div class="form-group">
                        <label for="">Left Amount:</label>
                        <input type="number" class="form-control" name="left_amount">
                    </div>
                   
                    <br>
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="/supplier" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
</section>

@endsection
