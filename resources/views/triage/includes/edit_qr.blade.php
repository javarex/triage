<!-- Modal -->
<div class="modal fade" id="qr_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <form action="qredit" method="post">
    @csrf
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change QRCode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">

        <div id="" class="">
            
                <div class="form-group row">
                    <div class="form-label col-md-10">
                        <label for="">Current qrcode: <strong>{{$user->qrcode}}</strong></label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="form-label col-md-10">
                        <label for=""><strong>New QRCode</strong></label>
                    </div>
                    <div class="col-12 col-md-10">
                        <input type="text" name="new_qrcode" id="new_qrcode" class="form-control" placeholder="(e.g) DDO1234">
                        <input type="hidden" name="qredit" value="{{$user->qrcode }}">
                    </div>
                </div>
            
        </div>
        <div class="col-12 col-md-12">
            <div class="alert alert-danger" role="alert">
              <p>NOTE: If you have an existing  QRCode  from other provinces, you may use the same.  Just edit   your assigned QRCode.  This is just a one time edit.  For  concerns with your QRCode just email
                <br>
                <strong>ddoqr@davaodeoro.gov.ph </strong>
              </p>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" id="saveEdit" >Save</button>
      </div>
    </div>
    </form>
  </div>
</div>