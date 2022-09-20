
<?php
  $Profile = new Profile();
?>
<div class="content-wrapper">
  <div class="row">
  <div class="col-lg-8">
        <!--begin::Example-->
        <!--begin::Card-->
        <div class="card card-custom">
          <div class="card-body">
            <h4 class="card-title" style="color: #009688;">Profile information</h4>
              <form method='POST' id='frm_profile' class="profile">
                <div class="row">
                  <div class="form-group col-sm-4">
                    <label for="exampleInputUsername1">First name</label>
                    <input type="text" autocomplete="off" class="form-control input-item" id="user_fname" name="input[user_fname]" placeholder="First name">
                  </div>
                  
                  <div class="form-group col-sm-4">
                    <label for="exampleInputUsername1">Middle name</label>
                    <input type="text" autocomplete="off" class="form-control input-item" id="user_mname" name="input[user_mname]" placeholder="Middle name">
                  </div>
                  
                  <div class="form-group col-sm-4">
                    <label for="exampleInputUsername1">Last name</label>
                    <input type="text" autocomplete="off" class="form-control input-item" id="user_lname" name="input[user_lname]" placeholder="Last name">
                  </div>
                  
                  <div class="form-group col-sm-6">
                    <label for="exampleInputUsername1">Contact #</label>
                    <input type="text" autocomplete="off" class="form-control input-item" id="contact_number" name="input[contact_number]" placeholder="Contact number">
                  </div>

                  <div class="form-group col-sm-6">
                    <label for="exampleInputUsername1">Username</label>
                    <input type="text" autocomplete="off" class="form-control input-item" id="username" name="input[username]" placeholder="Username">
                  </div>
                  <input type="hidden" autocomplete="off" value="<?= $_SESSION['trisakay_user_id'] ?>" name="input[user_id]" class="form-control" id="hidden_id">
                  <div class="form-group col-sm-6">
                    <label for="exampleInputEmail1">Category</label>
                    <select class="form-control input-item" name="input[category]" id="category" required>
                        <option value="">&mdash; Please Select &mdash;</option>
                        <option value="A">Admin</option>
                        <option value="D">Driver</option>
                    </select>
                  </div>
                  <div class="form-group col-sm-12">
                    <button type="submit" style="float: right;" id="btn_submit" class="btn btn-primary me-2">Save</button>
                  </div>
                </div>
              </form>
          </div>
        </div>
        <!--end::Card-->
      </div>
      <div class="col-lg-4">
        <div class="card card-custom">
          <div class="card-body">
            <div class="d-flex flex-row justify-content-between">
              <h4 class="card-title mb-1" style="color: #ff9800;">Security</h4>
            </div>
            <form method='POST' id='frm_password' class="password">
              <div class="form-group">
                <label for="exampleInputUsername1">Old Password</label>
                <input type="password" autocomplete="off" class="form-control" required id="old_password" name="input[old_password]" placeholder="Old Password">
              </div>
              <input type="hidden" autocomplete="off" value="<?= $_SESSION['trisakay_user_id'] ?>" name="input[user_id]" class="form-control" >
              <div class="form-group">
                <label for="exampleInputPassword1">New Password</label>
                <input type="text" autocomplete="off" class="form-control" required name="input[new_password]" id="new_password" placeholder="New Password">
              </div>
              <div class="form-group">
                <label for="exampleInputConfirmPassword1">Confirm Password</label>
                <input type="password" autocomplete="off" class="form-control" required id="confirm_password" name="input[confirm_password]" placeholder="Confirm Password">
              </div>
              <button type="submit" style="float: right;" id="" class="btn btn-warning me-2">Update Password</button>
            </form>
          </div>
        </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  getProfile("<?= $_SESSION['trisakay_user_id'] ?>");
  function getProfile(id) {
      $.ajax({
        type: "POST",
        url: "controllers/sql.php?c=Profile&q=view",
        data: {
          input: {
            id: id
          }
        },
        success: function(data) {
          var jsonParse = JSON.parse(data);
          const json = jsonParse.data;

          $("#hidden_id").val(id);

          $('.input-item').map(function() {
            //console.log(this.id);
            const id_name = this.id;
            this.value = json[id_name];
          });

        }
      });
    }

    $("#frm_profile").submit(function(e) {
      e.preventDefault();

      $("#btn_submit").prop('disabled', true);
      $("#btn_submit").html("<span class='fa fa-spinner fa-spin'></span> Submitting ...");

      var hidden_id = $("#hidden_id").val();
      var q = hidden_id > 0 ? "edit" : "add";
      $.ajax({
        type: "POST",
        url: "controllers/sql.php?c=Profile&q=" + q,
        data: $("#frm_profile").serialize(),
        success: function(data) {
          var json = JSON.parse(data);
          if (json.data == 1) {
            success_update();
          } else if (json.data == 2) {
            entry_already_exists();
          } else {
            failed_query(json);
          }

          $("#btn_submit").prop('disabled', false);
          $("#btn_submit").html("<span class='fa fa-check-circle'></span> Submit");
        }
      });
    });

    $("#frm_password").submit(function(e) {
      e.preventDefault();

      $("#btn_password").prop('disabled', true);
      $("#btn_password").html("<span class='fa fa-spinner fa-spin'></span> Submitting ...");

      var new_password = $("#new_password").val();
      var confirm_password = $("#confirm_password").val();
      
      if(new_password != confirm_password){
        swal("Can't change password!", "Confirm password doesn't match New password", "warning");
      }else{
        $.ajax({
          type: "POST",
          url: "controllers/sql.php?c=Profile&q=update_password",
          data: $("#frm_password").serialize(),
          success: function(data) {
            var json = JSON.parse(data);
            if (json.data == 1) {
              success_update();
            } else if (json.data == 2) {
              swal("Can't change password!", "Incorrect Password", "warning");
            } else {
              failed_query(json);
            }

            $("#btn_password").prop('disabled', false);
            $("#btn_password").html("<span class='fa fa-check-circle'></span> Submit");
          }
        });
      }
    });
</script>