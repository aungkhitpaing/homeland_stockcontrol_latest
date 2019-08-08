@extends('layouts.app')

@section('content')

<section class="connectedSortable">
    
    <br><br><br>
        @include('project.tab')
        <div class="container">
            <div class="col-md-10">

         <form action="/action_page.php" style="margin-top:25px;">
                    <div class="form-group">
                        <label for="">Type</label>
                        <input type="text" class="form-control" name="code_no">
                    </div>  
                    
                    <div class="form-group">
                        <label for="">Quantity:</label>
                        <input type="number" class="form-control" name="stock_name">
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Select Unit</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>Unit 1</option>
                            <option>Unit 2</option>
                            <option>Unit 3</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="number" class="form-control" name="price">
                    </div>
                    
                    <div class="form-group">
                        <label for="">Total:</label>
                        <input type="number" class="form-control" name="total">
                    </div>
                   
                    <br>
                    <button type="submit" class="btn btn-primary">Edit</button>
                    <a href="/estimate" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
</section>

@endsection
