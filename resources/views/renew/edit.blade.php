@extends('layouts.master')

@section('title', 'Renew/Review')
@section('extraStyle')
    <link type="text/css" rel="stylesheet" href="{{url('/')}}/assets/css/libs/select2/select2.css" />
    <link type="text/css" rel="stylesheet" href="{{url('/')}}/assets/css/libs/bootstrap-datepicker/datepicker3.css" />

@endsection
@section('content')
    <section>
        <div class="section-header">
            <ol class="breadcrumb">
                <li><a href="{{URL::Route('renew.index')}}">Rented List</a></li>
                <li class="active">Renew/Review</li>
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
                                  action="{{URL::route('renew.update',$rent->id)}}"
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
                                        <header>Renew/Review rent</header>
                                    </div>
                                    <div class="card-body">


                                        <div class="row">

                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}
                                        
                                                <div class="row">
                                            <div class="col-lg-8">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <select id="projects_id" class="form-control select2-list" name="projects_id" readonly required>
                                                                <option value="{{$project->id}}">{{$project->text}}</option>
                                                            </select>
                                                            <label for="projects_id">Property</label>
                                                            <p  id="projects_id-error" class="help-block">The property</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <select id="flats_id" class="form-control select2-list" name="flats_id" readonly required>
                                                                <option value="{{$flat->id}}">{{$flat->text}}</option>
                                                            </select>
                                                            <label for="flats_id">Flat</label>
                                                            <p  id="flats_id-error" class="help-block">The flat</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                             <select id="customers_id" class="form-control select2-list" name="customers_id" readonly required>
                                                                <option value="{{$customer->id}}">{{$customer->text}}</option>
                                                            </select>
                                                            
                                                            <label for="customers_id">Tenant</label>
                                                            <p  id="customers_id-error" class="help-block">The tenant</p>
                                                        </div>
                                                    </div>
                                                     <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control datepicker" value="{{$today->format('d/m/Y')}}" name="entryDate" required>
                                                            <label for="dateOfEntry">Entry date</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                             <input type="text" class="form-control datepicker2" value="{{$newDeedStart}}" name="deedStart" required>
                                                            <label for="deedStart">Period start</label>
                                                        </div>
                                                    </div> <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control datepicker2" value="{{$newDeedEnd}}" name="deedEnd" required>
                                                            <label for="deedEnd">Period end</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <input type="text" readonly class="form-control" id="rentNo" value="{{$rentNo}}" name="rentNo" data-rule-text="true" required>
                                                            <label for="rentNo">Rent No</label>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <input type="number" id="rentAmount" value="{{$rent->rent}}" class="form-control" min="0" name="rent" data-rule-number="true" required>
                                                            <label for="rentAmount">Rent amount</label>
                                                            <p class="help-block">Numbers only</p>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <!--
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <input type="number" id="securityMoney" value="{{$rent->securityMoney}}" class="form-control" min="0" name="securityMoney" data-rule-number="true" required>
                                                            <label for="securityMoney">Security money</label>
                                                            <p class="help-block">Numbers only</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <input type="number" id="serviceCharge" value="{{$rent->serviceCharge}}" class="form-control" min="0" name="serviceCharge" data-rule-number="true" required>
                                                            <label for="serviceCharge">Service Charge</label>
                                                            <p class="help-block">Numbers only</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <input type="number" id="advanceMoney" value="{{$rent->advanceMoney}}" class="form-control" min="0" name="advanceMoney" data-rule-number="true" required>
                                                            <label for="advanceMoney">Advance ₦</label>
                                                            <p class="help-block">Numbers only</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <input type="number" id="monthlyDeduction" class="form-control" min="0" value="{{$rent->monthlyDeduction}}" name="monthlyDeduction" data-rule-number="true" required>
                                                            <label for="monthlyDeduction">Deduction Advance ₦</label>
                                                            <p class="help-block">Numbers only</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <input type="number" id="monthlyDeductionTax" class="form-control" value="{{$rent->monthlyDeductionTax}}" min="0" name="monthlyDeductionTax" data-rule-number="true" required>
                                                            <label for="monthlyDeductionTax">Deduction Tax ₦</label>
                                                            <p class="help-block">Numbers only</p>
                                                        </div>
                                                    </div>
 
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <input type="number" id="utilityCharge" class="form-control" min="0" value="{{$rent->utilityCharge}}" name="utilityCharge" data-rule-number="true" required>
                                                            <label for="utilityCharge">Utility Charge</label>
                                                            <p class="help-block">Numbers only</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <input type="number" id="delayCharge" class="form-control" min="0" value="{{$rent->delayCharge}}" name="delayCharge" data-rule-number="true">
                                                            <label for="delayCharge">Delay Charge</label>
                                                            <p class="help-block">Numbers only</p>
                                                        </div>
                                                    </div>
                                                    
                                                </div> -->
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                <div class="form-group">
                                                    <textarea class="form-control" id="description" name="note" rows="1"  maxlength="1000">{{$rent->note}}</textarea>
                                                    <p class="help-block">Description</p>
                                                    <label for="note">Remarks</label>
                                                </div>
                                            </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-content">
                                                                    <input type="file" class="form-control" name="deedPaper">
                                                                </div>
                                                                <span class="input-group-addon"><i class="fa fa-2x fa-file-image-o info"></i></span>
                                                            </div>
                                                            <label>Tenancy Agreement(pdf,image)</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-content">
                                                                    <input type="file" class="form-control" name="othersPaper">
                                                                </div>
                                                                <span class="input-group-addon"><i class="fa fa-2x fa-file info"></i></span>
                                                            </div>
                                                            <label>Other papers(pdf,image)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            

                                     </div><!--end .card-body -->
                                    <div class="card-actionbar">
                                        <div class="card-actionbar-row">
                                            <button type="submit" class="btn btn-primary ink-reaction"><i class="md md-refresh"></i> Renew</button>
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
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                viewMode: "days",
                minViewMode: "days",
                autoclose: true,
                todayHighlight : true

            });
            $('.datepicker2').datepicker({
                format: 'dd/mm/yyyy',
                viewMode: "days",
                minViewMode: "days",
                autoclose: true,
                todayHighlight : true
                

            });
            $('select').select2();
            window.flatSize = "{{$rent->flat->size}}";
            $('#rentAmount').on('input projectChange paste focus blur',function(){
                var amount = parseFloat($(this).val());
                
                        
        });
            });
    </script>
@endsection
