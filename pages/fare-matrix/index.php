<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title"> Fare Matrix </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <div class="btn-group">
            <button class="btn btn-primary btn-sm" onclick="addUser()">
              <i style="font-size: 20px;" class="mdi mdi-plus"></i>
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
          <h4 class="card-title">Manage fare matrix</h4>
          <div class="table-responsive">
            <table id="dt_entries" class="table table-bordered">
              <thead>
                <tr>
                    <th><input type='checkbox' onchange="checkAll(this, 'dt_id')"></th>
                    <th></th>
                    <th>Distance</th>
                    <th>Fare Amount</th>
                    <th>Date Added</th>
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
<?php require_once 'modal_matrix.php'; ?>
<script type="text/javascript">
    function addUser(){
        addModal();
        $("#div_password").show();
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
                        return "<input type='checkbox' value=" + row.fare_matrix_id + " class='dt_id' style='position: initial; opacity:1;'>";
                    }
                },
                {
                    "mRender": function(data, type, row) {
                      return "<center><button class='btn btn-primary mb-2 btn-sm' onclick='getEntryDetails(" + row.fare_matrix_id + ")'><span class='mdi mdi-pencil'></span></button></center>";
                    }
                },
                {
                    "data": "distance"
                },
                {
                    "data": "fare_amount"
                },
                {
                    "data": "date_added"
                }
            ]
        });
    }


    $(document).ready(function() {
        getEntries();
    });
</script>