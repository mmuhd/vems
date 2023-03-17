@extends('layouts.master')

@section('title', 'Repair Notice')
@section('extraStyle')
<style>
  .white{
    color: #fff;
  }
</style>
@endsection
@section('content')
<section>
  <div class="section-header no-print">
    <ol class="breadcrumb">
      <li class="active">Repair Notice</li>
    </ol>
  </div><!--end .section-header -->
  <div class="section-body">
    <section>
      <div class="section-body">
        <div class="row no-print">

        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-printable style-default-light">
              <div class="card-head no-print">
                <div class="tools">
                  <div class="btn-group">
                    <a class="btn btn-floating-action btn-primary" href="javascript:void(0);" onclick="javascript:window.print();"><i class="md md-print"></i></a>
                    <a class="btn btn-floating-action btn-success" target="javascript" onclick="sendReceipt()"><i class="md md-mail"></i></a>
                  </div>
                </div>
              </div><!--end .card-head -->
              <div id="send_div" class="card-body style-default-bright top-zero">
                <div id="p1" style="overflow: hidden; position: relative; background-color: white; width: 825px; height: 1191px;">

                  <!-- Begin shared CSS values -->
                  <style class="shared-css" type="text/css" >
                    .t {
                      transform-origin: bottom left;
                      z-index: 2;
                      position: absolute;
                      white-space: pre;
                      overflow: visible;
                      line-height: 1.5;
                    }
                    .text-container {
                      white-space: pre;
                    }
                    @supports (-webkit-touch-callout: none) {
                      .text-container {
                        white-space: normal;
                      }
                    }
                  </style>
                  <!-- End shared CSS values -->


                  <!-- Begin inline CSS -->
                  <style type="text/css" >

                    #t1_1{left:252px;bottom:1050px;letter-spacing:-0.35px;word-spacing:0.16px;}
                    #t2_1{left:221px;bottom:1080px;letter-spacing:-0.28px;word-spacing:0.22px;}
                    #t3_1{left:34px;bottom:81px;letter-spacing:-0.14px;word-spacing:-0.22px;}
                    #t4_1{left:35px;bottom:53px;letter-spacing:-0.17px;}
                    #t5_1{left:31px;bottom:37px;letter-spacing:-0.18px;word-spacing:0.1px;}
                    #t6_1{left:33px;bottom:23px;letter-spacing:-0.15px;}
                    #t7_1{left:165px;bottom:951px;letter-spacing:0.08px;word-spacing:0.02px;}
                    #t8_1{left:75px;bottom:894px;letter-spacing:0.14px;word-spacing:-0.01px;}
                    #t9_1{left:75px;bottom:876px;letter-spacing:0.16px;word-spacing:-0.04px;}
                    #ta_1{left:75px;bottom:839px;letter-spacing:0.11px;word-spacing:0.05px;}
                    #tb_1{left:75px;bottom:821px;letter-spacing:0.11px;}
                    #tc_1{left:103px;bottom:821px;letter-spacing:0.09px;}
                    #td_1{left:75px;bottom:802px;letter-spacing:0.11px;}
                    #te_1{left:103px;bottom:802px;letter-spacing:0.13px;}
                    #tf_1{left:75px;bottom:784px;letter-spacing:0.11px;}
                    #tg_1{left:103px;bottom:784px;letter-spacing:0.09px;}

                    .s1{font-size:28px;font-family:DejaVuSans_t;color:#000;}
                    .s2{font-size:49px;font-family:LiberationSerif-Bold_j;color:#EC0588;}
                    .s3{font-size:11px;font-family:LiberationSerif_o;color:#000;}
                    .s4{font-size:12px;font-family:LiberationSerif-Bold_j;color:#000;}
                    .s5{font-size:15px;font-family:LiberationSerif_o;color:#000;}
                  </style>
                  <!-- End inline CSS -->

                  <!-- Begin embedded font definitions -->

                  <!-- End embedded font definitions -->

                  <!-- Begin page background -->
                  <div id="pg1Overlay" style="width:100%; height:100%; position:absolute; z-index:1; background-color:rgba(0,0,0,0); -webkit-user-select: none;"></div>
                  <div id="pg1" style="-webkit-user-select: none;"><svg id="pdf1" width="825" height="1191" viewBox="0 0 825 1191" style="width:825px; height:1191px; -moz-transform:scale(1); z-index: 0; isolation: isolate;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <defs>
                      <clipPath id="c0"><path d="M0,1191.6V0H825V1191.6Z"/></clipPath>
                      <clipPath id="c1"><path d="M0,938.1V146.7H825V938.1Z"/></clipPath>
                      <style type="text/css"><![CDATA[
                        .g0{
                          fill: #FFF;
                        }
                        .g1{
                          fill: none;
                          stroke: #000;
                          stroke-width: 3.074;
                          stroke-miterlimit: 3;
                        }
                        .g2{
                          fill: none;
                          stroke: #EC0588;
                          stroke-width: 0.779;
                          stroke-miterlimit: 3;
                        }
                        .g3{
                          fill: none;
                          stroke: #000;
                          stroke-width: 0.606;
                          stroke-miterlimit: 10;
                        }
                        ]]></style>
                      </defs>
                      <g clip-path="url(#c0)">
                        <path fill-rule="evenodd" d="M0,0H825V1191.6H0V0Z" class="g0"/>
                        <path fill-rule="evenodd" d="M0,0H825V1191.7H0V0Z" class="g0"/>
                        <image preserveAspectRatio="none" x="25" y="27" width="175" height="121" xlink:href="url('../../assets/1/img/1.jpg')"/>
                      </g>
                      <path d="M197.4,97.7l482.7,.1" class="g1"/>
                      <image clip-path="url(#c0)" preserveAspectRatio="none" x="682" y="27" width="119" height="109" xlink:href="url('../../assets/1/img/2.jpg')"/>
                      <path d="M28.5,1085.5l268.8,.1M26.7,1112.8H297.3" class="g2"/>
                      <image clip-path="url(#c0)" preserveAspectRatio="none" x="140" y="387" width="579" height="400" xlink:href="url('../../assets/1/img/3.jpg')"/>
                      <g clip-path="url(#c1)" opacity="0.91">
                        <path fill-rule="evenodd" d="M412.5,937.6H0V148.1H824.9V937.6H412.5Z" class="g0"/>
                      </g>
                      <path d="M164.8,235.6h495" class="g3"/>
                      <g clip-path="url(#c0)">
                        <image preserveAspectRatio="none" x="73" y="532" width="254" height="255" xlink:href="url('../../assets/1/img/4.jpg')"/>
                        <image preserveAspectRatio="none" x="456" y="532" width="240" height="252" xlink:href="url('../../assets/1/img/5.jpg')"/>
                      </g>
                    </svg></div>
                    <!-- End page background -->


                    <!-- Begin text definitions (Positioned/styled in CSS) -->
                    <div class="text-container"><span id="t1_1" class="t s1">Estate Surveyors &amp; Valuers </span>
                      <span id="t2_1" class="t s2">BALA SABO &amp; CO </span>
                      <span id="t3_1" class="t s3">Suite AB J.S Plaza, Dutsen-Alhaji, Abuja </span>
                      <span id="t4_1" class="t s3">No. 334 Aminu Kano Way Opp. Isyaka Rabiu Mosque, Kano </span>
                      <span id="t5_1" class="t s3">08039431584, 08023640357 </span>
                      <span id="t6_1" class="t s3">sabobala1@gmail.com </span>
                      <span id="t7_1" class="t s4">REPAIRS NOTICE IN RESPECT OF PROPERTY AT HJSDHJBF NDJJDJDJJD NDJJDJDJ </span>
                      <span id="t8_1" class="t s5">I would like to inform you that there is need to repair so so amd so in property: xxxxxxxxxxxxxxxxxxxxx, </span>
                      <span id="t9_1" class="t s5">flat: xxxxxxxxxxxxxx. </span>
                      <span id="ta_1" class="t s5">List of Items in need of repairs: </span>
                      <span id="tb_1" class="t s5">1. </span><span id="tc_1" class="t s5">Ceiling </span>
                      <span id="td_1" class="t s5">2. </span><span id="te_1" class="t s5">Borehole </span>
                      <span id="tf_1" class="t s5">3. </span><span id="tg_1" class="t s5">Sos </span></div>
                      <!-- End text definitions -->


                    </div>

                  </div><!--end .card-body -->
                </div><!--end .card -->
              </div><!--end .col -->
            </div><!--end .row -->
          </div>
        </section>
      </div>

    </section>
    @endsection

    @section('extraScript')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script type="text/javascript">


      function sendReceipt() {
  // body...
  var data ='';
  var cname = {!! json_encode($repairs->customer->name) !!};
  var cid = {!! json_encode($repairs->repairsNo) !!};
  html2canvas(document.querySelector("#send_div")).then(canvas => {
    saveAs(canvas.toDataURL(), cname+' '+cid+'.png');
  });
}
function saveAs(uri, filename) {
  var link = document.createElement('a');
  if (typeof link.download === 'string') {
    link.href = uri;
    link.download = filename;

          //Firefox requires the link to be in the body
          document.body.appendChild(link);

          //simulate click
          link.click();

          //remove the link when done
          document.body.removeChild(link);
        } else {
          window.open(uri);
        }
      }
      function sendReceiptr() {
  // body...
  var data ='';
  var cname = {!! json_encode($repairs->customer->name) !!};
  html2canvas(document.querySelector("#send_div")).then(canvas => {
    canvas.toBlob(function(blob) {
      window.saveAs(blob, cname+' '+cid+'.png');
    });
    document.body.appendChild(canvas)
    data = canvas.toDataURL('image/png');
    var whatsapp_url = 'https://api.whatsapp.com/send?text='+encodeURIComponent(data); 
    window.location.href = whatsapp_url;
  });
}

</script>
@endsection
