<script>
$(document).ready(function() {
    var calendar = $('#calendar1').fullCalendar({
        editable: true,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek'
        },
        eventColor: 'green',
        eventTextColor: 'white',
        displayEventTime: false,

        events: {
            url: '<?= base_url('admin/bookings/calendar_json') ?>',
            color: 'orange'

        },

    });
});
</script>

<style>
.date-range {
    display: none;
    /* Hide the date range by default */}
</style>


<?php
    $session = session(); ?>

    <script type="text/javascript">
    <?php if ($session->getFlashdata('success')) : ?>
    toastr.success('<?php echo $session->getFlashdata('success'); ?>')
    <?php elseif ($session->getFlashdata('error')) : ?>
    toastr.warning('<?php echo $session->getFlashdata('error'); ?>');
    <?php endif; ?>
    </script>


<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Calendar</h1>
        <a id="go_back_button" href="<?= base_url('admin/dashboard') ?>" class="btn btn-primary btn-icon-split btn-sm">
            <span class="icon text-white-50">
                <i class="fas fa-chevron-left"></i>
            </span>
            <span class="text">GO Back</span>
        </a>
    </div>


    <div class="row">

        <div class="col-lg-6">

            <!-- Dropdown Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Showing All Bookings</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">

                    <!-- Contents Here-->

                    <div class="container">

                        <div id="calendar1"></div>

                    </div>


                </div>
            </div>




        </div>

        <div class="col-lg-6">

            <!-- Dropdown Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Disabled Bookings</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">

                            <button type="button" class="dropdown-item btn btn-primary btn-icon-split btn-sm"
                                data-toggle="modal" data-target="#modal-add"><span class="text">Create</span></button>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">

                    <!-- Contents Here-->

                    <div class="container">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered display compact" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr style="text-align:center;">
                                        <th width="5%">Sl. No.</th>
                                        <th>Category</th>
                                        <th>On</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
                                $count = 0;
                                foreach ($dateRanges as $list) :
                        ?>
                                    <tr style="text-align:center;">
                                        <td><?php echo ++$count; ?></td>
                                        <td><?php echo strtoupper($list['disable_category']); ?></td>
                                        <td><?php echo $list['single_date']?:'NULL'; ?></td>
                                        <td><?php echo $list['start_date']?:'NULL'; ?></td>
                                        <td><?php echo $list['end_date']?:'NULL'; ?></td>

                                        <td style="text-align:center;">

                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#modal-delete"
                                                        data-todo='{"cat_id":<?php echo $list['date_id']; ?>,"disable_category":"<?= $list['disable_category'] ?>" }'><span
                                                            class="text">Delete</span></button>                                 

                                        </td>

                                    </tr>

                                    <?php endforeach; ?>



                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->


    <!-- Add Modal-->
    <div class="modal fade" id="modal-add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Disable Booking</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- form start -->
                    <form role="form" action="<?= base_url('admin/bookings/createDisabledDate') ?>" method="post">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-8">

                                    <div class="form-group input-group-sm">
                                        <label>Category</label>
                                        <select class="form-control" name="disable_category">
                                            <option value="" selected>Select</option>
                                            <option value="online" selected>ONLINE</option>
                                            <option value="offline">OFFLINE</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-4"></div>

                            </div>

                            <div class="row">

                                <div class="col-6">

                                    <!-- Radio buttons to toggle between single date or date range -->
                                    <label><input type="radio" name="dateType" id="singleDateOption" value="single"
                                            checked="checked" onclick="toggleDateInput()"> Single Date</label>
                                    <label><input type="radio" name="dateType" id="rangeOption" value="range"
                                            onclick="toggleDateInput()"> Date Range</label>
                                </div>
                                <div class="col-6"></div>


                            </div>
                            <div class="row">

                                <div class="col-6">

                                    <!-- Single Date Input (Visible when single is selected) -->
                                    <div class="form-group input-group-sm" id="singleDateDiv">
                                        <label for="singleDate">Select a Single Date:</label>
                                        <input type="date" class="form-control" id="singleDate" name="singleDate">
                                    </div>

                                </div>
                                <div class="col-6"></div>

                            </div>

                            <div id="dateRangeDiv" class="date-range form-group input-group-sm">
                            <div class="row">
                                    <div class="col-12">
                                        <div class="row">                                    
                                <!-- Date Range Inputs (Visible when range is selected) -->                                

                                    <div class="col-6">
                                        <label for="startDate">Select Start Date:</label>
                                        <input type="date" class="form-control" id="startDate" name="startDate" value=null>
                                    </div>
                                    <div class="col-6">
                                        <label for="endDate">Select End Date:</label>
                                        <input type="date" class="form-control" id="endDate" name="endDate" value=null>
                                    </div>

                                </div>

                                </div>

                            </div>
                            </div>



                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary swalDefaultSuccess btn-sm">SUBMIT</button>
                        </div>
                    </form>

                </div>

            </div>
            <!-- /.modal-content -->
        </div>

    </div> <!-- /.modal-dialog -->


    <!--Delete Modal-->        
<div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
          <div class="modal-content bg-light">
            <div class="modal-header">
              <h4 class="modal-title">Delete Date</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">                
                <p>Are You sure to <strong>Delete</strong> the Date Range <strong></strong>   ?</p>                            
                <form action="<?= base_url('admin/bookings/deleteDisabledDate') ?>" method="post">   
                   
                <input type="hidden" name="row_id" id="del_id">  
                                        
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-outline-success">Confirm</button>
                </div>
                    
              </form>               
                                
            </div>
        
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal end -->   


    <script>
    // JavaScript to toggle visibility between single date and date range
    function toggleDateInput() {
        var dateOption = document.querySelector('input[name="dateType"]:checked').value;

        if (dateOption === 'single') {
            document.getElementById('singleDateDiv').style.display = 'block';
            document.getElementById('dateRangeDiv').style.display = 'none';
        } else if (dateOption === 'range') {
            document.getElementById('singleDateDiv').style.display = 'none';
            document.getElementById('dateRangeDiv').style.display = 'block';
        }
    }

    // Set initial state on page load (in case of a page refresh)
    document.addEventListener('DOMContentLoaded', function() {
        toggleDateInput(); // Make sure the correct date input is shown on load
    });
    </script>

<script>
$(document).ready(function() {

    $('#dataTable').dataTable({

        "bInfo": false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
    "paging": false,//Dont want paging                
    "bPaginate": false,//Dont want paging  
    "bFilter": false,


});



        $('#modal-delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var todo_id = button.data('todo').cat_id  


        var modal = $(this)  
        modal.find('.modal-body #del_id').val(todo_id)


        }); 


});


</script>