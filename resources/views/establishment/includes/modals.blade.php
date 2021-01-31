<div class="modal fade" id="add_establishmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="/addTerminal" method="post" autocomplete="off" id="form_addTerminal">
        @csrf
        <div class="modal-dialog modal-xs" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Terminal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="printProfile">
                    <div class="row container d-flex justify-content-center">
                        <!-- <div class="col-md-5">
                            <label for="" class="form-label">Terminal number</label>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <input type="number" class="form-control" name="number" required>
                            </div>
                        </div> -->
                        <div class="col-md-5">
                            <label for="" class="form-label">Terminal Description</label>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <input type="text" class="form-control" name="description" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label for="" class="form-label">Coordinate Longitude</label>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <input type="text" class="form-control" name="coordinate_long">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label for="" class="form-label">Coordinate Longitude</label>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <input type="text" class="form-control" name="coordinate_lat">
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

<div class="modal fade" id="editTerminalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="/editTerminal" method="post" autocomplete="off" id="form_editTerminal">
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
                    <div class="row container d-flex justify-content-center">
                    
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        Description
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control text-dark" name="description" id="terminal_Description" placeholder="Terminal Description" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        Coordinate Long
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" id="coordinate_long" name="coordinate_long" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        Coordinate Lat
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" id="coordinate_lat" name="coordinate_lat" >
                                    </div>
                                </div>
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

<!-- Modals View profile -->

<div class="modal fade" tab-index="1" id="estab_profile">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Establishment information</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                form here...
            </div>
        </div>
    </div>
</div>
