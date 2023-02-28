<style>
    .text-right {
        text-align: right;
    }
</style>
<div class="content-wrapper">
  <div class="container">
    <div class="card" style="background: #c9daf1;">
      <div class="card-body row">
        <div class="col-md-3">
          <label><strong>Start</strong></label>
          <input type="date" value="<?php echo date('Y-m-01', strtotime(date("Y-m-d"))); ?>" class="form-control input-item" style="padding: 9px;" name="input[start_date]" id="start_date" required>
        </div>
        <div class="col-md-3">
          <label><strong>End</strong></label>
          <input type="date" value="<?php echo date('Y-m-t', strtotime(date("Y-m-d"))) ?>" class="form-control input-item" style="padding: 9px;" name="input[end_date]" id="end_date" required>
        </div>
        <div class="col-md-3">
          <label><strong>Driver</strong></label>
          <select class="form-control input-item" style="width: 100%;height: 35px;" name="input[user_id]" id="user_id" required>
            <option value="">Please Select:</option>
          </select>
        </div>
        <div class="col-md-3" style="padding-top: 20px;">
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
              <center>
                <h3>Drivers Report</h3>
              </center>
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
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="3" style="text-align:right">Total:</th>
                    <th style="text-align:right"></th>
                    <th colspan="4" style="text-align:right"></th>
                  </tr>
                </tfoot>
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
      var start_date = $("#start_date").val();
      var end_date = $("#end_date").val();


      $("#dt_entries").DataTable().destroy();
      $("#dt_entries").DataTable({
        "processing": true,
        "paging": false,
        "info": false,
        "bFilter": false,
        "ajax": {
          "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=show",
          "dataSrc": "data",
          "type": "POST",
          "data": {
            input: {
              start_date: start_date,
              end_date: end_date,
              user_id: user_id,
              type: 'D'
            }
          },
        },
        "footerCallback": function(row, data, start, end, display) {
          var api = this.api();

          // Remove the formatting to get integer data for summation
          var intVal = function(i) {
            return typeof i === 'string' ?
              i.replace(/[\$,]/g, '') * 1 :
              typeof i === 'number' ?
              i : 0;
          };

          pageTotal = api
            .column(3, {
              page: 'current'
            })
            .data()
            .reduce(function(a, b) {
              return intVal(a) + intVal(b);
            }, 0);

          // Update footer
          $(api.column(3).footer()).html(
            "&#x20B1;" + pageTotal
          );
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
            "data": "amount", className: "text-right"
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
            "data": "date_added"
          }
        ]
      });
    }

    $(document).ready(function() {
      getSelectOption('Users', 'user_id', 'user_fullname', "category='D'", [], -1, 'All');
      getEntries();
    });
  </script>