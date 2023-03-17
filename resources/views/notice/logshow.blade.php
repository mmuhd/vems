@extends('layouts.master')

@section('title', 'Notice Preview')
@section('extraStyle')
  <link type="text/css" rel="stylesheet" href="{{url('/')}}/assets/css/libs/select2/select2.css" />
  <link type="text/css" rel="stylesheet" href="{{url('/')}}/assets/css/libs/bootstrap-datepicker/datepicker3.css" />


@endsection
@section('content')
  <section>
    <div class="section-header">
      <ol class="breadcrumb">
        <li><a href="{{URL::Route('notice.index')}}">Notice</a></li>
        <li class="active">Preview</li>
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
                    action="{{URL::route('notice.show',$notice->id)}}"
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
                            <header>Sent Notice Preview</header>
                            

                        </div>
                  <div class="card-body tab-content">
                    <div class="tab-pane active" id="first2">
						<div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <input type="text" id="noticeType" class="form-control select2-list" readonly value="{{$notice->noticeType}}" name="noticeType" required>
                      
                            <label>Notice Type</label>
                          </div>
                        </div> 
                     
                        <div class="col-lg-6">
                        <div class="form-group">
                           <input type="text" id="format" class="form-control select2-list" value="{{$notice->format}}" readonly name="format" required>
                             
                          <label for="format">Notice Format</label>
                          <p class="help-block"></p>
                        </div>
                      </div>
                      </div>

                      <div class="row">
                      	
                      	<div class="col-lg-4">
                            <div class="form-group">
                           <input type="text" id="recipient" class="form-control select2-list" value="{{$notice->landlord}} {{$notice->customer}}" readonly name="recipient" required>
                             
                          <label for="format">Notice Recipient</label>
                          <p class="help-block"></p>
                        </div>
                                                    </div>
                                                    
                      	<div class="col-lg-4">
                           <div class="form-group">
                           <input type="text" id="cellNo" class="form-control select2-list" value="{{$notice->cellNo}}" readonly name="cellNo" required>
                             
                          <label for="format">Phone Number</label>
                          <p class="help-block"></p>
                        </div>
                                              </div>
                                              
                       
                      	<div class="col-lg-4">
                          <div class="form-group">
                           <input type="text" id="email" class="form-control select2-list" value="{{$notice->email}}" readonly name="email" required>
                             
                          <label for="format">Notice Recipient</label>
                          <p class="help-block"></p>
                        </div>
                          </div>
                                                  
                      </div>

                      <div class="row">
                                          
                        <div class="col-lg-6">
                          <div class="form-group">
                            <input type="text" class="form-control" value="{{$notice->subject}}" readonly name="subject" data-rule-minlength="4" maxlength="100" required>
                            <label for="subject">Notice Title/Subject</label>
                            <p class="help-block">min: 4 / max: 100 letters</p>
                          </div>
                        </div>
                      <div class="col-lg-6">
                          <div class="form-group">
                            <div class="input-group date">
                              <div class="input-group-content">
                                <input type="text" readonly value="{{$landlord->entryDate->format('d/m/Y')}}" class="form-control  pick-date" >
                                <label>Entry Date</label>
                              </div>
                              <span class="input-group-addon"></span>
                            </div>
                            <p class="help-block"> dd/mm/yyyy</p>
                          </div><!--end .form-group -->
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <textarea class="form-control" id="message" readonly name="message" maxlength="5000">{{$notice->message}}</textarea>
                            <label for="message">Message</label>
                            <p class="help-block">max: 5000 letters</p>
                          </div>
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
