@extends('layouts.app')

@section('content')

<section class="connectedSortable">
    
    <br><br><br>
        @include('project.tab')
        <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
      <h1>
        Project Estimate Cost
        <small>#007612</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Estimate</li>
      </ol>
    </section> -->

    <div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4>Project Estimate Cost:</h4>
        This Page Have Been Show For Estimate Cost Beginning Of The Project Until The End. It's Little Different With Actual Cost Because Of It's Just Make For Estimate Cost.
      </div>
    </div>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-md-12">
          <h2 class="page-header">
            Calculation of Estimate for Project A
            <a href="/estimate/create" class="btn btn-success btn-sm pull-right">Create</a>
          </h2>
        </div>
            
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong>Aung Khit Paing</strong><span> (Head Quater)</span><br>
            Phone: (804) 123-5432<br>
            Email: info@almasaeedstudio.com
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong>Mg Mg</strong> <span> (Site Admin) </span><br>
            Phone: (555) 539-1037<br>
            Email: john.doe@example.com
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <!-- <b>Estimate Project #007612</b><br> -->
          <br>
          <b>Project Name:</b> 4F3S8J<br>
          <b>Project Duration:</b> <i><b>From :</b></i> 2/22/2014 <i><b>To :</b></i> 10/22/2014<br>
          <b>Project Location:</b> Yangon
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>    
                <th>Type</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Price</th>
                <th>Total</th>
                <th>Option</th>
            </tr>
            </thead>
            <tbody>
            <tbody>
                @foreach($estimates as $estimate)
                <tr>
                    <td>{{ $estimate->type }}</td>
                    <td>{{ $estimate->quantity }}</td>
                    <td>{{ $estimate->unit }}</td>
                    <td>{{ $estimate->price }}</td>
                    <td>
                        {{ $estimate->quantity  * $estimate->price}}
                    </td>
                    <td>
                          <a href="/estimate/edit" class="btn btn-success btn-sm">edit</a>  <a href="#" class="btn btn-danger btn-sm ">delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
          {{ $estimates->links() }}
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
            <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Estimate Project</h3>

                  <div class="box-tools pull-right">
                    <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button> -->
                    <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                  </div>
                </div>
                <div class="box-body">
                  <canvas id="pieChart" style="height:250px"></canvas>
                </div>
                <!-- /.box-body -->
              </div>
            </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Amount Due <b>From</b> 2/22/2014 <b>To</b> 10/22/2014</p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Total Amount From HQ:</th>
                <td>10,000,000 <span>Kyats</span></td>
              </tr>
              <tr>
                <th>Estimate Amount:</th>
                <td>10,000,000 <span>Kyats</span></td>
              </tr>
              <tr>
                <th>Actual Amount:</th>
                <td>7,000,000 <span>Kyats</span></td>
              </tr>
              <tr>
                <th>Estimate Remaining:</th>
                <td>3,000,000 <span>Kyats</span></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Generate Excel
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
</section>

@endsection

@section('page_scripts')
<!-- jQuery 3 -->
<script src="/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- ChartJS -->
<script src="/adminlte/bower_components/chart.js/Chart.js"></script>
<!-- FastClick -->
<script src="/adminlte/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/adminlte/dist/js/demo.js"></script>

<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var PieData        = [
      {
        value    : 70,
        color    : '#f56954',
        highlight: '#f56954',
        label    : 'Actual Cost'
      },
      {
        value    : 100,
        color    : '#00a65a',
        highlight: '#00a65a',
        label    : 'Estimate Cost'
      },
      {
        value    : 30,
        color    : '#f39c12',
        highlight: '#f39c12',
        label    : 'Remaining'
      },
      
      
    ]
    var pieOptions     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions)
  })
</script>
@endsection
