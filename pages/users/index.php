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
            <button class="btn btn-info btn-sm" onclick='verifyEntry()' id='btn_delete'>
              <i style="font-size: 20px;" class="mdi mdi-check-circle"></i>
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
<?php require_once 'modal_images.php'; ?>
<script type="text/javascript">
  function addUser() {
    addModal();
    $("#div_password").show();
    checkCategory();
  }

  function viewIDs(id) {
    $("#modalImages").modal("show");

    $.ajax({
      type: "POST",
      url: "controllers/sql.php?c=" + route_settings.class_name + "&q=view",
      data: {
        input: {
          id: id
        }
      },
      success: function(data) {
        var jsonParse = JSON.parse(data);
        const json = jsonParse.data;

        // upload_documents == upload_documents
        // uploads == user_img

        if (json['user_category'] == "D") {


          $("#div_user_canvas").hide();
          $("#div_driver_canvas").show();

          if (json['user_img'] == "" || json['user_img'] == null) {
            $("#div_user_img").html("<i>No Image found.</>");
          } else {
            $("#div_user_img").html("<img class='img-thumbnail' src='assets/uploads/" + json['user_img'] + "'>");
          }

          if (json['toda_id'] == "" || json['toda_id'] == null) {
            $("#div_toda_id").html("<i>No Image found.</>");
          } else {
            $("#div_toda_id").html("<img class='img-thumbnail' src='assets/upload_documents/" + json['toda_id'] + "'>");
          }

          if (json['franchise_permit'] == "" || json['franchise_permit'] == null) {
            $("#div_franchise_permit").html("<i>No Image found.</>");
          } else {
            $("#div_franchise_permit").html("<img class='img-thumbnail' src='assets/upload_documents/" + json['franchise_permit'] + "'>");
          }


          if (json['or_img'] == "" || json['or_img'] == null) {
            $("#div_or_img").html("<i>No Image found.</>");
          } else {
            $("#div_or_img").html("<img class='img-thumbnail' src='assets/upload_documents/" + json['or_img'] + "'>");
          }

          if (json['cr_img'] == "" || json['cr_img'] == null) {
            $("#div_cr_img").html("<i>No Image found.</>");
          } else {
            $("#div_cr_img").html("<img class='img-thumbnail' src='assets/upload_documents/" + json['cr_img'] + "'>");
          }

          if (json['vehicle_img'] == "" || json['vehicle_img'] == null) {
            $("#div_vehicle_img").html("<i>No Image found.</>");
          } else {
            $("#div_vehicle_img").html("<img class='img-thumbnail' src='assets/upload_documents/" + json['vehicle_img'] + "'>");
          }

          $("#span_license_number").html(json['license_number']);

        } else {
          $("#div_user_canvas").show();
          $("#div_driver_canvas").hide();

          if (json['user_img'] == "" || json['user_img'] == null) {
            $("#div_user_img2").html("<i>No Image found.</>");
          } else {
            $("#div_user_img2").html("<img class='img-thumbnail' src='assets/uploads/" + json['user_img'] + "'>");
          }
        }

        if (json['valid_id_img'] == "" || json['valid_id_img'] == null) {
            $(".div_valid_id_img").html("<i>No Image found.</>");
          } else {
            $(".div_valid_id_img").html("<img class='img-thumbnail' src='assets/uploads/" + json['valid_id_img'] + "'>");
          }
      }
    });
  }

  function getUserDetails(id) {
    getEntryDetails(id);
    $("#div_password").hide();
    checkCategory();
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
            return "<center class='btn-group'><button class='btn btn-primary mb-2 btn-sm' onclick='getUserDetails(" + row.user_id + ")'><span class='mdi mdi-pencil'></span></button><button class='btn btn-danger mb-2 btn-sm' onclick='viewIDs(" + row.user_id + " )'><span class='mdi mdi-account-card-details'></span></button></center>";
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

            if (row.status == 1) {
              return '<span>Verified </span><i style="font-size: 20px; color:#8bc34a;" class="mdi mdi-check-circle">';
            } else {
              return '<i style="font-size: 35px; color: #ffc107;" class="mdi mdi-exclamation">';
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

  function verifyEntry() {

    var count_checked = $("input[class='dt_id']:checked").length;

    if (count_checked > 0) {
      swal({
          title: "Are you sure?",
          text: "The user will be marked as verified.",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, verify the user!",
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
                  success_update();
                } else {
                  failed_query(json);
                }
              }
            });

            $("#btn_delete").prop('disabled', false);

          } else {
            swal("Cancelled", "Entries are safe :)", "error");
          }
        });
    } else {
      swal("Cannot proceed!", "Please select entries to delete!", "warning");
    }
  }

  function checkCategory(){
    var category = $("#category").val();
    if(category == "D"){
      $(".canvas_driver").show();
    }else{
      $(".canvas_driver").hide();
    }
  }

  $(document).ready(function() {
    getEntries();
  });
</script>