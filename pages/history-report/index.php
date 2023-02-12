<div class="content-wrapper">
  <div class="container">
    <div class="card" style="background: #c9daf1;">
      <div class="card-body row">
        <div class="col-md-4">
          <label><strong>User</strong></label>
          <select class="form-control input-item" style="width: 100%;height: 35px;" name="input[user_id]" id="user_id" required>
            <option value="">Please Select:</option>
          </select>
        </div>
        <div class="col-md-8" style="padding-top: 20px;">
          <div class="btn-group">
            <button type="submit" id="btn_generate" onclick="getEntries()" class="btn btn-primary btn-sm">
              <span class="icon">
                <i class="mdi mdi-reload"></i>
              </span>
              <span class="text"> Generate</span>
            </button>
            <button type="button" onclick="print_report('report_container')" class="btn btn-secondary btn-sm">
              <span class="icon">
                <i class="mdi mdi-printer"></i>
              </span>
              <span class="text"> Print</span>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="row" style="padding-top:15px;">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive" id="report_container">
              <table id="dt_entries" class="table table-bordered">
                <thead>
                  <tr>
                    <th>Reference #</th>
                    <th>User</th>
                    <th>Driver</th>
                    <th>Amount</th>
                    <th>Remarks</th>
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
  <script type="text/javascript">
    function getEntries() {
      var user_id = $("#user_id").val();
      if(user_id == "-1"){
        var param = "";
      }else{
        var param = "user_id='"+user_id+"'";
      }

      $("#dt_entries").DataTable().destroy();
      $("#dt_entries").DataTable({
        "processing": true,
        "paging": false,
        "info": false,
        "bFilter": false,
        "ajax": {
          "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=show",
          "dataSrc": "data",
          "method": "POST",
          "data": {
              input: {
                  param: param
              }
          },
        },
        "columns": [{
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
      getSelectOption('Users', 'user_id', 'user_fullname', "category='U'", [], -1, 'All');
      getEntries();
    });
  </script>