@extends('layouts.master')

@section('title', 'Print Receipt')
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
      <li class="active">Print Receipt</li>
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

                    #t1_1{left:113.2px;bottom:643.1px;letter-spacing:0.22px;}
                    #t2_1{left:278px;bottom:1068px;letter-spacing:0.12px;word-spacing:-0.03px;}
                    #t3_1{left:310px;bottom:1100px;letter-spacing:-0.43px;word-spacing:0.19px;}
                    #t4_1{left:145px;bottom:1015px;letter-spacing:0.08px;word-spacing:-0.16px;}
                    #t5_1{left:528px;bottom:1018px;letter-spacing:0.06px;word-spacing:0.04px;}
                    #t6_1{left:527px;bottom:1006px;letter-spacing:0.09px;word-spacing:0.14px;}
                    #t7_1{left:527px;bottom:994px;letter-spacing:0.08px;}
                    #t8_1{left:591px;bottom:932px;letter-spacing:-0.04px;}
                    #t9_1{left:144px;bottom:884px;letter-spacing:-0.09px;word-spacing:0.08px;}
                    #ta_1{left:144px;bottom:845px;letter-spacing:-0.01px;}
                    #tb_1{left:144px;bottom:806px;letter-spacing:-0.07px;word-spacing:0.05px;}
                    #tc_1{left:146px;bottom:748px;letter-spacing:-0.04px;word-spacing:-0.13px;}
                    #td_1{left:566px;bottom:704px;}
                    #te_1{left:709px;bottom:705px;}
                    #tf_1{left:747px;bottom:705px;}
                    #tg_1{left:140px;bottom:627px;letter-spacing:-0.36px;word-spacing:0.19px;}
                    #th_1{left:603px;bottom:628px;letter-spacing:-0.05px;word-spacing:-0.05px;}

                    .s1{font-size:73px;font-family:LiberationSerif_k;color:#FFF;}
                    .s2{font-size:24px;font-family:DejaVuSans_p;color:#000;}
                    .s3{font-size:37px;font-family:LiberationSerif-Bold_a;color:#EC0588;}
                    .s4{font-size:9px;font-family:LiberationSerif_k;color:#000;}
                    .s5{font-size:17px;font-family:LiberationSerif_k;color:#000;}
                    .s6{font-size:17px;font-family:LiberationSerif-Italic_f;color:#000;}
                    .s7{font-size:24px;font-family:LiberationSerif-Bold_a;color:#000;}
                    .t.m0_1{transform:matrix(0,-1,1,0,0,0);}
                  </style>
                  <!-- End inline CSS -->

                  <!-- Begin embedded font definitions -->
                  <style id="fonts1" type="text/css" >

                    @font-face {
                      font-family: DejaVuSans_p;
                      src: url("fonts/DejaVuSans_p.woff") format("woff");
                    }

                    @font-face {
                      font-family: LiberationSerif-Bold_a;
                      src: url("fonts/LiberationSerif-Bold_a.woff") format("woff");
                    }

                    @font-face {
                      font-family: LiberationSerif-Italic_f;
                      src: url("fonts/LiberationSerif-Italic_f.woff") format("woff");
                    }

                    @font-face {
                      font-family: LiberationSerif_k;
                      src: url("fonts/LiberationSerif_k.woff") format("woff");
                    }

                  </style>
                  <!-- End embedded font definitions -->

                  <!-- Begin page background -->
                  <div id="pg1Overlay" style="width:100%; height:100%; position:absolute; z-index:1; background-color:rgba(0,0,0,0); -webkit-user-select: none;"></div>
                  <div id="pg1" style="-webkit-user-select: none;"><svg id="pdf1" width="825" height="1191" viewBox="0 0 825 1191" style="width:825px; height:1191px; -moz-transform:scale(1); z-index: 0; isolation: isolate;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <defs>
                      <clipPath id="c0"><path d="M0,1191.6V0H825V1191.6Z"/></clipPath>
                      <style type="text/css"><![CDATA[
                        .g0{
                          fill: #FFF;
                        }
                        .g1{
                          fill: #262626;
                        }
                        .g2{
                          fill: none;
                          stroke: #000;
                          stroke-width: 2.295;
                          stroke-miterlimit: 3;
                        }
                        .g3{
                          fill: none;
                          stroke: #EC0588;
                          stroke-width: 0.779;
                          stroke-miterlimit: 3;
                        }
                        .g4{
                          fill: none;
                          stroke: #262626;
                          stroke-width: 1.515;
                          stroke-miterlimit: 3;
                        }
                        .g5{
                          fill: none;
                          stroke: #000;
                          stroke-width: 0.779;
                          stroke-miterlimit: 3;
                        }
                        ]]></style>
                      </defs>
                      <g clip-path="url(#c0)">
                        <path fill-rule="evenodd" d="M0,0H825V1191.6H0V0Z" class="g0"/>
                        <path fill-rule="evenodd" d="M0,0H825V1191.7H0V0Z" class="g0"/>
                        <path fill-rule="evenodd" d="M50.8,584.3H0V0H101.5V584.3H50.8Z" class="g1"/>
                        <image preserveAspectRatio="none" x="140" y="26" width="133" height="92" xlink:href="data:image/jpg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAUDBAQEAwUEBAQFBQUGBwwIBwcHBw8LCwkMEQ8SEhEPERETFhwXExQaFRERGCEYGh0dHx8fExciJCIeJBweHx4BBQUFBwYHDggIDh4UERQeHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHv/AABEIAFwAhQMBEQACEQEDEQH/xAGiAAABBQEBAQEBAQAAAAAAAAAAAQIDBAUGBwgJCgsQAAIBAwMCBAMFBQQEAAABfQECAwAEEQUSITFBBhNRYQcicRQygZGhCCNCscEVUtHwJDNicoIJChYXGBkaJSYnKCkqNDU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6g4SFhoeIiYqSk5SVlpeYmZqio6Slpqeoqaqys7S1tre4ubrCw8TFxsfIycrS09TV1tfY2drh4uPk5ebn6Onq8fLz9PX29/j5+gEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoLEQACAQIEBAMEBwUEBAABAncAAQIDEQQFITEGEkFRB2FxEyIygQgUQpGhscEJIzNS8BVictEKFiQ04SXxFxgZGiYnKCkqNTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqCg4SFhoeIiYqSk5SVlpeYmZqio6Slpqeoqaqys7S1tre4ubrCw8TFxsfIycrS09TV1tfY2dri4+Tl5ufo6ery8/T19vf4+fr/2gAMAwEAAhEDEQA/APsqgAoAKACgAoAKAGu6oCzMFAGST0FAHzL4g+Mb+L/j14f8I+Grk/2DY3bm5mQ8Xkqo3p/AD09Tz6UAZ2mftGQ+GPg3ptu8ker+LP3sKxEnbCiuyo0pHU4A46nqcUAdd+xn4i1nxVofijWtev5b29n1QFpHPAHlrhQOgA7AUAe/0AFABQAUAFABQAUAFABQAUAFABQAUAcZ8bpJIvhJ4rlidkdNKmKsDgg7DQB8O/s0AH40aGScbTK35RNQN6HL+FfCuu+MvEx0Pw3YfbdQkMjiPzUj4U5Jy5A/WgLn15+xjoWo+GdH8WaFq8AgvrPVVjmjDh9reUp6jg8YoEfQNABQAUAFABQAUAFABQAUAFABQAUAFAHnfx+1XT7X4b69pNxdxx32o6VcrZwMfmnZUJZVHc4OcdevpQB8Yfs1hR8V7V2UHyrK8f6EQPzQNmZ8H2sE+IEb6l4zu/CFuI5i2pW0hWRT/dBXnnpQB9Sfs1a34f0hPFcjeK7jVrK68QRW1rql/IzSXMjQDbuY85O0jn2FAj6BBBHFAC0AFABQAUAFABQAUAFABQAUAFACE4GaAPmL9vS4ntdM8I3VrNJDNFeTMkiHDKwVcEEdCDQB5V8DbrSdb8dnVC0VhrR0+8Sa2HyrfO8DKrxgcLIScFO/UelBRwHw88SWPg7xl/a2reGbbXY4VkQ2N2wRQ54BOVbkH2/KgR6Fr3iBPEHwJ8Va5b6bBpQufFdtKltbfchxAeB09KBI+nf2WfEeq+J/g5pmoazcfabqN5LfzSPmdUbClvU470Aep0AFABQAUAFABQAUAFABQAUAFAFA6tpZ1T+yhqdl9vAybXz183GM52Zz056UAfGXxX8Sa34x8b+Kvh5qWiXHiN7PUrp9EmglEUti2/8AiY/K0IHBDYxgDIo1fQqMHK0Yq8n2PDJrLVNJ1w2U0E1hqNvKPkf5HicEEfTBxz+NU12G/d95of4gGsTa5M2tRTjUp5d0vmRlZJHbnOMck9ffNS9AVtz0JvDfjfT/AIM3Vg+m7tOvb5b0xmFxKjRowOCRtY46qCSMZ7MAEa3Ppn9ii7tpvgtDaxTI81veTCZAeULHIyO2RzQB7hQAUALQAUAFABQAUAITigVxNwoC6FyKdguhvmDJHPFFguj4s+ID63f/ALSviDxF4O1O2tYLFViuNXbDQWpaFY2wcENJ94BRk5HtxdKm6jtE7cFg6uLqqnSV2+h6B8LvhxLrtpI6/a7LQbpzLeX1w2L7WnJzmQ87Y+4UH05brXa+TDK28/yPqpzwvD0W4pVMR96h9+7+XQyPjd8J47S1A1FpbnSVwtnq6rvuNPHQRTD/AJaRdMHqvYjoZcI4paaTF7PDcQR/dJU6/bZT9Oz+SPBnuNZ8C65aW+vaXYa3ZxDfapd5eCaLPDRyKQdpOTgHGc5Gc1xunKOj3R8rXw1TDzdKas0e22X7R/hCXRnbV/DuqyTvbx266PDsFjEyYIdHzuQ8D+HIPfvRe6sE5p0VT5FdO9+r30MD4U+P9ftzr2peF7bTPB/h2eRZNQ1O+DTpC3O0RKAA8zZOVAIPXAHNTY5uXW1z2PSfjsmnroOka7povNR1O7it7e9sGxZ3cLnAuEJHGDgNGcFScUiT3NTmgB1ABQAUAFAGVcapdQnA0e/mXs0Yjx+RfNA0jHv/ABbd2r7X8IeIpT6xWyOP/HXNVGLfU1hQ5/tJfMp3Hjq/RT5XgbxLJ6f6LjNWqb/mR0xwDl/y8j95lXnxH8SRPtg+F/iOb3Klf5Kaao/3l95vHKHL/l/BeskcD8QvFnxM8XouhR+CfEPhzRpFb+0JrWF5rqdP+ecbbVEe7oW5PPtg6RwnM/emkvU7MPkClJKeJpW/xo2fhf8ACkvBZ3niWxistPtvnsdEXO1G/wCek5/jc989c8+g1qVoUY8lLXzO7GZrhcupPCZbFX+1UVrvulbp89bG3+0LB4jbw5pkfhi68SWk0d8gYaFbM7lNrDD7XXCe/IHHBrgv1Pj225825ofAqPWrr4U2dv4utdTN8Wnjni1dmknZfMbAcuAWG3GMjpimpcrVnqVzunJSpaW7dzz/AOKvwgaKCVdI0yTWdAnkDzaYpPn2rk8yW7Hofb06gjp3KpCvHlqaPufZUMywWdUfYY5qFVbT0t6S/wCHPIYv2ddesdclvNSt9QuvDsEYn2WkYe/nU8CHyskq/YsflHJyelcTThJp6o+Sr0fYycE07PdbHoPhz4Y+JNT0u08QeIvD9vZ2VjNHHonhTyHeGJS4Hm3KqcsxHJLZPGW4G2nBRk/e0NcHRp1qtqs7Kz1vb+n2RD4o+GGuaPoVtrmh+Hrm+0XUClzqPhyFWFzptwT/AK60J+ZGB/h/A5HQqJKTSJxtKFKvKFOXMls+503h/wCMPxD0i0Om6t8KfGWuyQHbFqEWlyQtPH2MiYID+uDioOU24/jh4gZfn+CXxEB/2dNJH64oAlj+NmuE/N8FPiOB2xpq/wDxVAEo+M+uHp8F/iMPrpy//FUAKPjNreMn4M/ETPp/Z4/+KoA9foAKACgAoAKACgBkm7BKgE9gTgUAeaaZ8VI7/wAeyeDF0GaHUo3dWZ7lfLyoyeQCeR7V2ywlqfPc+qxPC86OXLMPapwaXTv8zVs/iPoo8Xv4T1OO40vVVICLMA0cuRkbGXse24Co+qzcOdao4ZZBipYP67SXNT7rp01W50mibZWuL0YP2iUsuOhRflUj6gZ/GsJX2Z5eIlpGn/L+b1ZqAg9Kg5xaACgAoAKACgAoAKACgAoAKACgAoAKAPmjw3/ydZflSAfPmIPb/V17lZWwS+R+tY5X4SivKP5m74s0Bbb4yW2r+JftFxc3zBdK+yRgQKyLgeZk7lK53cZFY06t8Pyx6HkYLMVLIpYfDNJR1nfffpuuy6Hf6lbNr3g2S/8AAXiSWG6+zFbSe3lEsDsoxsKPlRkjBIAYevFeU223c/Ppzc5uT66na2e/7NF5v+s2Lv8ArjmkSTUAFABQAUAFABQAUAFABQAUAFABQAyViis2GIAzgDP8uaBpHgHhHw74hb9oafxJJoeoQaVLLKyXE0BQYKEAnPTNevWqQ+rKFz9MzHMsH/q6sHGpF1Eo6J36np3ifTofEWujT1ea3ns7KYpceXxG8ymNSueCRzXAny03Z7nwlGcsPgp6/G0vudz5Nsb34hfs2eOvsV3uvdAupNxXJ8i7QcFlJzskAx/XIrn6Hn6S1R9o+EtbsvEfhyw13T2LWt9As0e7qAR0Pv2oJNWgAoAKACgAoAKACgAoAKACgAoAKACgCnqV1BYafcX1yxWG3iaWRsZwqjJP5CqinJpGlGjKtUUIfFKyXzOb0G+utes08R6HJGlvdSMVjuoWTz4wNqEHqoOCwOD16VdROD5WdePw88JNYadrx3s7769Dj/jF8NNb+K8Wl6Xq9xpui6ZYzmaRraRrmaUkbdoyiBBj61kcJ6b4X0Sx8OeH7HQ9NQpaWUKwxAnJwoxk+/egRp0AFABQAUAFABQAUAFABQAUAFABQAUAYvjkD/hCtcPcadcf+i2rXD/xY+qPQyn/AH+j/jj+aMr4NgH4XeHSc5+xJ3rXG/xn8vyOjiDTMqvr+iOuwPTpXKeOLQAUAFABQAUAFABQAP/Z"/>
                      </g>
                      <path d="M272.9,79.5l413.9,.1" class="g2"/>
                      <image clip-path="url(#c0)" preserveAspectRatio="none" x="687" y="33" width="86" height="79" xlink:href="data:image/jpg;base64,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"/>
                      <path d="M139.8,148.9l178.3,.1m197.8,-.1l270.6,.1" class="g3"/>
                      <path d="M670.7,486.7H554.8v-42H786.5v42H670.7Z" class="g4"/>
                      <path d="M126.8,533.8H305.1m236.4,-.3l228.9,.1" class="g5"/>
                    </svg></div>
                    <!-- End page background -->


                    <!-- Begin text definitions (Positioned/styled in CSS) -->
                    <div class="text-container"><span id="t1_1" class="t m0_1 s1">CASH RECEIPT </span>
                      <span id="t2_1" class="t s2">Estate Surveyors &amp; Valuers </span>
                      <span id="t3_1" class="t s3">BALA SABO &amp; CO </span>
                      <span id="t4_1" class="t s4">Suite AB J.S Plaza, Dutsen-Alhaji, Abuja </span>
                      <span id="t5_1" class="t s4">No. 334 Aminu Kano Way Opp. Isyaka Rabiu Mosque, Kano </span>
                      <span id="t6_1" class="t s4">08039431584, 08023640357 </span>
                      <span id="t7_1" class="t s4">sabobala1@gmail.com </span>
                      <span id="t8_1" class="t s5">Date: {{ \Carbon\Carbon::parse($collection->created_at)->toFormattedDateString() }} </span>
                      <span id="t9_1" class="t s6">Received from: {{$collection->customer->name}}</span>
                      <span id="ta_1" class="t s6">Of: </span>
                      <span id="tb_1" class="t s6">The Sum of: {{$collection->amount}}</span>
                      <span id="tc_1" class="t s6">Being Payment for: Rent Collection</span>
                      <span id="td_1" class="t s7">₦ {{$collection->amount}}</span><span id="te_1" class="t s7">: 0 </span><span id="tf_1" class="t s7">K </span>
                      <span id="tg_1" class="t s6">Tenant’s Sign </span><span id="th_1" class="t s6">For Bala Sabo &amp; Co </span></div>
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
	var cname = {!! json_encode($collection->customer->name) !!};
	var cid = {!! json_encode($collection->collectionNo) !!};
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
	var cname = {!! json_encode($collection->customer->name) !!};
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
