<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

  <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->

  <a href="<?= base_url('admin/bookings/new') ?>" class="d-none d-sm-inline-block btn btn-sm btn-success btn-icon-split">
                    <span class="icon text-gray-400">
                      <!-- <i class="fas fa-check"></i> -->
                      <?php echo $newBookings; ?>
                    </span>
                    <span class="text">New Bookings</span>
                  </a>

  <a href="<?= base_url('admin/bookings/active') ?>" class="d-none d-sm-inline-block btn btn-sm btn-success btn-icon-split">
                    <span class="icon text-gray-400">
                      <!-- <i class="fas fa-check"></i> -->
                      <?php echo $newCheckIN; ?>
                    </span>
                    <span class="text">Check In Due</span>
                  </a>

  <a href="<?= base_url('admin/bookings/active') ?>" class="d-none d-sm-inline-block btn btn-sm btn-success btn-icon-split">
                    <span class="icon text-gray-400">
                    <?php echo $newCheckOut; ?>
                      <!-- <i class="fas fa-check"></i> -->
                    </span>
                    <span class="text">Check Out Due</span>
                  </a>



</div>



<?php

foreach($catData as $list){

      $roomType = $list['category']; 
      $noBeds = $list['occupancy']; ?>

      <!-- <h1 class="h4 mb-1 text-gray-800"><?= $list['category'] ?> || <?= str_repeat('<i class="fas fa-solid fa-bed"></i>',$list['occupancy']); ?>  </h1> -->
      <div class="row">

      <?php 
        
        //Query rooms inside category
        $this->db = db_connect();
        $builder = $this->db->table('rooms');    
        $builder->where('cat_id', $list['cat_id']);
        $query = $builder->get();
        $roomData = $query->getResultArray();


        foreach($roomData as $room){
          

            $room_no = $room['room_no'];

                if($room['status'] == 'booked'){ ?>

              <div class="col-xl-3 col-md-6 mb-4">
                  <a href="<?= base_url("admin/bookings/view/".$room['booking_code']) ?>" style="text-decoration:none">
                    <div class="card border-left-danger shadow h-100 py-0">
                      <div class="card-body">
                        
                        <div class="row no-gutters align-items-center">

                            <div class="col mr-2">
                              
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><?php echo $roomType; ?></div>
                                  <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $room_no; ?></div>
                                    </div>        
                                  </div>   
                                          
                            </div>
                                

                            <div class="col-auto">         
                              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">                                
                              <?= str_repeat(' <i class="fas fa-solid fa-bed text-primary"></i>',$noBeds); ?></div>
                          
                                  <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                      <div class="h5 mb-0 mr-3 font-weight-bold text-danger">Booked</div>
                                    </div>        
                                  </div>   
                            </div>     

                        </div>

                        <div class="row no-gutters mt-2">         
                              <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><i class="fas fa-fw fa-tv"></i></div>
                                  <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                      <div class="h6 mb-0 mr-3 text-gray-600"> <?php echo $room['tv_package_expiry'] ? date("d/m/Y",strtotime($room['tv_package_expiry'])): 'no package'; ?></div>
                                    </div>        
                                  </div>   
                            </div>  

                      </div>
                    </div>

                  </a>
                  </div>
    
              <?php  } 

                else if($room['status'] == 'available'){  ?>
                                    
            
                  <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-0">
                      <div class="card-body">
                        
                        <div class="row no-gutters align-items-center">

                            <div class="col mr-2">
                              
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><?php echo $roomType; ?></div>
                                  <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $room_no; ?></div>
                                    </div>        
                                  </div>   
                                          
                            </div>
                                

                            <div class="col-auto">         
                              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">   <?= str_repeat(' <i class="fas fa-solid fa-bed text-primary"></i>',$noBeds); ?></div>
                                  <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                      <div class="h5 mb-0 mr-3 font-weight-bold text-success">Available</div>
                                    </div>        
                                  </div>   
                            </div>     

                        </div>

                        <div class="row no-gutters mt-2">         
                              <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><i class="fas fa-fw fa-tv"></i></div>
                                  <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                      <div class="h6 mb-0 mr-3 text-gray-600"> <?php echo $room['tv_package_expiry'] ? date("d/m/Y",strtotime($room['tv_package_expiry'])): 'no package'; ?></div>
                                    </div>        
                                  </div>   
                            </div>  

                      </div>
                    </div>

                  </div>
                        
                                
              <?php  }              
                                
                else {  ?>
                                        


                    <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-0">
                      <div class="card-body">
                        
                        <div class="row no-gutters align-items-center">

                            <div class="col mr-2">
                              
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><?php echo $roomType; ?></div>
                                  <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $room_no; ?></div>
                                    </div>        
                                  </div>   
                                          
                            </div>
                                

                            <div class="col-auto">         
                              <div class="text-xs font-weight-bold text-info text-uppercase mb-1"> <?= str_repeat(' <i class="fas fa-solid fa-bed text-primary"></i>',$noBeds); ?></div>
                                  <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                      <div class="h5 mb-0 mr-3 font-weight-bold text-warning">Disabled</div>
                                    </div>        
                                  </div>   
                            </div>     

                        </div>

                        <div class="row no-gutters mt-2">         
                              <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><i class="fas fa-fw fa-tv"></i></div>
                                  <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                      <div class="h6 mb-0 mr-3 text-gray-600"> <?php echo $room['tv_package_expiry'] ? (date('Y-m-d')> $room['tv_package_expiry'] ? 'Expired' : date("d/m/Y",strtotime($room['tv_package_expiry']))) : 'no package'; ?></div>
                                    </div>        
                                  </div>   
                            </div>  

                      </div>
                    </div>

                  </div>
                    
                    
                <?php }           

      } 

      echo "<hr>";  ?>

        </div>
        <hr>

   <?php  } ?>




</div>

<script>
$(document).ready(function() {
    
    $("#dashboardMenu").addClass('active'); 

});

</script>   
