@extends('layouts.master')

@section('title', 'Landloard Property Report')
@section('extraStyle')
@endsection
@section('content')
  <section>
    <div class="section-header no-print">
      <ol class="breadcrumb">
        <li class="active">Landlord Properties Report</li>
      </ol>
    </div><!--end .section-header -->
    <div class="section-body">
      <section>
        <div class="section-body">
          <div class="row no-print">
            <div class="col-lg-12">
              <form class="form form-validate floating-label"
                    novalidate="novalidate"
                    action="{{URL::route('report.landlord_properties')}}"
                    method="GET"
                    enctype="multipart/form-data">

                <div class="card">
                  <div class="card-head style-primary">
                    <header>Filters</header>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="Search by Property name" name="name" value="{{$name}}">
                          <input type="hidden" id="pageHidden" name="page" value="1">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          {!! Form::select('projectType', ['All' => 'All', 'Commercial' => 'Commercial','Residential' =>'Residential', 'Residential & Commercial' => 'Residential & Commercial'], $projectType, ['id' => 'projectType' ,'class' => 'form-control select2-list', 'required' => 'required']) !!}
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          {!! Form::select('landlords_id', $landlords, $landlord, ['class' => 'form-control select2-list', 'required' => 'required']) !!}
                        </div>
                      </div>

                      <div class="col-lg-2">
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary ink-reaction"><i class="md md-filter-list"></i> Get</button>
                        </div>
                      </div>
                    </div>



                  </div><!--end .card-body -->
                </div><!--end .card -->
              </form>

            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card card-printable style-default-light">
                <div class="card-head no-print">
                  <div class="tools">
                    <div class="btn-group">
                      <a class="btn btn-floating-action btn-primary" href="javascript:void(0);" onclick="javascript:window.print();"><i class="md md-print"></i></a>
                    </div>
                  </div>
                </div><!--end .card-head -->
                <div class="card-body style-default-bright top-zero">
                  <div class="row">
                    <div class="col-xs-5">
                      <img src="/assets/img/balasabo-icon.png" height="80px" width="100px" alt="">
                      <span class="text-left" style="font-size:16px">Bala Sabo & Co.</span>
                    </div>
                    <div class="col-xs-5 text-center">
                      <h3 class="text-dark text-default-dark"><strong>All @if($projectType !="All") {{$projectType}} @endif Properties @if($landlord !="") Belonging to {{\App\Landlord::where('id',$landlord)->first()->name}} @endif </strong></h3>
                    </div>
                    <div class="col-xs-2 text-right">
                      <div class="pull-right">Print:{{ date('d/m/Y') }} </div>
                    </div>
                  </div><!--end .row -->
                  {{--<div class="row">--}}
                  {{--<div class="col-xs-4">--}}
                  {{--<div class="well">--}}
                  {{--<strong>Bala Sabo & Co.</strong><br>--}}
                  {{--No. 334, <br>--}}
                  {{--Aminu Kano Way, Opp Isyaka Rabiu Mosque, Kano, Nigeria.<br>--}}
                  {{--<abbr title="Phone">Phone:</abbr> (234) 80-39431584--}}
                  {{--</div>--}}
                  {{--</div><!--end .col -->--}}
                  {{--<div class="col-xs-4">--}}

                  {{--</div><!--end .col -->--}}
                  {{--<div class="col-xs-4">--}}
                  {{--<div class="well">--}}
                  {{--<div class="clearfix">--}}
                  {{--<div class="pull-left">Print DATE : </div>--}}
                  {{--<div class="pull-right"> {{ date('F j,Y') }} </div>--}}
                  {{--</div>--}}
                  {{--</div>--}}
                  {{--</div><!--end .col -->--}}
                  {{--</div><!--end .row -->--}}
                  <div class="row">
                    <div class="col-md-12">
                      <table class="table table-striped">
                        <thead>
                        <tr>
                          @if($projectType !="All")
                          @else
                            <th style="width:5%" class="text-center">Type</th>
                          @endif
                          <th style="width:20%" class="text-center">Name</th>
                          <th style="width:5%" class="text-center">Area</th>
                          <th style="width:20%" class="text-center">Address</th>
                          <th style="width:20%" class="text-center">Storied</th>
                          <th style="width:5%" class="text-center">Units</th>
                          <th style="width:5%" class="text-center">Floors</th>
                          <th style="width:5%" class="text-center">Parking</th>
                          <th style="width:5%" class="text-center">Lift</th>
                          <th style="width:5%" class="text-center">Generator</th>
                          <th style="width:5%" class="text-center">Entry</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($projects as $project)
                          <tr>
                            @if($projectType !="All")
                            @else
                              <td class="text-center">{{$project->projectType}}</td>
                            @endif
                            <td class="text-center">{{$project->name}}</td>
                            <td  class="text-center">{{$project->area->name}}</td>
                            <td  class="text-center">{{$project->address}}</td>
                            <td  class="text-center">{{$project->storied}}</td>
                            <td class="text-center">{{$project->noOfUnits}}</td>
                            <td class="text-center">{{$project->noOfFloor}}</td>
                            <td class="text-center">{{$project->noOfCarParking}}</td>
                            <td class="text-center">{{$project->lift}}</td>
                            <td class="text-center">{{$project->generator}}</td>
                            <td class="text-center">{{$project->entryDate->format('d/m/Y')}}</td>
                          </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                          <td colspan=" @if($projectType !="All") 9 @else 10 @endif" class="text-right"><strong class="text-lg text-default-dark">Total</strong></td>
                          <td class="text-right"><strong class="text-lg text-default-dark">{{count($projects)}}</strong></td>
                        </tr>
                        </tfoot>
                      </table>
                    </div><!--end .col -->
                  </div><!--end .row -->

                </div><!--end .card-body -->
              </div><!--end .card -->
            </div><!--end .col -->
          </div><!--end .row -->
        </div>
      </section>
    </div>

  </section>
@endsection

@section('extraScript')
  <script type="text/javascript">
      $( document ).ready(function() {
          $('#menubarToggler').trigger('click');
      });
  </script>
@endsection
