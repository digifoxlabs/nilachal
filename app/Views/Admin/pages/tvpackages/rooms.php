
        <!-- Begin Page Content -->
        <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Room Packages</h1>
        <a id="go_back_button" href="<?= base_url('admin/rooms') ?>" class="btn btn-primary btn-icon-split btn-sm">
            <span class="icon text-white-50">
                <i class="fas fa-chevron-left"></i>
            </span>
            <span class="text">GO Back</span>
        </a>
    </div>

    <?php
    $session = session(); ?>

    <script type="text/javascript">
        <?php if ($session->getFlashdata('success')) : ?>
            toastr.success('<?php echo $session->getFlashdata('success'); ?>')
        <?php elseif ($session->getFlashdata('error')) : ?>
            toastr.warning('<?php echo $session->getFlashdata('error'); ?>');
        <?php endif; ?>
    </script>

         
    <!-- DataTable -->
    <div class="card shadow mb-4">
        <div class="card-header py-3" style="display:flex;align-items: center;justify-content:space-between;">

            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="70%" cellspacing="0">
                    <thead>
                        <tr style="text-align:center;">
                            <th width="5%">Sl. No.</th>
                            <th>Room Number</th>
                            <th>TV Package Validity</th>                           
                            <th>Status</th>                           
                            <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $count = 0;
                        foreach ($roomDetails as $list) :

                            if($list['tv_package_expiry']){

                                if(date('Y-m-d') > $list['tv_package_expiry'])
                                $status =  "<p class='text-danger'>expired</p>";
                                else
                                $status = "<p class='text-success'>active</p>";

                            }
                            else {

                                $status =  "<p class='text-warning'>no package</p>";
                            }
                            
                            
                           

                        ?>
                            <tr style="text-align:center;">
                                <td><?php echo ++$count; ?></td>
                                <td><?php echo strtoupper($list['room_no']); ?></td>
                                <td><?php echo $list['tv_package_expiry'] ? date("d/m/Y",strtotime($list['tv_package_expiry'])): ''; ?></td>
                               
                                <td><?= $status; ?></td>
                                <td style="text-align:center;">

                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-update" data-todo='{"room_id":<?php echo $list['room_id']; ?>,"room_no":"<?= $list['room_no'] ?>","status":"<?= $list['status']?>"}' ><span class="text">Update</span></button>


                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>



<!-- Update Modal-->
<div class="modal fade" id="modal-update">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update TV Package</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- form start -->
                <form role="form" action="<?= base_url('admin/packages/updateRoom') ?>" method="post">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-8">

                            <div class="form-group input-group-sm">
                                    <label>Package</label>
                                    <select class="form-control" name="package" id="package">
                                        <option value="" selected>Select</option>
                                        <?php 
                                        foreach ($packages as $package) { ?>

                                          <option value="<?= $package['validity'] ?>"><?= $package['package'] ?></option>

                                      <?php  }
                                        
                                        ?>
                                                
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4">                                
                                <input type="hidden"  name="room_id" id="row_id">
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-6">

                            <strong><?php echo "Start Date";?></strong>
                            <br />
                            <div class="input-group input-group-sm">
                                <input required id="start_date" type="date" class="form-control" name="start_date" autocomplete="off">
                            </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">

                            <strong><?php echo "Valid up-to";?></strong>
                            <br />
                            <div class="input-group input-group-sm">
                                <input required id="end_date" type="date" class="form-control" name="end_date" autocomplete="off" readonly>
                            </div>

                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary swalDefaultSuccess">UPDATE</button>
                    </div>
                </form>

            </div>

        </div>
        <!-- /.modal-content -->
    </div>

</div> <!-- /.modal-dialog -->







    </div>


<script>
$(document).ready(function() {


    $('#modal-update').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    
      var todo_id = button.data('todo').room_id  
      var todo_room = button.data('todo').room_no 
      var todo_status = button.data('todo').status 

      var modal = $(this)
    
      modal.find('.modal-body #row_id').val(todo_id)

    }); 





    var days = 0;

    $("#tvPackages").addClass('show');
    $("#tvPackagesView").addClass('active');

    $("#package").change(function () {
        days = parseInt(this.value,10);
        updatedate(days);
    });

    $("#start_date").change(function () {
   
            updatedate(days);
      });


      Date.prototype.toInputFormat = function() {
       var yyyy = this.getFullYear().toString();
       var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
       var dd  = this.getDate().toString();
       return yyyy + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + (dd[1]?dd:"0"+dd[0]); // padding
    };


          function updatedate(){

              let date = new Date($("#start_date").val());

              if(date){

                if(!isNaN(date.getTime())){
                 date.setDate(date.getDate() + days);

                $("#end_date").val(date.toInputFormat());
                } else {
                alert("Select Date");  
                }
              }     

          }


});




</script>   