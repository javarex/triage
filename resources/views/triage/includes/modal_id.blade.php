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
            <div class="row p-2">
                <div class="col-md-2 mr-1"></div>
                <div class="col-md-8 border border-1 border-dark mt-1">
                    <div class="row">
                        <div class="col-md-9 pt-2 pl-1 bg-light text-nowrap  ">
                           <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ asset('image/ddo.png') }}" width="75" height="75" alt="">
                                </div>
                                <div class="col-md-8 pl-0 pt-1">
                                    <div class="d-flex justify-content-start">
                                        <strong class="">Republic of the Philippines</strong>
                                    </div>
                                    <div class="text-nowrap d-flex justify-content-start font-weight-bolder">
                                        PROVINCE OF DAVAO DE ORO
                                    </div>
                                    <div class="text-nowrap d-flex justify-content-start">
                                        Municipality of Nabunturan
                                    </div>
                                </div>
                                <div class="col-md-12 py-2 " >
                                    <h6 class="mb-0 ">CCTS Card <i>(Covid-19 Contact Tracing System)</i></h6>
                                    
                                </div>
                                <div class="col-md-12 d-inline">
                                    <div class=""><b>CCTS Code:</b> </div><i>{{$user->qrcode}}</i>
                                </div>
                                <div class="col-md-12 d-inline">
                                    <div class=""><b>Fullname:</b> </div><i>{{$Users_name}}</i>
                                </div>
                                <div class="col-md-12 d-inline">
                                    <div class=""><b>Address:</b></div> <i>{{$address}}</i>
                                </div>
                           </div>
                        </div>
                        <div class="col-md-3" style="border-left:solid grey 1px;">
                            <div class="row">
                                <div class="col-md-12 py-1 d-flex justify-content-center" style="border-bottom: solid black 1px">
                                    {!! QrCode::size('130')->color(68, 41, 0)->margin(0)->generate($user->qrcode) !!}
                                </div>
                                <div class="col-md-12 d-flex justify-content-center pt-5" >
                                    <h3 class="text-secondary">1x1</h3>
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