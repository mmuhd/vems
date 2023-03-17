@extends('layouts.master')

@section('title', 'Notices List')
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
        <li class="active">Notices</li>
        <li><a href="{{URL::Route('notice.create')}}">Add</a></li>
      </ol>
    </div><!--end .section-header -->
    <div class="section-body">
      <section>
        <div class="section-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-head style-primary">
                  <header>Notices List</header>
                </div>
                <div class="card-body no-padding">
                  <div class="row">
                    <div class="col-md-12">
                      <form class="filters" action="" method="GET" enctype="text/plain">

                        <fieldset>
                          <legend>Filters</legend>
                          <div class="col-md-5">
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder="notice name" name="name" value="{{$name}}">
                              <input type="hidden" id="pageHidden" name="page" value="1">
                            </div>
                          </div>
                          <div class="col-md-5">
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder="notice subject" name="subject" value="{{$subject}}">
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
                        
                        <th class="text-center" >Name</th>
                        <th class="text-center" >Format</th>
                        <th class="text-center" >Subject</th>
                        <th class="text-center" >Message</th>
                        <th class="text-center" >Entry Date</th>
                        <th class="text-center" >Active</th>
                        <th class="text-center" >Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($notices as $notice)
                        <tr>
                          <td>
                            {{$notice->noticeType}}
                          </td>
                                                    
                          <td>{{$notice->name}}</td>
                          <td>{{$notice->format}}</td>
                          <td>{{$notice->subject}}</td>
                          <td>{{$notice->message}}</td>
                          <td>{{$notice->entryDate->format('F j, Y')}}</td>
                          <td>{{$notice->active}}</td>
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
                  {{ $notices->links() }}
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