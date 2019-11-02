@extends('layouts.app')

@section('content')
<section class="content">

<table class="table table-bordered">
        <tr>
            <td>original expend</td>
            <td></td>
            <td>update expend</td>
        </tr>
        @foreach($site_cashbook as $site)
        <tbody>
        <tr>
            <td>{{ $site->original_expend }}</td>
            <td> --- ></td>
            <td>{{ $site->update_expend }}</td>
        </tr>
        </tbody>
        @endforeach
</table>
</section>

@endsection