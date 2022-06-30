<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title"> Users </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <div class="btn-group">
            <button class="btn btn-primary btn-sm" onclick="addUser()">
              <i style="font-size: 20px;" class="mdi mdi-plus"></i>
            </button>
            <button class="btn btn-warning btn-sm" onclick='blockEntry()' id='btn_delete'>
              <i style="font-size: 20px;" class="mdi mdi-account-off"></i>
            </button>
            <button class="btn btn-danger btn-sm" onclick='deleteEntry()' id='btn_delete'>
              <i style="font-size: 20px;" class="mdi mdi-delete"></i>
            </button>
          </div>
        </li>
      </ol>
    </nav>
  </div>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Manage users</h4>
          <div class="table-responsive">
            <table id="dt_entries" class="table table-bordered">
              <thead>
                <tr>
                    <th><input type='checkbox' onchange="checkAll(this, 'dt_id')"></th>
                    <th></th>
                    <th>Fullname</th>
                    <th>Category</th>
                    <th>Username</th>
                    <th>Status</th>
                    <th>Date Added</th>
                    <th>Date Modified</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require_once 'modal_users.php'; ?>
<script type="text/javascript">
    function addUser(){
        addModal();
        $("#div_password").show();
    }

    function getUserDetails(id){
        $("#div_password").hide();
        getEntryDetails(id);
    }

    function getEntries() {
        $("#dt_entries").DataTable().destroy();
        $("#dt_entries").DataTable({
            "processing": true,
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=show",
                "dataSrc": "data"
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return "<input type='checkbox' value=" + row.user_id + " class='dt_id' style='position: initial; opacity:1;'>";
                    }
                },
                {
                    "mRender": function(data, type, row) {
                      return "<center><button class='btn btn-primary mb-2 btn-sm' onclick='getUserDetails(" + row.user_id + ")'><span class='mdi mdi-file-document'></span></button></center>";
                    }
                },
                {
                    "data": "user_fullname"
                },
                {
                    "data": "category"
                },
                {
                    "data": "username"
                },
                {
                  "mRender": function(data, type, row) {

                    if(row.status == 1){
                      return "<strong style='color:red;'>BLOCKED</strong>";
                    }else{
                      return "<strong style='color:green;'>Active</strong>";
                    }
                      
                  }
                },
                {
                    "data": "date_added"
                },
                {
                    "data": "date_last_modified"
                }
            ]
        });
    }

    function blockEntry() {

        var count_checked = $("input[class='dt_id']:checked").length;

        if (count_checked > 0) {
          swal({
              title: "Are you sure?",
              text: "You will not be able to recover these entries!",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes, block user!",
              cancelButtonText: "No, cancel!",
              closeOnConfirm: false,
              closeOnCancel: false
            },
            function(isConfirm) {
              if (isConfirm) {
                var checkedValues = $("input[class='dt_id']:checked").map(function() {
                  return this.value;
                }).get();

                $.ajax({
                  type: "POST",
                  url: "controllers/sql.php?c=" + route_settings.class_name + "&q=block",
                  data: {
                    input: {
                      ids: checkedValues
                    }
                  },
                  success: function(data) {
                    getEntries();
                    var json = JSON.parse(data);
                    console.log(json);
                    if (json.data == 1) {
                      success_block();
                    } else {
                      failed_query(json);
                    }
                  }
                });

                $("#btn_delete").prop('disabled', true);

              } else {
                swal("Cancelled", "Entries are safe :)", "error");
              }
            });
        } else {
          swal("Cannot proceed!", "Please select entries to delete!", "warning");
        }
    }

    $(document).ready(function() {
        getEntries();
    });
</script>