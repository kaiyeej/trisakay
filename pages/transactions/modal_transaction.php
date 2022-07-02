<form method='POST' id='frm_submit' class="users">
    <div class="modal fade" id="modalEntry" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" style="margin-top: 50px;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel"><span class='fa fa-pen'></span> Add Entry</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="hidden_id" name="input[transaction_id]">
                    <div class="form-group row">
                        <div class="col">
                            <label><strong>Reference #</strong></label>
                            <div>
                            <input type="text" class="form-control input-item" name="input[ref_number]" id="ref_number" maxlength="100" autocomplete="off" readonly required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label><strong>Driver</strong></label>
                            <div>
                            <select style="color:black" class="form-control input-item" name="input[driver_id]" id="driver_id" required>
                            </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label><strong>User</strong></label>
                            <div>
                            <select style="color:black" class="form-control input-item" name="input[user_id]" id="user_id" required>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label><strong>Remarks</strong></label>
                            <div>
                            <textarea class="form-control input-item" name="input[remarks]" id="remarks"></textarea>
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