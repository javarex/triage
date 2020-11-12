<div class="modal fade" id="editQr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form action="/qrEdit" method="post">
  @csrf
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
                <div class="col-md-12">
                    <div class="alert bg-warning font-weight-bold" role="alert"> <i class="fa fa-exclamation-circle" aria-hidden="true"></i> Note: You can change qr code once!</div>
                </div>
                <div class="col-md-12">
                    <span class="font-weight-normal">Here are the steps to get the value of your existing QR code:</span>
                    <br>
                    <b>1.) Download and install a <a href="https://m.apkpure.com/qr-code-reader-qr-code-scanner/tw.mobileapp.qrcode.banner">QR Code scanner</a> on your device.</b>
                    <br>
                    <b>2.) Scan your existing QR code.</b>
                    <br>
                    <b>3.) When you get the value of the existing QR code, copy and paste it below <i class="fas fa-hand-point-down    "></i></b>
                </div>
                <div class="col-md-12 pt-2">
                    <input type="text" name="qredit" class="form-control" placeholder="Enter your new qr code" required autocomplete="off">
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button class="btn btn-primary">Save</button>
            <!-- <a href="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->color(68, 41, 0)->generate( Auth::user()->qrcode )) !!}" class="btn btn-primary" id="print_qr" download="triage_QRCode"><i class="fa fa-fw fa-save" aria-hidden="true"></i>Save</a> -->
           
          </div>
        </div>
      </div>
  </form>
</div>