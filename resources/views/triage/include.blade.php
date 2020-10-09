<div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="printProfile">
        <div class="row container">
            <div class="col-md-12 px-0 d-flex justify-content-center">
                <span style="cursor:pointer" title="Scan me!">{!! QrCode::size('200')->color(68, 41, 0)->generate('mis3ddo.dvodeoro.ph:8086/client/create') !!}</span>
               
            </div>
            <div class="col-md-12 px-0 d-flex justify-content-center">
                <h1>{{ Auth::user()->first_name.' '.Auth::user()->last_name}}</h1>
            </div>
            <div class="col-md-12 px-0 d-flex justify-content-center">
                <label for=""><i class="fas fa-mobile-alt    "></i> Triage Code: <strong>{{ Auth::user()->username }}</strong></label>
            </div>
            <div class="col-md-12 px-0 d-flex justify-content-center">
                <label for=""><i class="fas fa-map-marker-alt    "></i> Address: {{ $client_id->address }}</label>
            </div>
           
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="data:image/png;base64, {!! base64_encode(QrCode::format('png')->merge()->size(300)->color(68, 41, 0)->generate( Auth::user()->username )) !!}" class="btn btn-primary" id="print_qr" download="triage_QRCode"><i class="fa fa-fw fa-save" aria-hidden="true"></i>Save</a>
       
      </div>
    </div>
  </div>
</div>