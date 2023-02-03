<form method='POST' id='frm_submit' class="users">
    <div class="modal fade" id="modalEntry" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" style="margin-top: 50px;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel"><span class='fa fa-pen'></span> Add Entry</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="hidden_id" name="input[fare_matrix_id]">
                    <div class="form-group row">
                        <div class="col">
                            <label><strong>Start Distance</strong></label>
                            <div>
                            <input type="number" class="form-control input-item" name="input[start_distance]" id="start_distance" placeholder="start distance" maxlength="100" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label><strong>End Distance</strong></label>
                            <div>
                            <input type="number" class="form-control input-item" name="input[end_distance]" id="end_distance" placeholder="end distance" maxlength="100" autocomplete="off" required>
                        </div>
                    </div><div class="form-group row"></div>
                    
                    <div class="form-group row">
                        <div class="col">
                            <label><strong>Fare Amount</strong></label>
                            <div>
                            <input type="number" style="width:109%;" class="form-control input-item" name="input[fare_amount]" id="fare_amount" placeholder="fare amount" step="0.01" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Submit</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>