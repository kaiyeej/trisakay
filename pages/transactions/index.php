<div class="content-wrapper" style="display: inline-block">
  <div class="page-header">
    <h3 class="page-title"> Transactions </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <!-- <div class="btn-group">
            <button class="btn btn-warning btn-sm" onclick='cancelEntry()' id='btn_delete'>
              <i style="font-size: 20px;" class="mdi mdi-close-circle"></i>
            </button>
            <button class="btn btn-danger btn-sm" onclick='deleteEntry()' id='btn_delete'>
              <i style="font-size: 20px;" class="mdi mdi-delete"></i>
            </button>
          </div> -->
        </li>
      </ol>
    </nav>
  </div>

  <div class="row">
    <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Manage Transactions</h4>
        <div class="table-responsive">
          <table id="dt_entries" class="table table-hover" style="width:100%">
            <thead>
              <tr>
                <th></th>
                <th>Reference #</th>
                <th>User</th>
                <th>Driver</th>
                <th>Amount</th>
                <th>Remarks</th>
                <th>Driver Remarks</th>
                <th>Rating</th>
                <th>Status</th>
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
<?php require_once 'modal_transaction.php'; ?>
<script type="text/javascript">
  function getUserDetails(id) {
    $("#div_password").hide();
    getEntryDetails(id);
  }

  function getEntries() {
    $("#dt_entries").DataTable().destroy();
    $("#dt_entries").DataTable({
      "processing": true,
      "scrollX": true,
      "ajax": {
        "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=show2",
        "dataSrc": "data"
      },
      "columns": [{
          "mRender": function(data, type, row) {
            return "<center><button class='btn btn-primary mb-2 btn-sm' onclick='getUserDetails(" + row.transaction_id + ")'><span class='mdi mdi-pencil'></span></button></center>";
          }
        },
        {
          "data": "ref_number"
        },
        {
          "data": "user"
        },
        {
          "data": "driver"
        },
        {
          "data": "amount"
        },
        {
          "data": "remarks"
        },
        {
          "data": "driver_remarks"
        },
        {
          "data": "rating"
        },
        {
          "mRender": function(data, type, row) {

            if (row.status == "P") {
              return "<strong style='color:#ff9800;'>Pending</strong>";
            } else if (row.status == "C") {
              return "<strong style='color:red;'>Canceled</strong>";
            } else if (row.status == "R") {
              return "<strong style='color:red;'>Rejected</strong>";
            } else if (row.status == "A") {
              return "<strong style='color:#3f51b5;'>On-the-way</strong>";
            } else if (row.status == "S") {
              return "<strong style='color:#f400ff;'>Booked</strong>";
            } {
              return "<strong style='color:green;'>Finished</strong>";
            }

          }
        },
        {
          "data": "date_last_modified"
        }
      ]
    });
  }

  $(document).ready(function() {
    getEntries();
    getSelectOption('Users', 'user_id', 'user_fullname', "category='U'");
    getSelectOption('Users', 'driver_id', 'user_fullname', "category='D'");
  });
</script>