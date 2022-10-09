@extends('layouts.master')

@section('title', 'Dashboard')
@section('extraStyle')
<link type="text/css" rel="stylesheet" href="{{url('/')}}/assets/css/libs/rickshaw/rickshaw.css" />
<link type="text/css" rel="stylesheet" href="{{url('/')}}/assets/css/libs/morris/morris.core.css" />

@endsection
@section('content')
			<!-- BEGIN Page SECTION -->

			<section>
				<div id="map"></div>
				<div class="section-header">
					<ol class="breadcrumb">
						<li class="active"><a href="{{URL::Route('user.dashboard')}}">Dashboard</a></li>
						<!--<li class="active">Blank page</li>-->
					</ol>
				</div><!--end .section-header -->	
				<div class="section-body">

							<section>
								<div class="section-body">
									<div class="row">

										<!-- BEGIN ALERT - REVENUE -->
										<div class="col-md-4 col-sm-6">
											<div class="card">
												<div class="card-body no-padding">
													<div class="alert alert-callout alert-info no-margin">
														<strong class="text-xl"><i class="fa-ngn">&#0012₦</i> {{number_format($collections, 2, '.', ',')}}</strong><br/>
														<span class="opacity-100">Collections</span>
														<div class="stick-bottom-left-right">
															<div class="progress progress-hairline no-margin">
																<div class="progress-bar progress-bar-info" style="width:100%"></div>
															</div>
														</div>
													</div>
												</div><!--end .card-body -->
											</div><!--end .card -->
										</div><!--end .col -->
										<!-- END ALERT - REVENUE -->

										<!-- BEGIN ALERT - VISITS -->
										<div class="col-md-4 col-sm-6">
											<div class="card">
												<div class="card-body no-padding">
													<div class="alert alert-callout alert-warning no-margin">
														<strong class="text-xl"><i class="fa-ngn">&#0012₦</i> {{number_format($totalDue, 2, '.', ',')}}</strong><br/>
														<span class="opacity-100">Due</span>
														<div class="stick-bottom-left-right">
															<div class="progress progress-hairline no-margin">
																<div class="progress-bar progress-bar-warning" style="width:100%"></div>
															</div>
														</div>
													</div>
												</div><!--end .card-body -->
											</div><!--end .card -->
										</div><!--end .col -->
										<!-- END ALERT - VISITS -->

										<!-- BEGIN ALERT - BOUNCE RATES -->
										<div class="col-md-4 col-sm-6">
											<div class="card">
												<div class="card-body no-padding">
													<div class="alert alert-callout alert-success no-margin">
														<strong class="text-xl"><i class="fa-ngn">&#0012₦</i> {{number_format($total, 2, '.', ',')}}</strong><br/>
														<span class="opacity-100">Total</span>
														<div class="stick-bottom-left-right">
															<div class="progress progress-hairline no-margin">
																<div class="progress-bar progress-bar-success" style="width:100%"></div>
															</div>
														</div>
													</div>
												</div><!--end .card-body -->
											</div><!--end .card -->
										</div><!--end .col -->
										<!-- END ALERT - BOUNCE RATES -->



									</div><!--end .row -->

									<div class="row">

										<!-- BEGIN REGISTRATION HISTORY -->
										<div class="col-md-9">
											<div class="card">
												<div class="card-head">
													<header>Rent Collection history</header>
												</div><!--end .card-head -->
												<div class="card-body no-padding height-9">

													<div class="stick-bottom-left-right force-padding">
														<div id="flot-registrations" class="flot height-5" data-title="Collection history" data-color="#0aa89e"></div>
													</div>
												</div><!--end .card-body -->
											</div><!--end .card -->
										</div><!--end .col -->
										<!-- END REGISTRATION HISTORY -->


										<!-- BEGIN NEW Flat -->
										<div class="col-md-3">
											<div class="card">
												<div class="card-head">
													<header>New Tenants</header>
												</div><!--end .card-head -->
												<div class="card-body no-padding height-9 scroll">
													<ul class="list divider-full-bleed">
														@foreach($newRenters as $renter)
														<li class="tile">
															<div class="tile-content">
																<div class="tile-icon">
																	<img src="{{URL::asset('storage')}}/@if($renter->customer->photo){{$renter->customer->photo}} @else{{'customers/avatar.png'}}@endif" alt="" />
																</div>
																<div class="tile-text">{{$renter->customer->name}}</div>
															</div>
															<a class="btn btn-flat ink-reaction" href="{{URL::route('customer.show',$renter->customer->id)}}">
																<i class="md md-arrow-forward text-default-light"></i>
															</a>
														</li>
														@endforeach
													</ul>
													<a href="{{URL::route('rent.index')}}" class="pull-right text-info">View all <i class="md md-arrow-forward text-default-light"></i></a>

												</div><!--end .card-body -->
											</div><!--end .card -->
										</div><!--end .col -->
										<!-- END NEW Flat -->

									</div><!--end .row -->
								</div><!--end .section-body -->
							</section>



				</div><!--end .section-body -->
			</section>
			<!-- BEGIN Page SECTION -->
@endsection

@section('extraScript')
<script defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuqNbDwbIiD9zoWeeSXBWEGBzEYLKPbQ8&callback=initMap">
</script>
<script src="{{url('/')}}/assets/js/libs/spin.js/spin.min.js"></script>
<script src="{{url('/')}}/assets/js/libs/autosize/jquery.autosize.min.js"></script>
<script src="{{url('/')}}/assets/js/libs/moment/moment.min.js"></script>
<script src="{{url('/')}}/assets/js/libs/flot/jquery.flot.min.js"></script>
<script src="{{url('/')}}/assets/js/libs/flot/jquery.flot.time.min.js"></script>
<script src="{{url('/')}}/assets/js/libs/flot/jquery.flot.resize.min.js"></script>
<script src="{{url('/')}}/assets/js/libs/flot/jquery.flot.orderBars.js"></script>
<script src="{{url('/')}}/assets/js/libs/flot/jquery.flot.pie.js"></script>
<script src="{{url('/')}}/assets/js/libs/flot/curvedLines.js"></script>
<script src="{{url('/')}}/assets/js/libs/jquery-knob/jquery.knob.min.js"></script>
<script src="{{url('/')}}/assets/js/libs/sparkline/jquery.sparkline.min.js"></script>
<script src="{{url('/')}}/assets/js/libs/d3/d3.min.js"></script>
<script src="{{url('/')}}/assets/js/libs/d3/d3.v3.js"></script>
<script src="{{url('/')}}/assets/js/libs/rickshaw/rickshaw.min.js"></script>
<script src="{{url('/')}}/assets/js/core/demo/Demo.js"></script>

	<script>
		var myDateFormater = function(mydate){
		    var datesPart = mydate.split('-');
            return datesPart[1]+'-01-'+datesPart[0];
		};
		(function (namespace, $) {
		"use strict";

		var DemoDashboard = function () {
		// Create reference to this instance
		var o = this;
		// Initialize app when document is ready
		$(document).ready(function () {
		o.initialize();
		});

		};
		var p = DemoDashboard.prototype;

		// =========================================================================
		// MEMBERS
		// =========================================================================

		p.rickshawSeries = [[], []];
		p.rickshawGraph = null;
		p.rickshawRandomData = null;
		p.rickshawTimer = null;

		// =========================================================================
		// INIT
		// =========================================================================

		p.initialize = function () {
		this._initFlotRegistration();
		};


		// =========================================================================
		// FLOT
		// =========================================================================

		p._initFlotRegistration = function () {
		var o = this;
		var chart = $("#flot-registrations");

		// Elements check
		if (!$.isFunction($.fn.plot) || chart.length === 0) {
		return;
		}

		// Chart data
		var data = [
		{
		label: 'Collections',
		data: [
		    @foreach($collectionsAll as $collection)
		[moment(myDateFormater('{{$collection->month}}'), "MM-DD-YYYY").valueOf(), {{$collection->amounts}}],
			@endforeach
		],
		last: true
		}
		];

		// Chart options
		var labelColor = chart.css('color');
		var options = {
		colors: chart.data('color').split(','),
		series: {
		shadowSize: 0,
		lines: {
		show: true,
		lineWidth: 2
		},
		points: {
		show: true,
		radius: 3,
		lineWidth: 2
		}
		},
		legend: {
		show: false
		},
		xaxis: {
		mode: "time",
		timeformat: "%b %y",
		color: 'rgba(0, 0, 0, 0)',
		font: {color: labelColor}
		},
		yaxis: {
		font: {color: labelColor}
		},
		grid: {
		borderWidth: 0,
		color: labelColor,
		hoverable: true
		}
		};
		chart.width('100%');

		// Create chart
		var plot = $.plot(chart, data, options);

		// Hover function
		var tip, previousPoint = null;
		chart.bind("plothover", function (event, pos, item) {
		if (item) {
		if (previousPoint !== item.dataIndex) {
		previousPoint = item.dataIndex;

		var x = item.datapoint[0];
		var y = item.datapoint[1];
		var tipLabel = '<strong>' + $(this).data('title') + '</strong>';
		var tipContent = y + " " + item.series.label.toLowerCase() + " on " + moment(x).format('MMMM YYYY');

		if (tip !== undefined) {
		$(tip).popover('destroy');
		}
		tip = $('<div></div>').appendTo('body').css({left: item.pageX, top: item.pageY - 5, position: 'absolute'});
		tip.popover({html: true, title: tipLabel, content: tipContent, placement: 'top'}).popover('show');
		}
		}
		else {
		if (tip !== undefined) {
		$(tip).popover('destroy');
		}
		previousPoint = null;
		}
		});
		};

		// =========================================================================
		namespace.DemoDashboard = new DemoDashboard;
		}(this.materialadmin, jQuery)); // pass in (namespace, jQuery):


			var map;
            var InforObj = [];
            var centerCords = {
                lat: 12.0194694,
                lng: 8.5190819
            };
            var propertyData = [
                @foreach ($properties as $property)
                    [ "{{ $property->id }}", "{{ $property->projectId }}", "{{ $property->projectType }}", 
                    "{{ $property->lat }}", "{{ $property->lang }}", "{{ $property->name }}", "{{ $property->photo }}", "{{ $property->address }}", "{{ $property->created_at }}"], 
                @endforeach
                ];
           
            window.onload = function () {
                initMap();
            };

            function addMarkerInfo() {
                for (var i = 0; i < propertyData.length; i++) {

                	var contentString = '<div class="map_info_wrapper"><a href="#"><div class="img_wrapper"><img src="/storage/'+propertyData[i][6]+'"></div></a><div class="property_content_wrap"><div class="property_title"><strong class="text-xl">'+propertyData[i][5]+'</strong></div><div class="property_price"><span>'+propertyData[i][2]+'</span></div><div class="property_bed_type"><span>'+propertyData[i][0]+'</span><ul><li>'+propertyData[i][7]+'</li></ul></div><div class="property_listed_date"><span>Listed on: '+propertyData[i][8]+'</span></div></div><a href="{{URL::route("project.show",'+ propertyData[i][0] +')}}" target="_blank" class="btn btn-primary card-button"> View Details</a></div>';

                    var position = new google.maps.LatLng(propertyData[i][3], propertyData[i][4]);    
                    const marker = new google.maps.Marker({
                        position: position,
                        map: map
                    });

                    const infowindow = new google.maps.InfoWindow({
                        content: contentString,
                        maxWidth: 200
                    });

                    marker.addListener('click', function () {
                        closeOtherInfo();
                        infowindow.open(marker.get('map'), marker);
                        InforObj[0] = infowindow;
                    });
                    // marker.addListener('mouseover', function () {
                    //     closeOtherInfo();
                    //     infowindow.open(marker.get('map'), marker);
                    //     InforObj[0] = infowindow;
                    // });
                    // marker.addListener('mouseout', function () {
                    //     closeOtherInfo();
                    //     infowindow.close();
                    //     InforObj[0] = infowindow;
                    // });
                }
            }

            function closeOtherInfo() {
                if (InforObj.length > 0) {
                    /* detach the info-window from the marker ... undocumented in the API docs */
                    InforObj[0].set("marker", null);
                    /* and close it */
                    InforObj[0].close();
                    /* blank the array */
                    InforObj.length = 0;
                }
            }

            function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 15,
                    center: centerCords
                });
                addMarkerInfo();
            }
	</script>
<style>
	#map {
        height: 500px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }

   #map .gm-style-iw{
    box-shadow:none;
    color:#515151;
    text-align: center;
    width: auto !important;
 	top: 0 !important;
 	left: 0 !important;
    border-radius: 0;
	}

	 #map .gm-style > div > div > div > div > div > div > div {
	    background: none!important;
	}

	.gm-style > div > div > div > div > div > div > div:nth-child(2) {
	     box-shadow: none!important;
	}
	 #map .gm-style-iw > div > div{
	    background: #FFF!important;
	}

	 #map .gm-style-iw a{
	    text-decoration: none;
	}

	 #map .gm-style-iw > div{
	    width: 100% !important
	}

	 #map .gm-style-iw .img_wrapper {
	    height: 150px;  
	    overflow: hidden;
	    width: 100%;
	    text-align: center;
	    margin: 0px auto;
	}

	 #map .gm-style-iw .img_wrapper > img {
	    width: 100%;
	    height:auto;
	}

	 #map .gm-style-iw .property_content_wrap {
	    padding: 0px 20px;
	}

	 #map .gm-style-iw .property_title{
	    min-height: auto;
	}    
</style>
@endsection
