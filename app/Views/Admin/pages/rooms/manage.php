<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Rooms</h1>
        <a id="go_back_button" href="javascript:GoBack()" class="btn btn-primary btn-icon-split btn-sm">
            <span class="icon text-white-50">
                <i class="fas fa-chevron-left"></i>
            </span>
            <span class="text">GO Back</span>
        </a>
    </div>

    <?php
    $session = session(); ?>
    
    <script type="text/javascript">
        <?php if($session->getFlashdata('success')): ?>
        toastr.success('<?php echo $session->getFlashdata('success'); ?>')
        <?php elseif($session->getFlashdata('error')): ?>
        toastr.warning('<?php echo $session->getFlashdata('error'); ?>');
        <?php endif; ?>
      </script>  


    <!-- DataTable -->
    <div class="card shadow mb-4">
            <div class="card-header py-3" style="display:flex;align-items: center;justify-content:space-between;">              
                   
              <h6 class="m-0 font-weight-bold text-primary">Room Categories</h6>
<!--              <a href="#">NEW ROOM</a>-->                
                 <a href="<?= base_url('admin/rooms/addCategory') ?>" class="btn btn-primary btn-icon-split btn-sm"><span class="text">Create Room Category</span></a>
       
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th width="10%">Image</th>
                      <th width="15%">Room Type</th>
                      <th width="10%">Rate per Night</th>                      
                      <th width="5%">Max Occupancy</th>
                      <th width="15%">Description</th>                                          
                      <th width="10%">Total Rooms</th>                                          
                      <th width="10%">Action</th>
                    </tr>
                  </thead>            
                  <tbody>

                  <?php
                    $count = 0;
                     foreach($roomCategory as $list):                  
                ?>
                    <tr>
                    <td><img src="<?php echo  base_url('assets/admin/img') . '/' . $list['image'] ?>" alt="" class="img-thumbnail" /></td>
                    <td><?php echo $list['category'] ?></td>
                    <td><?php echo $list['rate'] ?></td>
                    <td><?php echo $list['occupancy'] ?></td>
                    <td><?php echo $list['description'] ?></td>
                    <td><?php echo $list['roomcount'] ?></td>
                  <td>

                  <div class="dropdown">
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                  Action
                  </button>
                  <div class="dropdown-menu">      
                  <a class="dropdown-item" href="<?= base_url('admin/rooms/add/'.$list['cat_id']) ?>">Assign Rooms</a>
                  <hr>
                  <a class="dropdown-item" href="<?= base_url('admin/rooms/editCategory/'.$list['cat_id']) ?>">Edit</a>
                  <button type="button" class="dropdown-item" data-toggle="modal" data-target="#modal-delete" data-todo='{"cat_id":<?php echo $list['cat_id']; ?>,"name":"<?= $list['category'] ?>" }' ><span class="text">Delete</span></button>


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


<!--Delete Modal-->        
<div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
          <div class="modal-content bg-light">
            <div class="modal-header">
              <h4 class="modal-title">Delete Room</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">                
                <p>Are You sure to <strong>Delete</strong> the Room <strong><span id = "delName"></span></strong>   ?</p>                            
                <form action="<?= base_url('admin/rooms/deleteRoomCat') ?>" method="post">   
                   
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
$(document).ready(function() {


    $('#modal-delete').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var todo_id = button.data('todo').cat_id  
      var todo_name = button.data('todo').name  
  
      var modal = $(this)  
      modal.find('.modal-body #del_id').val(todo_id)
      modal.find('.modal-body #delName').text(todo_name)  

    }); 


});

</script>

<script>
$(document).ready(function() {
    
    $("#roomMenu").addClass('active'); 

});

</script>   