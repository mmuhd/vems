@extends('layouts.master')

@section('title', 'Notice Show')
@section('extraStyle')
<link type="text/css" rel="stylesheet" href="{{url('/')}}/assets/css/libs/select2/select2.css" />
<link type="text/css" rel="stylesheet" href="{{url('/')}}/assets/css/libs/bootstrap-datepicker/datepicker3.css" />


@endsection
@section('content')
<section>
  <div class="section-header">
    <ol class="breadcrumb">
      <li><a href="{{URL::Route('notice.index')}}">Notice</a></li>
      <li class="active">Show</li>
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
            action="{{URL::route('notice.send')}}"
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
              <header>Customize and Send This Notice</header>
              <button type="submit" class="pull-right btn ink-reaction btn-floating-action btn-lg btn-accent"><i class="md md-send"></i></button>

            </div>
            <div class="card-body tab-content">
              <div class="tab-pane active" id="first2">
               {{ csrf_field() }}
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
               @if ($notice->noticeType=="tenant")
               <div class="col-lg-6">
                <div class="form-group">
                  {!! Form::select('customers_id', $customers, null, ['id' => 'customers_id' ,'class' => 'form-control select2-list', 'required' => 'required']) !!}
                  <label for="customers_id">Tenant</label>
                  <p  id="customers_id-error" class="help-block">select a tenant</p>
                </div>
              </div>
              @elseif ($notice->noticeType=="landlord")
              <div class="col-lg-6">
                <div class="form-group">
                 {!! Form::select('landlords_id', $landlords, null, ['class' => 'form-control select2-list', 'required' => 'required']) !!}   
                 <label for="landlords">Property Landlord</label>
               </div>
             </div>
             @elseif ($notice->noticeType=="all_landlords")
             @else
             @endif
             @if ($notice->noticeType=="tenant")
             <div class="col-lg-6">
               @if ($notice->format!="Email") 
               <div class="form-group">

                <input type="text" id="cellNo" class="form-control select2-list"  value="" name="cellNo" required>
                <label for="cellNo">Phone Number</label>
                <p  id="cellNo-error" class="help-block">Tenant Phone No.</p>
              </div>
              @else
              <div class="form-group">

                <input type="text" id="email" class="form-control select2-list"  value="" name="email" required>
                <label for="email">Email</label>
                <p  id="email-error" class="help-block">Tenant Email</p>
              </div>
              @endif
            </div>
            @elseif ($notice->noticeType=="landlord")
            <div class="col-lg-6">
             @if ($notice->format!="Email") 
             <div class="form-group">

              <input type="text" id="cellNo" class="form-control select2-list"  value="" name="cellNo" required>
              <label for="cellNo">Phone Number</label>
              <p  id="cellNo-error" class="help-block">Landlord Phone No.</p>
            </div>
            @else
            <div class="form-group">

              <input type="text" id="email" class="form-control select2-list"  value="" name="email" required>
              <label for="email">Email</label>
              <p  id="email-error" class="help-block">Landlord Email</p>
            </div>
            @endif
          </div>
          @else
          @endif
        </div>

        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <input type="text" class="form-control" value="{{$notice->name}}"  readonly name="name" data-rule-minlength="4" maxlength="100" required>
              <label for="name">Name</label>
              <p class="help-block">min: 4 / max: 100 letters</p>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-group">
              <input type="text" class="form-control" value="{{$notice->subject}}" name="subject" data-rule-minlength="4" maxlength="100" required>
              <label for="subject">Notice Title/Subject</label>
              <p class="help-block">min: 4 / max: 100 letters</p>
            </div>
          </div>

        </div>
        <div class="row">
          @if ($notice->format=="SMS")
          <div class="col-lg-12">
            <div class="form-group">
              <textarea class="form-control" name="message" maxlength="320">{{$notice->message}}</textarea>
              <label for="message">Message</label>
              <p class="help-block">max: 320 letters</p>
            </div>
          </div>
          @else
          <div class="col-lg-12">
            <div class="form-group">
              <textarea class="form-control" id="message" name="message" maxlength="5000">{{$notice->message}}</textarea>
              <label for="message">Message</label>
              <p class="help-block">max: 5000 letters</p>
            </div>
          </div>
          @endif
        </div>
        <div class="row">
          <div class="col-lg-3">
            <div class="form-group">
              <div class="input-group date">
                <div class="input-group-content">
                  <input type="text" name="entryDate" value="@if(old('entryDate')) {{old('entryDate')}} @else {{$today->format('Y-m-d')}} @endif" class="form-control  pick-date" required>
                  <label>Entry Date</label>
                </div>
                <span class="input-group-addon"></span>
              </div>
              <p class="help-block"> yyyy-mm-dd</p>
            </div><!--end .form-group -->
          </div>    
          <div class="col-lg-3">
            <div class="form-group">

              <input type="text" name="notices_id" readonly value="{{$notice->id}}" class="form-control" required>
              <label>ID</label>

            </div><!--end .form-group -->
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
    $('.pick-date').datepicker({autoclose: true, todayHighlight: true, format: "yyyy-mm-dd"});

    $('#customers_id').change(function () {
      $.getJSON("/customer-ajax/"+$(this).val(),function (response) {
        if(response.id){
         if(response.cellNo){
          $('#email').text(response.email);
          $('#cellNo').text(response.cellNo);
        }
        else{
          $('#email').text(response.cEmail);
          $('#cellNo').text(response.cCellNo);
        }
      }
      else {
        $('#email').text('');
        $('#cellNo').text('');


      }
    });
    });
    $('#landlords_id').change(function () {
      $.getJSON("/landlord-ajax/"+$(this).val(),function (response) {
        if(response.id){
         if(response.cellNo){
          $('#email').text(response.email);
          $('#cellNo').text(response.cellNo);
        }
        else{
          $('#email').text(response.cEmail);
          $('#cellNo').text(response.cCellNo);
        }
      }
      else {
        $('#email').text('');
        $('#cellNo').text('');


      }
    });
    });
  });
</script>
@endsection
