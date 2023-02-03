<?php
include 'core/config.php';

if (!isset($_SESSION["trisakay_user_id"])) {
  header("location:./login/index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Trisakay</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    
    <link rel="stylesheet" href="assets/css/pages/datatables.css">
    <link rel="stylesheet" href="assets/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="assets/sweetalert/sweetalert.css">

    <script src="assets/js/jquery.min.js"></script>
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/logo.png" />
  </head>
  
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="./"><img  style="height: 95px;padding: 10px;" src="assets/images/logo.png" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="./"><img src="assets/images/logo-pin.png" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <!--<div class="search-field d-none d-md-block">-->
          <!--  <form class="d-flex align-items-center h-100" action="#">-->
          <!--    <div class="input-group">-->
          <!--      <div class="input-group-prepend bg-transparent">-->
          <!--        <i class="input-group-text border-0 mdi mdi-magnify"></i>-->
          <!--      </div>-->
          <!--      <input type="text" class="form-control bg-transparent border-0" placeholder="Search Transaction">-->
          <!--    </div>-->
          <!--  </form>-->
          <!--</div>-->
          <ul class="navbar-nav navbar-nav-right">
            
            <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
               
              </a>
            </li>
            <li class="nav-item nav-logout d-none d-lg-block">
              <a class="nav-link" href="#" onclick="logout()">
                <i class="mdi mdi-power"></i>
              </a>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php require 'components/sidebar.php'; ?>
        <!-- partial -->
        <!-- routes -->
        <?php require 'routes/routes.php'; ?>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    
    <script src="assets/js/datatables.js"></script>
    <script src="assets/datatables.net/jquery.dataTables.js"></script>
    <script src="assets/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="assets/sweetalert/sweetalert.js"></script>

    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- End custom js for this page -->
  </body>
  <script type='text/javascript'>
    <?php
    echo "var route_settings = " . $route_settings . ";\n";
    ?>
  </script>
  <script type="text/javascript">
    var modal_detail_status = 0;
    $(document).ready(function() {
    });

    function logout() {
      var confirm_export = confirm("You are about to logout.");
      if (confirm_export == true) {
        var url = "controllers/sql.php?c=LoginUser&q=logout";
        $.ajax({
          url: url,
          success: function(data) {

            location.reload();

          }
        });
      }
      
    }

    function schema() {
      $.ajax({
        type: "POST",
        url: "controllers/sql.php?c=" + route_settings.class_name + "&q=schema",
        data: [],
        success: function(data) {
          var json = JSON.parse(data);
          console.log(json.data);
        }
      });
    }

    function success_add() {
      swal("Success!", "Successfully added entry!", "success");
    }

    function success_update() {
      swal("Success!", "Successfully updated entry!", "success");
    }

    function success_delete() {
      swal("Success!", "Successfully deleted entry!", "success");
    }

    function success_block() {
      swal("Success!", "Successfully blocked user!", "success");
    }

    function success_cancel() {
      swal("Success!", "Successfully canceled entry!", "success");
    }

    function entry_already_exists() {
      swal("Cannot proceed!", "Entry already exists!", "warning");
    }

    function amount_is_greater() {
      swal("Cannot proceed!", "Amount is greater than balance!", "warning");
    }

    function failed_query(data) {
      swal("Failed to execute query!", data, "warning");
      //alert('Something is wrong. Failed to execute query. Please try again.');
    }

    function checkAll(ele, ref) {
      var checkboxes = document.getElementsByClassName(ref);
      if (ele.checked) {
        for (var i = 0; i < checkboxes.length; i++) {
          if (checkboxes[i].type == 'checkbox') {
            checkboxes[i].checked = true;
          }
        }
      } else {
        for (var i = 0; i < checkboxes.length; i++) {
          //console.log(i)
          if (checkboxes[i].type == 'checkbox') {
            checkboxes[i].checked = false;
          }
        }
      }
    }


    function addModal() {
      modal_detail_status = 0;
      $("#hidden_id").val(0);
      document.getElementById("frm_submit").reset();

      var element = document.getElementById('reference_code');
      if (typeof(element) != 'undefined' && element != null) {
        generateReference(route_settings.class_name);
      }

      $("#modalLabel").html("<span class='fa fa-pen'></span> Add Entry");
      $("#modalEntry").modal('show');
    }

    $("#frm_submit").submit(function(e) {
      e.preventDefault();

      $("#btn_submit").prop('disabled', true);
      $("#btn_submit").html("<span class='fa fa-spinner fa-spin'></span> Submitting ...");

      var hidden_id = $("#hidden_id").val();
      var q = hidden_id > 0 ? "edit" : "add";
      $.ajax({
        type: "POST",
        url: "controllers/sql.php?c=" + route_settings.class_name + "&q=" + q,
        data: $("#frm_submit").serialize(),
        success: function(data) {
          getEntries();
          var json = JSON.parse(data);
          if (route_settings.has_detail == 1) {
            if (json.data > 0) {
              $("#modalEntry").modal('hide')
              hidden_id > 0 ? success_update() : success_add();
              hidden_id > 0 ? $("#modalEntry2").modal('hide') : '';
              hidden_id > 0 ? getEntryDetails2(hidden_id) : getEntryDetails2(json.data);
            } else if (json.data == -2) {
              entry_already_exists();
            } else {
              failed_query(json);
            }
          } else {
            if (json.data == 1) {
              hidden_id > 0 ? success_update() : success_add();
              $("#modalEntry").modal('hide');
            } else if (json.data == 2) {
              entry_already_exists();
            } else {
              failed_query(json);
            }
          }

          $(".select2").select2().trigger('change');

          $("#btn_submit").prop('disabled', false);
          $("#btn_submit").html("<span class='fa fa-check-circle'></span> Submit");
        }
      });
    });

    function getEntryDetails(id, is_det = 0) {
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

          $("#hidden_id").val(id);

          $('.input-item').map(function() {
            //console.log(this.id);
            const id_name = this.id;
            this.value = json[id_name];
          });

          //$(".select2").select2().trigger('change');

          $("#modalLabel").html("<span class='fa fa-pen'></span> Update Entry");
          $("#modalEntry").modal('show');
        }
      });

      if (is_det == 1) {
        modal_detail_status == 1 ? setTimeout(() => {
          $("#modalEntry2").modal('hide')
        }, 500) : '';
      } else {
        modal_detail_status = 0;
      }
    }

  

    function deleteEntry() {

      var count_checked = $("input[class='dt_id']:checked").length;

      if (count_checked > 0) {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover these entries!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
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
                url: "controllers/sql.php?c=" + route_settings.class_name + "&q=remove",
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
                    success_delete();
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

    // MODULE WITH DETAILS LIKE SALES

    function getEntryDetails2(id) {
      $("#hidden_id_2").val(id);
      modal_detail_status = 1;
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

          $('.label-item').map(function() {
            const id_name = this.id;
            const new_id = id_name.replace('_label', '');
            this.innerHTML = json[new_id];
          });

          var transaction_edit = document.getElementById("menu-edit-transaction");
          var transaction_delete_items = document.getElementById("menu-delete-selected-items");
          var transaction_finish = document.getElementById("menu-finish-transaction");
          var col_list = document.getElementById("col-list");
          var col_item = document.getElementById("col-item");

          if (json.status == 'F') {
            transaction_edit.classList.add('disabled');
            (typeof(transaction_delete_items) != 'undefined' && transaction_delete_items != null) ? transaction_delete_items.classList.add('disabled'): '';
            transaction_finish.classList.add('disabled');

            transaction_edit.setAttribute("onclick", "");
            (typeof(transaction_delete_items) != 'undefined' && transaction_delete_items != null) ? transaction_delete_items.setAttribute("onclick", ""): '';
            transaction_finish.setAttribute("onclick", "");

            (typeof(col_item) != 'undefined' && col_item != null) ? col_item.style.display = "none": '';
            (typeof(col_list) != 'undefined' && col_list != null) ? col_list.classList.remove('col-8'): '';
            (typeof(col_list) != 'undefined' && col_list != null) ? col_list.classList.add('col-12'): '';
          } else {
            transaction_edit.classList.remove('disabled');
            (typeof(transaction_delete_items) != 'undefined' && transaction_delete_items != null) ? transaction_delete_items.classList.remove('disabled'): '';
            transaction_finish.classList.remove('disabled');

            transaction_edit.setAttribute("onclick", "getEntryDetails(" + id + ",1)");
            (typeof(transaction_delete_items) != 'undefined' && transaction_delete_items != null) ? transaction_delete_items.setAttribute("onclick", "deleteEntry2()"): '';
            transaction_finish.setAttribute("onclick", "finishTransaction()");

            (typeof(col_item) != 'undefined' && col_item != null) ? col_item.style.display = "block": '';
            (typeof(col_list) != 'undefined' && col_list != null) ? col_list.classList.remove('col-12'): '';
            (typeof(col_list) != 'undefined' && col_list != null) ? col_list.classList.add('col-8'): '';
          }
          getEntries2();
          $("#modalEntry2").modal('show');
        }
      });
    }

    $("#frm_submit_2").submit(function(e) {
      e.preventDefault();

      $("#btn_submit_2").prop('disabled', true);
      $("#btn_submit_2").html("<span class='fa fa-spinner fa-spin'></span> Submitting ...");

      $.ajax({
        type: "POST",
        url: "controllers/sql.php?c=" + route_settings.class_name + "&q=add_detail",
        data: $("#frm_submit_2").serialize(),
        success: function(data) {
          getEntries2();
          var json = JSON.parse(data);
          if (json.data == 1) {
            success_add();
            document.getElementById("frm_submit_2").reset();
            $('.select2').select2().trigger('change');
          } else if (json.data == 2) {
            entry_already_exists();
          } else if (json.data == 3) {
            amount_is_greater();
          } else {
            failed_query(json);
            $("#modalEntry2").modal('hide');
          }
          $("#btn_submit_2").prop('disabled', false);
          $("#btn_submit_2").html("<span class='fa fa-check-circle'></span> Submit");
        }
      });
    });

    function deleteEntry2() {

      var count_checked = $("input[class='dt_id_2']:checked").length;

      if (count_checked > 0) {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover these entries!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            closeOnConfirm: false,
            closeOnCancel: false
          },
          function(isConfirm) {
            if (isConfirm) {
              var checkedValues = $("input[class='dt_id_2']:checked").map(function() {
                return this.value;
              }).get();

              $.ajax({
                type: "POST",
                url: "controllers/sql.php?c=" + route_settings.class_name + "&q=remove_detail",
                data: {
                  input: {
                    ids: checkedValues
                  }
                },
                success: function(data) {
                  getEntries2();
                  var json = JSON.parse(data);
                  console.log(json);
                  if (json.data == 1) {
                    success_delete();
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

    function finishTransaction() {
      var id = $("#hidden_id_2").val();

      var count_checked = $("input[class='dt_id_2']").length;
      if (count_checked > 0) {
        swal({
            title: "Are you sure?",
            text: "This entries will be finished!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Yes, finish it!",
            cancelButtonText: "No, cancel!",
            closeOnConfirm: false,
            closeOnCancel: false
          },
          function(isConfirm) {
            if (isConfirm) {
              $.ajax({
                type: "POST",
                url: "controllers/sql.php?c=" + route_settings.class_name + "&q=finish",
                data: {
                  input: {
                    id: id
                  }
                },
                success: function(data) {
                  getEntries();
                  var json = JSON.parse(data);
                  if (json.data == 1) {
                    success_add();
                    $("#modalEntry2").modal('hide');
                  } else {
                    failed_query(json);
                  }
                }
              });
            } else {
              swal("Cancelled", "Entries are safe :)", "error");
            }
          });
      } else {
        swal("Cannot proceed!", "No entries found!", "warning");
      }
    }
    // END MODULE

    function getSelectOption(class_name, primary_id, label, param = '', attributes = [], pre_value='', pre_label = 'Please Select') {
      $.ajax({
        type: "POST",
        url: "controllers/sql.php?c=" + class_name + "&q=show",
        data: {
          input: {
            param: param
          }
        },
        success: function(data) {
          var json = JSON.parse(data);
          $("#" + primary_id).html("<option value='" + pre_value + "'> &mdash; " + pre_label + " &mdash; </option>");

          

          for (list_index = 0; list_index < json.data.length; list_index++) {
            const list = json.data[list_index];
            var data_attributes = {};
            data_attributes['value'] = list[primary_id];
            for (var attr_index in attributes) {
              const attr = attributes[attr_index];
              data_attributes[attr] = list[attr];
            }
            $('#' + primary_id).append($("<option></option>").attr(data_attributes).text(list[label]));
          }
        }
      });
    }

    function generateReference(class_name) {
      $.ajax({
        type: "POST",
        url: "controllers/sql.php?c=" + class_name + "&q=generate",
        data: [],
        success: function(data) {
          var json = JSON.parse(data);
          $("#reference_code").val(json.data);
        }
      });
    }

    function logout() {
      var confirm_export = confirm("You are about to logout.");
      if (confirm_export == true) {
        var url = "controllers/sql.php?c=LoginUser&q=logout";
        $.ajax({
          url: url,
          success: function(data) {

            location.reload();

          }
        });
      }
      
    }
  </script>
</html>