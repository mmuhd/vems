@extends('layouts.master')

@section('title', 'Repairs Create')
@section('extraStyle')
<link type="text/css" rel="stylesheet" href="{{url('/')}}/assets/css/libs/select2/select2.css" />
<link type="text/css" rel="stylesheet" href="{{url('/')}}/assets/css/libs/bootstrap-datepicker/datepicker3.css" />

@endsection
@section('content')
<section>
  <div class="section-header">
    <ol class="breadcrumb">
      <li><a href="{{URL::Route('repairs.index')}}">Repairs</a></li>
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
            action="{{URL::route('repairs.store')}}"
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

                <header>Add a Repair</header>
              </div>
              <br>

              <div class="card-body tab-content">

                {{ csrf_field() }}
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      {!! Form::select('projectType', ['' => '', 'commercial' => 'commercial','Residential' =>'Residential', 'Residential & commercial' => 'Residential & commercial'], null, ['id' => 'projectType' ,'class' => 'form-control select2-list', 'required' => 'required']) !!}
                      <label for="projectType">property Type</label>
                      <p class="help-block">select property type</p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <select id="projects_id" class="form-control select2-list" name="projects_id" required>
                        <option value=""></option>
                      </select>
                      <label for="projects_id">property</label>
                      <p  id="projects_id-error" class="help-block">select a property</p>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <select id="flats_id" class="form-control select2-list" name="flats_id" required>
                        <option value=""></option>
                      </select>
                      <label for="flats_id">Flat</label>
                      <p  id="flats_id-error" class="help-block">select a flat</p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      {!! Form::select('customers_id', $customers, null, ['id' => 'customers_id' ,'class' => 'form-control select2-list', 'required' => 'required']) !!}
                      <label for="customers_id">Tenant</label>
                      <p  id="customers_id-error" class="help-block">select a tenant</p>
                    </div>
                  </div>
                </div>  
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      {!! Form::select('repairsType', ['' => '', 'landlord' => 'landlord','tenant' =>'tenant'], null, ['id' => 'repairsType' ,'class' => 'form-control select2-list', 'required' => 'required']) !!}
                      <label for="repairsType">Notice Type</label>
                      <p class="help-block"></p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      {!! Form::select('format', ['' => '', 'SMS' => 'SMS','WhatsApp' =>'WhatsApp','Email' => 'Email'], null, ['id' => 'format' ,'class' => 'form-control select2-list', 'required' => 'required']) !!}
                      <label for="format">Notice Format</label>
                      <p class="help-block"></p>
                    </div>
                  </div>
                </div>
                <div class="row">

                  <div class="col-lg-6">
                    <div class="form-group">
                      <input type="text" class="form-control" value="{{old('subject')}}"  name="subject" data-rule-minlength="4" maxlength="100" required>
                      <label for="subject">Notice Title/Subject</label>
                      <p class="help-block">min: 4 / max: 100 letters</p>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <div class="input-group date">
                        <div class="input-group-content">
                          <input type="text" name="entryDate" value="@if(old('entryDate')) {{old('entryDate')}} @else {{$today->format('d/m/Y')}} @endif" class="form-control  pick-date" required>
                          <label>Inspection Date</label>
                        </div>
                        <span class="input-group-addon"></span>
                      </div>
                      <p class="help-block"> dd/mm/yyyy</p>
                    </div><!--end .form-group -->
                  </div>
                  <div class="col-lg-3">
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
                </div>
                <div class="row">

                  <div class="col-lg-12">
                    <div class="form-group">
                      <textarea class="form-control"  name="message" maxlength="5000">{{old('message')}}</textarea>
                      <label for="message">Message</label>
                      <p class="help-block">max: 5000 letters</p>
                    </div>
                  </div>
                </div>

                <div class="row">
                 <div class="row">
                  <div class="card-actionbar">
                    <div class="card-actionbar-row">
                      <button type="submit" class="btn btn-primary ink-reaction"><i class="md md-add-circle-outline"></i> Create</button>
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
            $('#menubarToggler').trigger('click');

            $('select').select2();
            $('#projectType').change(function () {
                $("#flats_id").empty();
                $('#flats_id').select2();
                $.getJSON("/project-by-type/"+$(this).val(),function (response) {
                    if(response.length){
                        $("#projects_id").empty();
                        var option = '<option value=""></option>';
                        $("#projects_id").append(option);
                        $.each(response,function (index,project) {
                            var option = '<option value="'+project.id+'">'+project.value+'</option>';
                            $("#projects_id").append(option);
                        });

                    }
                    else {
                        $("#projects_id").empty();
                        var option = '<option value=""></option>';
                        $("#projects_id").append(option);
                    }
                    $('#projects_id').select2();
                });
            });
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight : true

            });
            $('.datepicker2').datepicker({
                format: 'mm-yyyy',
                viewMode: "months",
                minViewMode: "months",
                autoclose: true,
                todayHighlight : true

            });

            $('#projects_id').change(function () {
                $.getJSON("/flats-by-project/"+$(this).val(),function (response) {
                    if(response.length){
                        $("#flats_id").empty();
                        var option = '<option value=""></option>';
                        $("#flats_id").append(option);
                        $.each(response,function (index,flat) {
                            var option = '<option value="'+flat.id+'">'+flat.value+'</option>';
                            $("#flats_id").append(option);
                        });
                    }
                    else {
                        $("#flats_id").empty();
                        var option = '<option value=""></option>';
                        $("#flats_id").append(option);
                    }
                    $('#flats_id').select2();
                });
            });

            $('#flats_id').change(function () {
                $.getJSON("/flat/"+$(this).val(),function (response) {
                    if(response.id){
                        $('#size').text(response.size);
                        window.flatSize = response.size;
                        if(response.parking=="Yes"){
                            $('#parking').text(response.parkingNo);
                        }
                        else{
                            $('#parking').text('No');
                        }
                    }
                    else {
                        $('#size').text('');
                        $('#parking').text('');

                    }
                });
            });

            $('#customers_id').change(function () {
                $.getJSON("/customer-ajax/"+$(this).val(),function (response) {
                    if(response.id){
                        $('#parmanentAddress').text(response.permanentAddress);
                        $('#contactPerson').text(response.contactPerson);
                        $('#contactPersonCellNo').text(response.contactPersonCellNo);
                    }
                    else {
                        $('#parmanentAddress').text('');
                        $('#contactPerson').text('');
                        $('#contactPersonCellNo').text('');

                    }
                });
            });
            $('input.number').keyup(function(event) {

              // skip for arrow keys
              if(event.which >= 37 && event.which <= 40) return;

              // format number
              $(this).val(function(index, value) {
                return value
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                ;
              });
            });

            $('form').submit(function (e) {
                e.preventDefault();
                var isValid = true;
                //validation
                if(!$('#projectType').val()){
                    isValid = false;
                    $('#projectType').parent().addClass('has-error');
                    $('#projectType').focus();
                }
                else{
                    $('#projectType').parent().removeClass('has-error');
                }
                if(!$('#projects_id').val()){
                    isValid = false;
                    $('#projects_id').parent().addClass('has-error');
                    $('#projects_id').focus();
                }
                else{
                    $('#projects_id').parent().removeClass('has-error');
                }

                if(!$('#flats_id').val()){
                    isValid = false;
                    $('#flats_id').parent().addClass('has-error');
                    $('#flats_id').focus();
                }
                else{
                     $('#flats_id').parent().removeClass('has-error');
                }
                if(!$('#customers_id').val()){
                    isValid = false;
                    $('#customers_id').parent().addClass('has-error');
                    $('#customers_id').focus();
                }
                else{
                     $('#customers_id').parent().removeClass('has-error');
                }
                //validation end
                if(isValid){
                    this.submit();
                }

            });
        });
        function submitForm(e) {
          //e.preventDefault(); // remove this in your project!
          $('input.number').each((index, input) => {
            const $input = $(input);
            $input.val($input.val().replace(/,/g, ''));
          });
        }
    </script>
@endsection
