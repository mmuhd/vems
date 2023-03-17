@extends('layouts.master')

@section('title', 'New Remittance')
@section('extraStyle')
    <link type="text/css" rel="stylesheet" href="{{url('/')}}/assets/css/libs/select2/select2.css" />
    <link type="text/css" rel="stylesheet" href="{{url('/')}}/assets/css/libs/bootstrap-datepicker/datepicker3.css" />

@endsection
@section('content')
    <section>
        <div class="section-header">
            <ol class="breadcrumb">
                <li><a href="{{URL::Route('remittance.index')}}">Remittances</a></li>
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
                                  action="{{URL::route('remittance.store')}}"
                                  method="POST"
                                  enctype="multipart/form-data">

                                <div class="card">
                                    <div class="card-head style-primary">
                                        <header>Add New Remittance</header>
                                    </div>
                                    <div class="card-body">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    {!! Form::select('projectType', ['' => '', 'Commercial' => 'Commercial','Residential' =>'Residential', 'Residential & Commercial' => 'Residential & Commercial'], null, ['id' => 'projectType' ,'class' => 'form-control select2-list', 'required' => 'required']) !!}
                                                    <label for="projectType">Property Type</label>
                                                    <p class="help-block">select property type</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <select id="projects_id" class="form-control select2-list" name="projects_id" required>
                                                        <option value=""></option>
                                                    </select>
                                                    <label for="projects_id">property</label>
                                                    <p  id="projects_id-error" class="help-block">select a property</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                 {!! Form::select('landlords_id', $landlords, null, ['class' => 'form-control select2-list', 'required' => 'required']) !!}   
                                                  <label for="landlords">Property Landlord</label>
                                                </div>
                                              </div>
                                        </div>
                                       <div class="row">
                                          <div class="col-lg-4">
                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="remittanceNo" value="{{$remittanceNo}}" name="remittanceNo" required>
                                                    <label for="remittanceNo">Remittance No</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control datepicker" value="{{$today->format('d/m/Y')}}" name="entryDate" required>
                                                    <label for="entryDate">Remittance date</label>
                                                </div>
                                            </div>
                                            
                                        
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="card" id="flatInfo">
                                                    <div class="card-head style-default">
                                                        <header>Remittance Item Entry</header>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <input type="text"  class="form-control" id="item" value="">
                                                                <label for="item">Item name</label>
                                                                <p  class="help-block">type name[max:255 letters]</p>

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <input type="number" min="0"  class="form-control" id="itemAmount" value="">
                                                                <label for="itemAmount">Amount</label>
                                                                <p class="help-block">enter amount</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-actionbar">
                                                        <div class="card-actionbar-row">
                                                            <button type="button" class="btn btn-info btn-sm ink-reaction btn-floating-action" id="addItem"><i class="md md-add"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="card" id="flatInfo">
                                                    <div class="card-head style-default">
                                                        <header style="width: 100%">Remittances <label id="totalAmount" class="pull-right text-info text-bold">Total : 0</label></header>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive no-margin">
                                                            <table id="itemTable" class="table table-striped no-margin">
                                                                <thead>
                                                                <tr>
                                                                    <th width="45%" class="text-center">item</th>
                                                                    <th width="45%" class="text-center">Amount</th>
                                                                    <th width="10%" class="text-center">Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                </tbody>

                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


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
                                </div><!--end .card-body -->
                                <div class="card-actionbar">
                                    <div class="card-actionbar-row">
                                        <button type="submit" class="btn btn-primary ink-reaction"><i class="md md-add-circle-outline"></i> Save</button>
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
        var ValidateCollectionForm = function () {
            var isValid = true;
            //validation
            if(!$('#projectType').val()){
                isValid = false;
                $('#projectType').parent().addClass('has-error');
                $('#projectType').focus;
            }
            else{
                isValid=true;
                $('#projectType').parent().removeClass('has-error');
            }
            if(!$('#projects_id').val()){
                isValid = false;
                $('#projects_id').parent().addClass('has-error');
                $('#projects_id').focus;
            }
            else{
                isValid=true;
                $('#projects_id').parent().removeClass('has-error');
            }
            var items = $('#itemTable tbody input[name="amounts[]"]');
            if(items.length){
                isValid = true;
            }
            else{
                isValid = false;
                $('#item').parent().addClass('has-error');
                $('#item').focus();
                toastr.error('Please add some item','Validation Error!')
            }

            return isValid;
        };
        var updateAmount = function () {
            var total = 0;
            $('#itemTable tbody input[name="amounts[]"]').each(function () {
                total += parseFloat($(this).val());
            });
            $('#totalAmount').text('Total : '+total);
        };
        var addItemToTable = function(item,amount){
            var row = '<tr>'+
                '<td class="text-center">'+
                '<span class="text-info">'+item+'</span>'+
                '<input type="hidden" value="'+item+'" name="items[]">'+
                '</td>'+
                '<td class="text-center">'+
                '<span class="text-info">'+amount+'</span>'+
                '<input type="hidden" value="'+amount+'" name="amounts[]">'+
                '</td>'+
                '<td class="text-center">'+
                '<a href="#" class="btn btn-sm btn-danger ink-reaction btn-floating-action removeItem"><i class="md md-clear"></i></a>'+
                '</td>'+
                '</tr>';
            $('#itemTable tbody').append(row);
            updateAmount();
        };
        $( document ).ready(function() {
            $('#menubarToggler').trigger('click');
            $('select').select2();
            $('#projectType').change(function () {
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

            //item add code
            $('#addItem').click(function () {
                var item = $('#item').val();
                var itemAmount = $('#itemAmount').val();
                if(!item){
                    $('#item').parent().addClass('has-error');
                    $('#item').focus();
                }
                else{
                    $('#item').parent().removeClass('has-error');

                }
                if(!itemAmount){
                    $('#itemAmount').parent().addClass('has-error');
                    $('#itemAmount').focus();
                }
                else{
                    $('#itemAmount').parent().removeClass('has-error');
                }

                if(item && itemAmount){
                    addItemToTable(item,itemAmount);
                    $('#item').val('');
                    $('#itemAmount').val('');
                    $('#item').focus();
                }

            });
            $('html').on('click','a.removeItem',function () {
                e.preventDefault();
                $(this).closest('tr').remove();
                updateAmount();
            });
            $('form').submit(function (e) {
                e.preventDefault();
                //validation form
                var isValid = ValidateCollectionForm();
                if(isValid){
                    this.submit();
                }

            });
        });
    </script>
@endsection
