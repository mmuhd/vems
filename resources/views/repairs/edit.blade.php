@extends('layouts.master')

@section('title', 'Repairs Update')
@section('extraStyle')
  <link type="text/css" rel="stylesheet" href="{{url('/')}}/assets/css/libs/select2/select2.css" />
  <link type="text/css" rel="stylesheet" href="{{url('/')}}/assets/css/libs/bootstrap-datepicker/datepicker3.css" />


@endsection
@section('content')
  <section>
    <div class="section-header">
      <ol class="breadcrumb">
        <li><a href="{{URL::Route('repairs.index')}}">Repairs</a></li>
        <li class="active">Update</li>
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
                    action="{{URL::route('repairs.update',$repairs->id)}}"
                    method="POST"
                    enctype="multipart/form-data"
              >
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

                 <div class="card card-underline">
                  <div class="card-head style-primary">
                    
                    <header>Update a Tenant</header>
                  </div>
                  <div class="card-body tab-content">
                    <div class="tab-pane active" id="first2">
                      {{ csrf_field() }}
                      {{ method_field('PATCH') }}

                       <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                            <select id="repairsType" class="form-control select2-list" value="{{$repairs->repairsType}}" name="repairsType" required>
                              <option value="landlord">Landlord</option>
                              <option value="tenant">Tenant</option>
                            </select>
                            <label>Repairs Type</label>
                          </div>
                        </div> 
                      <div class="col-lg-4">
                          <div class="form-group">
                            <div class="input-group date">
                              <div class="input-group-content">
                                <input type="text" name="entryDate" readonly value="{{$repairs->entryDate->format('d/m/Y')}}" class="form-control  pick-date" >
                                <label>Entry Date</label>
                              </div>
                              <span class="input-group-addon"></span>
                            </div>
                            <p class="help-block"> dd/mm/yyyy</p>
                          </div><!--end .form-group -->
                        </div>
                         <div class="col-lg-4">
                          <div class="form-group">
                            <select name="active" class="form-control">
                              @if($repairs->active == "Yes")
                                <option value="Yes" selected>Yes</option>
                                <option value="No">No</option>
                              @else
                                <option value="Yes" >Yes</option>
                                <option value="No" selected>No</option>
                              @endif
                            </select>
                            <label for="active">Active</label>
                          </div>
                        </div>
                      </div>
                                         
          
                      <div class="row">
                        <div class="col-lg-4">
                        <div class="form-group">
                           <select id="format" class="form-control select2-list" value="{{$repairs->format}}" name="format" required>
                              <option value="SMS">SMS</option>
                              <option value="WhatsApp">WhatsApp</option>
                              <option value="Email">Email</option>
                            </select>
                          <label for="format">Repairs Format</label>
                          <p class="help-block"></p>
                        </div>
                      </div>
                      
                      <div class="col-lg-4">
                          <div class="form-group">
                            <input type="text" class="form-control" value="{{$repairs->name}}"  name="name" data-rule-minlength="4" maxlength="100" required>
                            <label for="name">Name</label>
                            <p class="help-block">min: 4 / max: 100 letters</p>
                          </div>
                        </div>
                      
                        <div class="col-lg-4">
                          <div class="form-group">
                            <input type="text" class="form-control" value="{{$repairs->subject}}"  name="subject" data-rule-minlength="4" maxlength="100" required>
                            <label for="subject">Repairs Title/Subject</label>
                            <p class="help-block">min: 4 / max: 100 letters</p>
                          </div>
                        </div>
                      
                      </div>
                      <div class="row">
                        
                        <div class="col-lg-12">
                          <div class="form-group">
                            <textarea class="form-control"  name="message" maxlength="5000">{{$repairs->message}}</textarea>
                            <label for="message">Message</label>
                            <p class="help-block">max: 5000 letters</p>
                          </div>
                        </div>
                      </div>
                               
                    
                    
                                          
                    <div class="card-actionbar">
                      <div class="card-actionbar-row">
                       <button type="submit" class="btn btn-primary ink-reaction"><i class="md md-refresh"></i> Update</button>
                      </div>
                    </div>
                  </div>

                </div>

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
  <script src="{{url('/')}}/assets/js/libs/select2/select2.min.js"></script>
  <script src="{{url('/')}}/assets/js/libs/jquery-validation/jquery.validate.min.js"></script>
  <script src="{{url('/')}}/assets/js/libs/jquery-validation/additional-methods.min.js"></script>
  <script src="{{url('/')}}/assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>

  <script type="text/javascript">
      $( document ).ready(function() {
          $('select').select2();
          $('.pick-date').datepicker({autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"});
      });
  </script>
@endsection
