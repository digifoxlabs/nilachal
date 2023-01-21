<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Rooms</h1>
        <a id="go_back_button" href="<?= base_url('admin/rooms/') ?>" class="btn btn-primary btn-icon-split btn-sm">
            <span class="icon text-white-50">
                <i class="fas fa-chevron-left"></i>
            </span>
            <span class="text">GO Back</span>
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            Create New Room Category
        </div>
        <div class="card-body">

        <?php if (isset($validation)) : ?>
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <?= $validation->listErrors() ?>
                        </div>
                    </div>
                <?php endif; ?>

            <div class="row">

                <div class="col-lg-8">

                    <form action="<?= base_url('admin/rooms/addCategory') ?>" method="post" class="user" enctype="multipart/form-data">

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>Room Type</label>
                                <input type="text" class="form-control" name="room_type" placeholder="Room Type" value="<?= set_value('room_type') ?>" required>
                            </div>
                            <div class="col-sm-6">

                            <div class="form-group input-group-sm">
                                    <label>Parent Category (Optional)</label>
                                    <select class="form-control" name="parent_cat_id">
                                        <option value="" selected>No parent</option>
                                        <?php 
                                        
                                        foreach($roomCategories as $cat){ ?>

                                            <option value="<?= $cat['cat_id'] ?>"><?= $cat['category'] ?>||<?= $cat['occupancy'] ?></option>

                                         <?php  } ?>                                 
                                    
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label>Price Per Night</label>
                                <input type="text" class="form-control" name="room_rate" placeholder="Price Per Night" value="<?= set_value('room_rate') ?>" required>
                            </div>
                            <div class="col-sm-6">
                                <label>Max Occupancy</label>
                                <input type="text" class="form-control" name="room_occupancy" placeholder="Total Rooms" value="<?= set_value('room_occupancy') ?>" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label>Room Description</label>
                                <textarea class="form-control" name="room_description" rows="8" cols="12" autocomplete="off"><?= set_value('room_description') ?></textarea>
                            </div>

                            <div class="col-sm-6">
                                <label for="room_image">Upload Image</label>
                                <input type="file" name="room_image">
                            </div>

                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="col-sm-4">
                                
                            <button class="btn btn-primary btn-user btn-block" type="submit" name="create_category">CREATE</button>
                            </div>

                        </div>
                      
                        <hr>

                    </form>
                </div>
            </div>





        </div>
    </div>



   

</div>

