@extends('layouts.master')

@section('title', 'Landlord Update')
@section('extraStyle')
  <link type="text/css" rel="stylesheet" href="{{url('/')}}/assets/css/libs/select2/select2.css" />
  <link type="text/css" rel="stylesheet" href="{{url('/')}}/assets/css/libs/bootstrap-datepicker/datepicker3.css" />


@endsection
@section('content')
  <section>
    <div class="section-header">
      <ol class="breadcrumb">
        <li><a href="{{URL::Route('landlord.index')}}">Landlord</a></li>
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
                    action="{{URL::route('landlord.update',$landlord->id)}}"
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
                    <ul class="nav nav-tabs tabs-text-contrast tabs-warning pull-right" data-toggle="tabs">
                      <li class="active"><a href="#first2">Personal Information</a></li>
                      <li class=""><a href="#second2">Business Information</a></li>
                    </ul>
                    <header>Update a landlord</header>
                  </div>
                  <div class="card-body tab-content">
                    <div class="tab-pane active" id="first2">
                      {{ csrf_field() }}
                      {{ method_field('PATCH') }}

                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <input type="text" class="form-control" value="{{$landlord->name}}"  name="name" data-rule-minlength="4" maxlength="100" required>
                            <label for="name">Name</label>
                            <p class="help-block">min: 4 / max: 100 letters</p>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <input type="text" class="form-control" value="{{$landlord->cellNo}}" name="cellNo" data-rule-minlength="11" maxlength="11" required>
                            <label for="cellNo">Mobile No</label>
                            <p class="help-block"> min & max: 11 letters</p>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <input type="text" class="form-control" value="{{$landlord->phoneNo}}" name="phoneNo" maxlength="15">
                            <label for="phoneNo">Phone No</label>
                            <p class="help-block">max: 15 letters</p>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <input type="email" class="form-control" value="{{$landlord->email}}"  name="email"  maxlength="100">
                            <label for="email">Email</label>
                            <p class="help-block">max: 100 letters</p>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <div class="input-group date">
                              <div class="input-group-content">
                                <input type="text" name="dob"  value="{{ $landlord->dob }}" class="form-control pick-date">
                                <label>Date of Birth</label>
                              </div>
                              <span class="input-group-addon"></span>
                            </div>
                            <p class="help-block"> dd/mm/yyyy</p>
                          </div><!--end .form-group -->
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <div class="input-group date">
                              <div class="input-group-content">
                                <input type="text" readonly value="{{$landlord->entryDate->format('d/m/Y')}}" class="form-control  pick-date">
                                <label>Entry Date</label>
                              </div>
                              <span class="input-group-addon"></span>
                            </div>
                            <p class="help-block"> dd/mm/yyyy</p>
                          </div><!--end .form-group -->
                        </div>
                      </div>
                       <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <input type="text" class="form-control" value="{{$landlord->fatherName}}" name="fatherName" maxlength="100">
                            <label for="fatherName">Occupation</label>
                            <p class="help-block"> max: 100 letters</p>
                          </div>
                        </div>
                         <div class="col-lg-6">
                          <div class="form-group">
                             <textarea class="form-control"  name="mailingAddress" maxlength="500">{{$landlord->mailingAddress}}</textarea>
                            <label for="mailingAddress">Postal Address</label>
                            <p class="help-block">max: 500 letters</p>
                          </div>
                        </div>

                      </div>
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                           <input type="text" class="form-control" value="{{$landlord->motherName}}" name="motherName" maxlength="100">
                            <label for="motherName">Nationality</label>
                            <p class="help-block"> max: 100 letters</p>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                             <select id="passportNo" class="form-control select2-list"  value="{{$landlord->passportNo}}" name="passportNo">
                              <option value="NatiionalID">National ID Card</option>
                              <option value="Passport">International Passport</option>
                              <option value="VotersCard">Permanent Voters Card</option>
                            </select>
                            <label for="passportNo">Means of Identification</label>
                            <p class="help-block">your identifier</p>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                             <input type="text" class="form-control" value="{{$landlord->nidNo}}"  name="nidNo" maxlength="50">
                            <label for="nidNo">ID No</label>
                            <p class="help-block"> max: 50 letters</p>
                          </div>
                        </div>
                        

                      </div>
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                             <textarea class="form-control"  name="presentAddress" maxlength="500">{{$landlord->presentAddress}}</textarea>
                            <label for="presentAddress">Present Address</label>
                            <p class="help-block">max: 500 letters</p>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <textarea class="form-control"  name="permanentAddress"  maxlength="500">{{$landlord->permanentAddress}}</textarea>
                            <label for="permanentAddress">Permanent Address</label>
                            <p class="help-block">max: 500 letters</p>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <input type="text" class="form-control" value="{{$landlord->spouseName}}" name="spouseName" maxlength="100">
                            <label for="spouseName">Bank Name</label>
                            <p class="help-block"> max: 100 letters</p>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <input type="text" class="form-control" value="{{$landlord->NUBAN}}"  name="NUBAN" data-rule-minlength="10" maxlength="10">
                            <label for="NUBAN">NUBAN</label>
                            <p class="help-block"> min & max: 10 letters</p>
                          </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <input type="text" class="form-control" value="{{$landlord->contactPerson}}" name="contactPerson" maxlength="100">
                            <label for="contactPerson">Next of Kin</label>
                            <p class="help-block"> max: 100 letters</p>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <input type="text" class="form-control" value="{{$landlord->contactPersonCellNo}}"  name="contactPersonCellNo" data-rule-minlength="11" maxlength="11">
                            <label for="contactPersonCellNo">Next of Kin Mobile No</label>
                            <p class="help-block"> min & max: 11 letters</p>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                            <select id="landlordType" class="form-control select2-list" value="{{$landlord->landlordType}}" name="landlordType">
                              <option value="Person">Person</option>
                              <option value="Company">Company</option>
                            </select>
                            <label>Landlord Type</label>
                          </div>
                        </div>
                        <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-content">
                                <input type="file" class="form-control" name="photo">
                              </div>
                              <span class="input-group-addon"><i class="fa fa-2x fa-file-image-o info"></i></span>
                            </div>
                            <label>Photo</label>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-content">
                                <input type="file" class="form-control" name="passport">
                              </div>
                              <span class="input-group-addon"><i class="fa fa-2x fa-file info"></i></span>
                            </div>
                            <label>Passport(pdf,image)</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="second2">
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <input type="text" class="form-control"  name="companyName" value="{{$landlord->companyName}}" maxlength="255">
                            <label for="companyName">Company Name</label>
                            <p class="help-block">max: 100 letters</p>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                           <input type="text" class="form-control"  name="cFaxNo" value="{{$landlord->cFaxNo}}" maxlength="15">
                            <label for="cFaxNo">Reg No</label>
                            <p class="help-block">max: 15 letters</p>
                          </div>
                        </div>
                        </div>
                       <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                             <input type="text" class="form-control" value="{{$landlord->cCellNo}}"  name="cCellNo" maxlength="11">
                            <label for="cCellNo">Mobile No</label>
                            <p class="help-block">max: 11 letters</p>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                             <input type="text" class="form-control"  name="cPhoneNo" value="{{$landlord->cPhoneNo}}"  maxlength="15">
                            <label for="cPhoneNo">Phone No</label>
                            <p class="help-block">max: 15 letters</p>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <input type="email" class="form-control"  name="cEmail" value="{{$landlord->cEmail}}" maxlength="100">
                            <label for="cEmail">Email</label>
                            <p class="help-block">max: 100 letters</p>
                          </div>
                        </div>
                      </div>
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="form-group">
                               <input type="text" class="form-control"  name="cContactPerson" value="{{$landlord->cContactPerson}}" maxlength="100">
                              <label for="cContactPerson">Contact person</label>
                              <p class="help-block"> max: 100 letters</p>
                            </div>
                          </div>
                          <div class="col-lg-4">
                          <div class="form-group">
                             <input type="text" class="form-control"  name="designation" value="{{$landlord->designation}}" maxlength="100">
                            <label for="designation">Designation</label>
                            <p class="help-block"> max: 100 letters</p>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                             <input type="text" class="form-control"  name="cContactPersonCellNo" value="{{$landlord->cContactPersonCellNo}}" maxlength="11">
                            <label for="cContactPersonCellNo">Contact Person Mobile No</label>
                            <p class="help-block">max: 11 letters</p>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        
                        <div class="col-lg-6">
                          <div class="form-group">
                             <textarea class="form-control"  name="cAddress" maxlength="500">{{$landlord->cAddress}}</textarea>
                            <label for="cAddress">Address</label>
                            <p class="help-block">max: 500 letters</p>
                          </div>
                        </div>
                       <div class="col-lg-6">
                          <div class="form-group">
                            <textarea class="form-control"  name="cNote" maxlength="1000">{{$landlord->cNote}}</textarea>
                            <label for="cNote">Note</label>
                            <p class="help-block">max: 1000 letters</p>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                            <select name="active" class="form-control">
                              @if($landlord->active == "Yes")
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
