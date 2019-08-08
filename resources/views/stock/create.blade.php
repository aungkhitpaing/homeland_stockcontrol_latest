@extends('layouts.app')

@section('content')

<section class="connectedSortable">
    
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1>Create Stock</h1>
                <form action="/action_page.php" style="margin-top:25px;">
                    <div class="form-group">
                        <label for="">Code No:</label>
                        <input type="text" class="form-control" name="code_no">
                    </div>  
                    
                    <div class="form-group">
                        <label for="">Stock Name:</label>
                        <input type="text" class="form-control" name="stock_name">
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Select Project</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>Project 1</option>
                            <option>Project 2</option>
                            <option>Project 3</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="">From Date</label>
                        <input type="date" class="form-control" name="stock_name">
                    </div>
                    
                    <div class="form-group">
                        <label for="">To Date:</label>
                        <input type="date" class="form-control" name="stock_name">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="">
                        <label class="form-check-label">
                            Avaliable?
                        </label>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </section>
    @endsection
    