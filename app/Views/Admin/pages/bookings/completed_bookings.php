<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3" style="display:flex;align-items: center;justify-content:space-between;">
            <h6 class="m-0 font-weight-bold text-primary">Completed Bookings</h6>

            <div>

            <a id="go_back_button" href="<?= base_url('admin/dashboard') ?>" class="btn btn-primary btn-icon-split btn-sm">
                <span class="icon text-white-50">
                    <i class="fas fa-chevron-left"></i>
                </span>
                <span class="text">GO Back</span>
            </a>
            </div>

        </div>
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped table-hover" id="dataTable" cellspacing="0">

                    <thead>
                        <tr>
                            <th>Booking Code</th>
                            <th>Mode</th>
                            <th>Customer Name</th>
                            <th>Contact No.</th>
                            <th>Check In</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<script>
    var site_url = "<?php echo base_url(); ?>";

    $(document).ready(function() {


        var dataTable = $('#dataTable').DataTable({
            lengthMenu: [
                [10, 30, -1],
                [10, 30, "All"]
            ], // page length options
            bProcessing: true,
            serverSide: true,
            responsive:true,
            scrollCollapse: true,
            ajax: {
                url: site_url + "/admin/fetchbookings", // json datasource
                type: "post",
                data: function(data) {
                    // key1: value1 - in case if we want send data with request       

                    var type = 'complete';                 
         
                    // Append to data
                    data.status = type;

                }

            },
            columns: [
                { data: "booking_code"},
                {
                    data: "mode"
                },
                {
                    data: "guest_name"
                },
                {
                    data: "guest_mobile"
                },
                {
                    data: "check_in"
                },
                {
                    data: "booking_status"
                },
                {
                    mRender: function(data, type, row) {
                        return '<a href="<?= base_url('admin/bookings/view') ?>' + '/' + row.booking_code +
                            '" class="btn btn-info btn-sm" >VIEW</a>'
                    }
                },
            ],
            columnDefs: [

                {
                    orderable: false,
                    targets: [1, 2, 3]
                },
                {
                    className: 'text-center',
                    targets: [3, 4, 5, 6]
                },
                {
                    "targets": [1, 2, 3, 4, 5],
                    "render": function(data) {
                        return data.toUpperCase();
                    },
                },

            ],
            bFilter: true, // to display datatable search
        });


        $('#searchByStatus').change(function(){
            dataTable.draw();
          });

    });
</script>