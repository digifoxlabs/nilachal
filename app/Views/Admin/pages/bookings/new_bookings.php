<!-- Begin Page Content -->
<div class="container-fluid">

<?php
    $session = session(); ?>
    
    <script type="text/javascript">
        <?php if($session->getFlashdata('success')): ?>
        toastr.success('<?php echo $session->getFlashdata('success'); ?>')
        <?php elseif($session->getFlashdata('error')): ?>
        toastr.warning('<?php echo $session->getFlashdata('error'); ?>');
        <?php endif; ?>
      </script>  


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3" style="display:flex;align-items: center;justify-content:space-between;">
            <h6 class="m-0 font-weight-bold text-primary">New Bookings</h6>

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

<!-- Modal Delete -->  
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Booking?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-body">                
                <p>Are You sure to <strong>Delete</strong> the booking of <strong><span id = "delName"></span></strong>   ?</p>                            
                <form action="<?php echo base_url('admin/bookings/deleteBooking') ?>" method="post">                    
                <input type="hidden" name="row_id" id="del_id">  
                                        
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-outline-success">Confirm</button>
                </div>                    
              </form>                          
            </div>
      </div>
    </div>
  </div>








<script>
    var site_url = "<?php echo base_url(); ?>";

    $(document).ready(function() {

        $("#bookingMenu").addClass('show');
         $("#bookingNew").addClass('active');


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

                    var type = 'confirmed';                 
         
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
                            '" class="btn btn-info btn-sm" >VIEW</a> <button class="btn btn-outline-danger btn-sm del-button" data-toggle="modal" data-target="#deleteModal" data-id="' + row.booking_code + '" data-name="' + row.guest_name + '" >Del</button>'
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





     $('#deleteModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var todo_id = button.data('id')  
      var todo_name = button.data('name')
  
      var modal = $(this)  
      modal.find('.modal-body #del_id').val(todo_id)
      modal.find('.modal-body #delName').text(todo_name)  

    }); 







    });
</script>