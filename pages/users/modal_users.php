<form method='POST' id='frm_submit' class="users">
    <div class="modal fade" id="modalEntry" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" style="margin-top: 50px;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel"><span class='fa fa-pen'></span> Add Entry</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="hidden_id" name="input[user_id]">
                    <div class="form-group row">
                        <div class="col">
                            <label><strong>First name</strong></label>
                            <div>
                            <input type="text" class="form-control input-item" name="input[user_fname]" id="user_fname" placeholder="First name" maxlength="100" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label><strong>Middle name</strong></label>
                            <div>
                            <input type="text" class="form-control input-item" name="input[user_mname]" id="user_mname" placeholder="Middle name" maxlength="100" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label><strong>Last name</strong></label>
                            <div>
                            <input type="text" class="form-control input-item" name="input[user_lname]" id="user_lname" placeholder="Last name" maxlength="100" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label><strong>Category</strong></label>
                            <div>
                            <select class="form-control input-item" name="input[category]" id="category" required>
                                <option value="">&mdash; Please Select &mdash;</option>
                                <option value="A">Admin</option>
                                <option value="D">Driver</option>
                                <option value="U">User</option>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label><strong>Username</strong></label>
                            <div>
                            <input type="text" class="form-control input-item" name="input[username]" autocomplete="off" id="username" placeholder="Username" maxlength=15 required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div id="div_password" class="col">
                            <label><strong>Password</strong></label>
                            <div>
                            <input type="text" class="form-control input-item" name="input[password]" autocomplete="off" id="password" placeholder="Password" required>
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