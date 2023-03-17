@extends('layouts.master')

@section('title', 'Property Create')
@section('extraStyle')
  <link type="text/css" rel="stylesheet" href="{{url('/')}}/assets/css/libs/select2/select2.css" />
  <link type="text/css" rel="stylesheet" href="{{url('/')}}/assets/css/libs/bootstrap-datepicker/datepicker3.css" />

@endsection
@section('content')
  <section>
    <div class="section-header">
      <ol class="breadcrumb">
        <li><a href="{{URL::Route('project.index')}}">Properties</a></li>
        <li class="active">Add</li>
      </ol>
    </div><!--end .section-header -->
    <div class="section-body">
      <section>
        <div class="section-body">
          <!-- BEGIN HORIZONTAL FORM -->
          <div class="row">
            <div class="col-lg-12">
              <form class="form form-validate floating-label"
                    novalidate="novalidate"
                    action="{{URL::route('project.store')}}"
                    method="POST"
                    enctype="multipart/form-data">

                    <div class="form-group">
                      @if (count($errors) > 0)
                        <div class="alert alert-danger">
                          <strong>Whoops!</strong> There were some problems with your input.<br><br>
                          <ul>
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                        </div>
                      @endif
                    </div>

                <div class="card">
                  <div class="card-head style-primary">
                    <header>Add A Property</header>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      {{ csrf_field() }}
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <input type="text" class="form-control"  name="projectId" value="BS/" data-rule-minlength="2" maxlength="255" required>
                          <label for="projectId">Property Id</label>
                          <p class="help-block">min: 2 / max: 255 letters</p>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <select id="projectType" class="form-control select2-list" name="projectType" required>
                            <option value="Commercial">Commercial</option>
                            <option value="Residential">Residential</option>
                            <option value="Residential & Commercial">Residential & Commercial</option>
                          </select>
                          <label for="projectType">Property Type</label>
                          <p class="help-block"></p>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <input type="text" class="form-control"  name="name" data-rule-minlength="2" maxlength="255" required>
                          <label for="name">Property Name</label>
                          <p class="help-block">min: 2 / max: 255 letters</p>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <input type="text" class="form-control datepicker" value="{{$today->format('d/m/Y')}}" name="entryDate" required>
                          <label for="dateOfEntry">Date of entry</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <input type="number" class="form-control"  name="lat" data-rule-minlength="4" maxlength="20">
                          <label for="name">Latitude</label>
                          <p class="help-block">min: 2 / max: 20 Numbers</p>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <input type="number" class="form-control"  name="lang" data-rule-minlength="4" maxlength="20">
                          <label for="name">Longtitude</label>
                          <p class="help-block">min: 2 / max: 20 Numbers</p>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          {!! Form::select('areas_id', $areas, null, ['class' => 'form-control select2-list', 'required' => 'required']) !!}
                          <label for="name">Area</label>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <textarea class="form-control"  name="address" rows="1" data-rule-minlength="2" maxlength="500"></textarea>
                          <label for="address">Address</label>
                          <p class="help-block">min: 2 / max: 500 letters</p>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                       <div class="col-lg-6">
                        <div class="form-group">
                           <select id="storied" class="form-control select2-list" name="storied" required>
                              <option value="No">NO</option>
                              <option value="Yes">YES</option>
                            </select>
                          <label for="storied">Building Storied?</label>
                          <p class="help-block">please choose</p>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <input type="text" class="form-control"  name="noOfFloor" value="1" data-rule-number="true" required>
                          <label for="noOfFloor">No of floor</label>
                          <p class="help-block">Numbers only</p>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <input type="text" class="form-control"  name="noOfUnits" value="1" data-rule-number="true" required>
                          <label for="noOfUnits">No of units</label>
                          <p class="help-block">Numbers only</p>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <input type="text" class="form-control"  name="noOfCarParking" value="1" data-rule-number="true" required>
                          <label for="noOfCarParking">No of parking lots</label>
                          <p class="help-block">Numbers only</p>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                         {!! Form::select('landlords_id', $landlords, null, ['class' => 'form-control select2-list', 'required' => 'required']) !!}   
                          <label for="landlords">Property Landlord</label>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <input type="text" class="form-control"  name="agencyFee" value="10" required>
                          <label for="agencyFee">Agency Fee on Property</label>
                          <p class="help-block">Add a Percentage (%)</p>
                        </div>
                      </div>
                       <div class="col-lg-6">
                        <div class="form-group">
                          <textarea class="form-control"  name="description" rows="1"  maxlength="1000"></textarea>
                          <label for="description">Description</label>
                          <p class="help-block">min: 2 / max: 1000 letters</p>
                        </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-content">
                                <input type="file" class="form-control" name="photo">
                              </div>
                              <span class="input-group-addon"><i class="fa fa-2x fa-file-image-o info"></i></span>
                            </div>
                            <label>Property Photo</label>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">

                          <span class="radio-inline radio-styled radio-info">
                            <input type="radio" name="lift"  value="Yes"><span>Yes</span>
                          </span>
                          <span class="radio-inline radio-styled radio-info">
                            <input type="radio" name="lift" checked="true" value="No"><span>No</span>
                          </span>
                          <label for="lift">Lift</label>

                        </div>

                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">

                          <span class="radio-inline radio-styled radio-info">
                            <input type="radio" name="generator"  value="Yes"><span>Yes</span>
                          </span>
                        <span class="radio-inline radio-styled radio-info">
                            <input type="radio" name="generator" checked="true" value="No"><span>No</span>
                          </span>

                        <label for="generator">Generator</label>
                      </div>
                    </div>

                    
                  </div><!--end .card-body -->
                  <div class="card-actionbar">
                    <div class="card-actionbar-row">
                      <button type="submit" class="btn btn-primary ink-reaction"><i class="md md-add-circle-outline"></i> Create</button>
                    </div>
                  </div>
                </div><!--end .card -->
              </form>
            </div><!--end .col -->
          </div><!--end .row -->
          <!-- END HORIZONTAL FORM -->
        </div>
      </section>
    </div>

  </section>

@endsection

@section('extraScript')
  <script src="{{url('/')}}/assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
  <script src="{{url('/')}}/assets/js/libs/select2/select2.min.js"></script>
  <script src="{{url('/')}}/assets/js/libs/jquery-validation/jquery.validate.min.js"></script>
  <script src="{{url('/')}}/assets/js/libs/jquery-validation/additional-methods.min.js"></script>

  <script type="text/javascript">
      $( document ).ready(function() {
          $('select').select2();
          $('.datepicker').datepicker({
              format: 'dd/mm/yyyy',
              autoclose: true,
              todayHighlight : true

          });
          $('.radio-styled').click(function () {
             $(this).children('input').attr('checked', true);
          });
      });

      $('#storied').change(function () {
                if($(this).val()=="Yes"){
                    $('#noOfFloor').show();
      
                }
                else{
                    $('#noOfFloor').hide();
                  
                }
            });

      
  </script>
@endsection
