<!-- Modal -->
<div class="modal fade" id="idPrint" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
      <div class="modal-body ">

        <div id="printDiv" class="">
            <div class="row py-2 pl-3">
                <div class="col-md-6 border border-1 border-dark mt-1">
                    <div class="row">
                        <div class="col-md-8 pt-2 pl-1 bg-light text-nowrap  ">
                           <div class="row">
                                <div class="col-md-3">
                                    <img src="{{ asset('image/ddo.png') }}" width="75" height="75" alt="">
                                </div>
                                <div class="col-md-8 pt-3 pl-4" style="font-size:9pt">
                                    <div class="d-flex justify-content-start">
                                        <strong class="">Republic of the Philippines</strong>
                                    </div>
                                    <div class="text-nowrap d-flex justify-content-start font-weight-bolder">
                                        PROVINCE OF DAVAO DE ORO
                                    </div>
                                </div>
                                <div class="col-md-12 py-2 d-flex justify-content-center" >
                                    <div class="mb-0 " style="font-size:8pt; font-weight:bolder">Covid-19 Contact Tracing System<span class="font-weight-bolder">(CCTS Card)</span></div>
                                    
                                </div>
                                <div class="col-md-12 pt-3">
                                   <h3 class="font-weight-bolder text-center">{{$Users_name}}</h3>
                                </div>
                                <div class="col-md-12 d-inline">
                                     <div class="text-center">{{$address}}</div>
                                </div>
                           </div>
                        </div>
                        <div class="col-md-4" style="border-left:solid grey 1px;">
                            <div class="row">
                                <div class="col-md-12 p-0 d-flex justify-content-center" style="border-bottom: solid black 1px">
                                    <div class="row">
                                        <div class="col-md-12 pt-1 d-flex justify-content-center">{!! QrCode::size('90')->color(68, 41, 0)->margin(0)->generate($user->qrcode) !!}</div>
                                        <div class="col-md-12 text-center font-weight-bolder" style="font-size:8pt">{{ $user->qrcode}}</div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 d-flex justify-content-center pt-5" >
                                    <h3 class="text-secondary pb-4">1x1</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 ml-1"></div>
            </diav>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="printme" class="link" onClick=printForm()>Print</button>
      </div>
    </div>
  </div>
</div>