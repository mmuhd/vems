@extends('layouts.master')

@section('title', 'Sent Notices Log')
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
        <li class="active">Sent Notices Log</li>
        <li><a href="{{URL::Route('notice.index')}}">Send New</a></li>
      </ol>
    </div><!--end .section-header -->
    <div class="section-body">
      <section>
        <div class="section-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-head style-primary">
                  <header>Sent Notices Log</header>
                </div>
                <div class="card-body no-padding">
                  <div class="row">
                    <div class="col-md-12">
                      <form class="filters" action="" method="GET" enctype="text/plain">

                        <fieldset>
                          <legend>Filters</legend>
                          <div class="col-md-5">
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder="Phone Number" name="cellNo" value="{{$cellNo}}">
                              <input type="hidden" id="pageHidden" name="page" value="1">
                            </div>
                          </div>
                          <div class="col-md-5">
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder="Email" name="email" value="{{$email}}">
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <button class="btn btn-primary ink-reaction"><i class="md md-search"></i>Refresh</button>
                            </div>
                          </div>
                        </fieldset>
                      </form>

                    </div>

                  </div>
                  <div class="table-responsive no-margin">
                    <table class="table table-striped no-margin">
                      <thead>
                      <tr>
                        <th class="text-center" >Type</th>
                        <th class="text-center" >Format</th>
                        <th class="text-center" >Phone No</th>
                        <th class="text-center" >Email</th>
                        <th class="text-center" >Subject</th>
                        <th class="text-center" >Date</th>
                        <th class="text-center" >Status</th>
                        <th class="text-center" >Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($noticelogs as $notice)
                        <tr>
                          <td>
                            {{$notice->noticeType}}
                          </td>
                                                    
                          <td>{{$notice->format}}</td>
                          <td>{{$notice->cellNo}}</td>
                          <td>{{$notice->email}}</td>
                          <td>{{$notice->subject}}</td>
                          <td>{{$notice->entryDate}}</td>
                          <td>{{$notice->status}}</td>
                          <td>
                            <div class="btn-group pull-right">
                              @can('notice.destroy')
                                <form class="myAction" method="POST" action="{{URL::route('notice.destroy',$notice->id)}}">
                                  <input name="_method" type="hidden" value="DELETE">
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  <button type="submit" class="btn ink-reaction btn-floating-action btn-danger btn-sm" title="Delete">
                                    <i class="fa fa-fw fa-trash"></i>
                                  </button>
                                </form>
                              @endcan
                              @can('notice.edit')
                                <a title="Edit" href="{{URL::route('notice.edit',$notice->id)}}" class="btn ink-reaction btn-floating-action btn-info btn-sm myAction"><i class="fa fa-edit"></i></a>
                              @endcan
                              <a title="Send" target="_blank" href="{{URL::route('notice.show',$notice->id)}}"  class="btn ink-reaction btn-floating-action btn-primary btn-sm myAction"><i class="md md-send"></i>
                              </a>
                            </div>
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div><!--end .table-responsive -->
                  {{ $noticelogs->links() }}
                </div><!--end .card-body -->
              </div><!--end .card -->
            </div><!--end .col -->
          </div><!--end row -->

        </div>
      </section>
    </div>

  </section>

@endsection
@section('extraScript')
  <script>
      $( document ).ready(function() {
          $('#menubarToggler').trigger('click');
          $('.pagination li>a').click(function (e) {
             e.preventDefault();
              $('#pageHidden').val($(this).text());
              $('form.filters').submit();

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