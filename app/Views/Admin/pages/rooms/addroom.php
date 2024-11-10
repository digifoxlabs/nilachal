<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Assign Room Numbers</h1>
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

            <h6 class="m-0 font-weight-bold text-primary">Room Type: <?= $catDetails['category'] ?> || Max Occupancy:
                <?= $catDetails['occupancy'] ?> </h6>
            <!--              <a href="#">NEW ROOM</a>-->
            <!-- <a href="<?= base_url('admin/rooms/addCategory') ?>" class="btn btn-primary btn-icon-split btn-sm"><span class="text">Create Room</span></a> -->
            <button type="button" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal"
                data-target="#modal-add"><span class="text">Create Room</span></button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr style="text-align:center;">
                            <th width="5%">Sl. No.</th>
                            <th>Room Number</th>
                            <th>Status</th>
                            <th>Booking Code</th>
                            <th>Online Mode</th>
                            <th>Offline Mode</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $count = 0;
                        foreach ($roomDetails as $list) :
                        ?>
                        <tr style="text-align:center;">
                            <td><?php echo ++$count; ?></td>
                            <td><?php echo strtoupper($list['room_no']); ?></td>
                            <td><?php echo strtoupper($list['status']); ?></td>
                            <td><?php echo strtoupper($list['booking_code']); ?></td>
                            <td><?php echo strtoupper(isset($list['is_online']) &&  $list['is_online'] == '1' ? 'Yes' : 'No'); ?></td>
                            <td><?php echo strtoupper(isset($list['is_offline']) &&  $list['is_offline'] == '1' ? 'Yes' : 'No'); ?></td>
                            <td style="text-align:center;">

                                <div class="dropdown">
                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">

                                        <button type="button" class="dropdown-item" data-toggle="modal"
                                            data-target="#modal-update"
                                            data-todo='{"room_id":<?php echo $list['room_id']; ?>,"room_no":"<?= $list['room_no'] ?>","status":"<?= $list['status']?>", "booking_code": "<?= $list['booking_code'] ?>", "is_online": "<?= $list['is_online'] ?>", "is_offline": "<?= $list['is_offline'] ?>" }'><span
                                                class="text">Update</span></button>

                                        <hr>


                                        <button type="button" class="dropdown-item" data-toggle="modal"
                                            data-target="#modal-delete"
                                            data-todo='{"room_id":<?php echo $list['room_id']; ?>,"room_no":"<?= $list['room_no'] ?>" }'><span
                                                class="text">Delete</span></button>


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
                <h4 class="modal-title">Add Room</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- form start -->
                <form role="form" action="<?= base_url('admin/rooms/createRoomNo') ?>" method="post">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-8">

                                <div class="form-group input-group-sm">
                                    <label for="name">Room No *</label>
                                    <input type="text" class="form-control" name="room_no" placeholder="Room No"
                                        autocomplete="off" required>
                                </div>

                            </div>

                            <div class="col-sm-4">
                                <input type="hidden" value="<?= $cat_id; ?>" name="cat_id">
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group input-group-sm">
                                    <label>Online Booking</label>
                                    <select class="form-control" name="is_online">
                                        <option value="" selected>Select</option>
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-sm-6">
                            <div class="form-group input-group-sm">
                                     <label>Offline Booking</label>
                                    <select class="form-control" name="is_offline">
                                        <option value="" selected>Select</option>
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                         </div>
                         </div>

                            
                      

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group input-group-sm">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option value="" selected>Select</option>
                                        <option value="available" selected>Available</option>
                                        <option value="na">NA</option>
                                    </select>
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
                <h4 class="modal-title">Update Room</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- form start -->
                <form role="form" action="<?= base_url('admin/rooms/updateRoomNo') ?>" method="post">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-8">

                                <div class="form-group input-group-sm">
                                    <label for="name">Room No *</label>
                                    <input type="text" class="form-control" name="room_no" id="room_no"
                                        placeholder="Room No" autocomplete="off" required>
                                </div>

                            </div>

                            <div class="col-sm-4">
                                <input type="hidden" value="<?= $cat_id; ?>" name="cat_id">
                                <input type="hidden" name="row_id" id="row_id">
                            </div>

                        </div>



                        
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group input-group-sm">
                                    <label>Online Booking</label>
                                    <select class="form-control" name="is_online" id="is_online">
                                    <option value="" selected>Select</option>
                                        <option value="1" <?= set_value('is_online')=='1'?'selected':'' ?>>
                                            Yes</option>
                                        <option value="0" <?= set_value('is_online')=='0'?'selected':'' ?>>No
                                        </option>
                                       
                                    </select>
                                </div>

                            </div>
                            <div class="col-sm-6">
                            <div class="form-group input-group-sm">
                                     <label>Offline Booking</label>
                                    <select class="form-control" name="is_offline" id="is_offline">
                                        <option value="" selected>Select</option>
                                        <option value="1" <?= set_value('is_offline')=='1'?'selected':'' ?>>
                                            Yes</option>
                                        <option value="0" <?= set_value('is_offline')=='0'?'selected':'' ?>>No
                                        </option>
                                    </select>
                                </div>

                         </div>
                         </div>









                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group input-group-sm">
                                    <label>Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="" selected>Select</option>
                                        <option value="available" <?= set_value('status')=='available'?'selected':'' ?>>
                                            Available</option>
                                        <option value="booked" <?= set_value('status')=='booked'?'selected':'' ?>>Booked
                                        </option>
                                        <option value="na" <?= set_value('status')=='na'?'selected':'' ?>>NA</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group input-group-sm">
                                    <label for="name">Booking Code</label>
                                    <input type="text" class="form-control" name="booking_code" id="booking_code"
                                        placeholder="Booking Code" autocomplete="off">
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
                <h4 class="modal-title">Delete Room</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Are You sure to <strong>Delete</strong> the Room <strong><span id="delName"></span></strong> ?</p>
                <form action="<?= base_url('admin/rooms/deleteRoomNo') ?>" method="post">
                    <input type="hidden" value="<?= $cat_id; ?>" name="cat_id">
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


    $('#modal-update').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal

        var todo_id = button.data('todo').room_id
        var todo_room = button.data('todo').room_no
        var todo_status = button.data('todo').status
        var todo_booking_code = button.data('todo').booking_code
        var todo_is_online = button.data('todo').is_online
        var todo_is_offline = button.data('todo').is_offline


        var modal = $(this)

        modal.find('.modal-body #row_id').val(todo_id)
        modal.find('.modal-body #room_no').val(todo_room)
        modal.find('.modal-body #status').val(todo_status)
        modal.find('.modal-body #booking_code').val(todo_booking_code)
        modal.find('.modal-body #is_online').val(todo_is_online)
        modal.find('.modal-body #is_offline').val(todo_is_offline)

    });


    $('#modal-delete').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var todo_id = button.data('todo').room_id
        var todo_name = button.data('todo').room_no

        var modal = $(this)
        modal.find('.modal-body #del_id').val(todo_id)
        modal.find('.modal-body #delName').text(todo_name)

    });


});
</script>