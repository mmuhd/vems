@extends('layouts.master')

@section('title', 'Remittance List')
@section('extraStyle')
  <style>
    th{
      font-weight: blod !important;
      color:#000 !important;
    }
  </style>
@endsection
@section('content')
  <section>
    <div class="section-header">
      <ol class="breadcrumb">
        <li class="active">Remittances</li>
        <li><a href="{{URL::Route('remittance.create')}}">New Remittance</a></li>
      </ol>
    </div><!--end .section-header -->
    <div class="section-body">
      <section>
        <div class="section-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-head style-primary">
                  <header>Remittance List</header>
                </div>
                <div class="card-body no-padding">
                  <div class="table-responsive no-margin">
                    <table class="table table-striped no-margin">
                      <thead>
                      <tr>
                        <th width="2%" class="text-center">S/N</th>
                        <th width="10%" class="text-center">Remit. Date</th>
                        <th width="17%" class="text-center">Property</th>
                        <th width="17%" class="text-center">Landlord</th>
                        <th width="10%" class="text-center">Amount</th>
                        <th width="14%" class="text-center">Notes</th>
                        <th width="10%" class="text-center">Entry At</th>
                        <th width="10%" class="text-center">Entry By</th>
                        <th width="10%" class="text-center">Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($remittances as $remittance)
                        <tr>
                          <td class="text-center">{{$remittance->remittanceNo}}</td>
                          <td class="text-center">{{$remittance->entryDate->format('d/m/Y')}}</td>
                          <td class="text-center">{{$remittance->project->name}}</td>
                          <td class="text-center">{{$remittance->landlord->name}}</td>
                          <td class="text-center">{{$remittance->amount}}</td>                      
                          <td class="text-center">{{$remittance->name}}</td>
                          <td class="text-center">{{$remittance->created_at->format('d/m/y h:i A')}}</td>
                          <td class="text-center">{{$remittance->entry->name}}</td>
                          <td>
                            <div class="btn-group pull-right">
                                @can('remittance.destroy')
                              <form class="myAction" method="POST" action="{{URL::route('remittance.destroy',$remittance->id)}}">
                                <input name="_method" type="hidden" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn ink-reaction btn-floating-action btn-danger btn-sm" title="Delete">
                                  <i class="fa fa-fw fa-trash"></i>
                                </button>
                              </form>
                                @endcan
                              <a title="Details" data-url="{{URL::route('remittance.show',$remittance->id)}}" href="#" class="btn ink-reaction btn-floating-action btn-primary btn-sm myAction detailsBtn"><i class="fa fa-list"></i></a>

                            </div>
                            <!--end .btn-group -->
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div><!--end .table-responsive -->
                  {{ $remittances->links() }}
                </div><!--end .card-body -->
              </div><!--end .card -->
            </div><!--end .col -->
          </div><!--end row -->

        </div>
      </section>
    </div>

  </section>
  <div class="offcanvas">
    <!-- BEGIN OFFCANVAS DEMO RIGHT -->
    <div id="offcanvas-demo-size2" class="offcanvas-pane width-10">
      <div class="offcanvas-head">
        <header>More Info</header>
        <div class="offcanvas-tools">
          <a class="btn btn-icon-toggle btn-default-light pull-right" data-dismiss="offcanvas">
            <i class="md md-close"></i>
          </a>
        </div>
      </div>

      <div class="offcanvas-body">
        <div class="table-responsive no-margin">
          <table id="itemTable" class="table table-striped no-margin">
            <thead>
            <tr>
              <th width="50%" class="text-center">item</th>
              <th width="50%" class="text-center">Amount</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>

            </tfoot>

          </table>
        </div>
      </div>

    </div>
    <!-- END OFFCANVAS DEMO RIGHT -->
  </div>

@endsection

@section('extraScript')
  <script>
      $( document ).ready(function() {
          $('.detailsBtn').click(function (e) {
              e.preventDefault();
              var infoUrl = $(this).attr('data-url');
              $.getJSON(infoUrl,function(response){
                  if(response){
                      $('#itemTable tbody').empty();
                      $('#itemTable tfoot').empty();
                      $.each(response.item,function (index,item) {
                          var row = '<tr>'+
                              '<td class="text-center">'+
                              '<span class="text-info">'+item.name+'</span>'+
                              '</td>'+
                              '<td class="text-center">'+
                              '<span class="text-info">'+item.amount+'</span>'+
                              '</td>'+
                              '</tr>';
                          $('#itemTable tbody').append(row);
                      });
                      var row = '<tr>'+
                          '<td class="text-center">'+
                          '<span class="text-bold">Total</span>'+
                          '</td>'+
                          '<td class="text-center">'+
                          '<span class="text-bold">'+response.amount+'</span>'+
                          '</td>'+
                          '</tr>';
                      $('#itemTable tfoot').append(row);

                  }
              });
              $('#base').append('<div class="backdrop"></div>');
              $('#offcanvas-demo-size2').addClass('active');
              $('#offcanvas-demo-size2').attr('style','transform: translate(-400px, 0px);');
              $('body').addClass(' offcanvas-expanded');
              $('body').attr('style','padding-right:15px;');
          });

          $('form.myAction').click(function (e) {
              e.preventDefault();
              var that = this;
              swal({
                  title: 'Are you sure?',
                  text: "If you delete this, related data will be deleted also!",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
              }).then(function () {
                  that.submit();
              })
          });



      });
  </script>
@endsection