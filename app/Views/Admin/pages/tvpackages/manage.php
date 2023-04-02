<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage TV Packages</h1>
        <a id="go_back_button" href="<?= base_url('admin/dashboard') ?>" class="btn btn-primary btn-icon-split btn-sm">
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

            <h6 class="m-0 font-weight-bold text-primary">TV Packages </h6>
            <!--              <a href="#">NEW ROOM</a>-->
            <!-- <a href="<?= base_url('admin/rooms/addCategory') ?>" class="btn btn-primary btn-icon-split btn-sm"><span class="text">Create Room</span></a> -->
            <button type="button" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#modal-add"><span class="text">Create Package</span></button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr style="text-align:center;">
                            <th width="5%">Sl. No.</th>
                            <th>Package Name</th>
                            <th>Duration (days)</th>
                            <th>Amount</th>
                            <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $count = 0;
                        foreach ($packages as $list) :
                        ?>
                            <tr style="text-align:center;">
                                <td><?php echo ++$count; ?></td>
                                <td><?php echo strtoupper($list['package']); ?></td>
                                <td><?php echo $list['validity']; ?></td>
                                <td><?php echo strtoupper($list['amount']); ?></td>
                                <td style="text-align:center;">

                                    <div class="dropdown">
                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                      
                                            <button type="button" class="dropdown-item" data-toggle="modal" data-target="#modal-update" data-todo='{"package_id":<?php echo $list['package_id']; ?>,"package":"<?= $list['package'] ?>","validity":"<?= $list['validity']?>", "amount": "<?= $list['amount'] ?>" }' ><span class="text">Update</span></button>
                                          
                                            <hr>
                                          

                                            <button type="button" class="dropdown-item" data-toggle="modal" data-target="#modal-delete" data-todo='{"package_id":<?php echo $list['package_id']; ?>,"package":"<?= $list['package'] ?>" }' ><span class="text">Delete</span></button>


                                        </div>
                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


<!-- Add Modal-->
<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Package</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- form start -->
                <form role="form" action="<?= base_url('admin/packages/create') ?>" method="post">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-8">

                                <div class="form-group input-group-sm">
                                    <label for="name">Package Name*</label>
                                    <input type="text" class="form-control" name="package_name" placeholder="Package Name" autocomplete="off">
                                </div>

                            </div>

                            <div class="col-sm-4">
                                
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group input-group-sm">
                                    <label>Amount</label>
                                    <input type="text" class="form-control" name="amount" placeholder="Amount" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-6">                                
                                <div class="form-group input-group-sm">
                                    <label>Validity (Days)</label>
                                    <input type="number" min=1 class="form-control" name="validity" placeholder="Validity" autocomplete="off">
                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary swalDefaultSuccess">CREATE</button>
                    </div>
                </form>

            </div>

        </div>
        <!-- /.modal-content -->
    </div>

</div> <!-- /.modal-dialog -->


<!-- Update Modal-->
<div class="modal fade" id="modal-update">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- form start -->
                <form role="form" action="<?= base_url('admin/packages/update') ?>" method="post">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-8">

                                <div class="form-group input-group-sm">
                                    <label for="name">Package Name *</label>
                                    <input type="text" class="form-control" name="package_name" id="package_name" placeholder="Package Name" autocomplete="off" required>
                                </div>

                            </div>

                            <div class="col-sm-4">                               
                                <input type="hidden"  name="package_id" id="row_id">
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group input-group-sm">
                                    <label>Amount</label>
                                    <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-6">                                
                                <div class="form-group input-group-sm">
                                    <label>Validity (Days)</label>
                                    <input type="number" min=1 class="form-control" name="validity" id="validity" placeholder="Validity" autocomplete="off">
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


<!--Delete Modal-->        
        <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
          <div class="modal-content bg-light">
            <div class="modal-header">
              <h4 class="modal-title">Delete</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">                
                <p>Are You sure to <strong>Delete</strong> the Package <strong><span id = "delName"></span></strong>   ?</p>                            
                <form action="<?= base_url('admin/packages/delete') ?>" method="post">   
                     
                <input type="hidden" name="package_id" id="del_id">  
                                        
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
$(document).ready(function() {

    $("#tvPackages").addClass('show');
    $("#tvPackagesManage").addClass('active');
    // $("#customerSubMenuManage").addClass('active');


    $('#modal-update').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    
      var todo_id = button.data('todo').package_id  
      var todo_package = button.data('todo').package 
      var todo_amount = button.data('todo').amount 
      var todo_validity = button.data('todo').validity  


      var modal = $(this)
    
      modal.find('.modal-body #row_id').val(todo_id)
      modal.find('.modal-body #package_name').val(todo_package)
      modal.find('.modal-body #amount').val(todo_amount)
      modal.find('.modal-body #validity').val(todo_validity)

    }); 


    $('#modal-delete').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var todo_id = button.data('todo').package_id  
      var todo_name = button.data('todo').package  
  
      var modal = $(this)  
      modal.find('.modal-body #del_id').val(todo_id)
      modal.find('.modal-body #delName').text(todo_name)  

    }); 


});

</script>