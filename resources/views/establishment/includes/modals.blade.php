<div class="modal fade" id="add_establishmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="/addTerminal" method="post" autocomplete="off" id="form_addTerminal">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Terminal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="printProfile">
                    <div class="row container">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="number" class="form-control-mod" name="number" placeholder="Terminal Number" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control-mod" name="description" placeholder="Terminal Description" required>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button  class="btn btn-choco" id="submit_addTerminal">Save</button>                
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="editTerminal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="/addTerminal" method="post" autocomplete="off" id="form_editTerminal">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-edit    "></i> Edit Terminal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="printProfile">
                    <div class="row container">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="number" class="form-control-mod" id="terminalNumber" name="number" placeholder="Terminal Number" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control-mod" name="description" id="terminal_Description" placeholder="Terminal Description" required>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-choco" id="submit_editTerminal">Save</button>                
                </div>
            </div>
        </div>
    </form>
</div>

