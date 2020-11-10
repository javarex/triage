<div class="modal fade" id="editQr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            
           
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->color(68, 41, 0)->generate( Auth::user()->qrcode )) !!}" class="btn btn-primary" id="print_qr" download="triage_QRCode"><i class="fa fa-fw fa-save" aria-hidden="true"></i>Save</a>
       
      </div>
    </div>
  </div>
</div>