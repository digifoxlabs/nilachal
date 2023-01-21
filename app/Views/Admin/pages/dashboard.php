<!-- Begin Page Content -->
<div class="container-fluid">
    


<div class="row">

  <!-- Occupancy Area -->
  <div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">   
     
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">ROOM Occupancy</h6>
        
        <a href="#" class="btn btn-danger btn-icon-split btn-sm">
        <span class="icon text-white-50">
        <i class="fas fa-check"></i>
        </span>
        <span class="text">Occupied</span>
        </a> 
          
        <a href="#" class="btn btn-success btn-icon-split btn-sm border" >
        <span class="icon text-white-50">
        <i class="fas fa-check"></i>
        </span>
        <span class="text">Ready</span>
        </a>         
          
          <a href="#" class="btn btn-light btn-icon-split btn-sm border" >
        <span class="icon text-white-50">
        <i class="fas fa-check"></i>
        </span>
        <span class="text">NA</span>
        </a>
      </div>
      <!-- Card Body -->       
        
      <div class="card-body"> 
          
       <?php

       foreach($catData as $list){

        $roomType = $list['category']; 

       ?>

       <h6 class="m-0 font-weight-bold text-primary"><?= $list['category'] ?> || <?= str_repeat('<i class="fas fa-solid fa-bed"></i>',$list['occupancy']); ?>  </h6>
       

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

                    <a href='<?= base_url("admin/bookings/view/".$room['booking_code']) ?>' class='btn btn-danger btn-icon-split border' >
                    <span class='icon text-white-50' >
                        <i class='fas fa-bed'></i>
                        </span>
                    <span class='text hover' id='<?php echo "booking"; ?>'><?php echo $room_no; ?></span>
                    </a>
              <?php  } 

                else if($room['status'] == 'available'){
                                    
                                    
                    echo "<a href='' class='btn btn-success btn-icon-split border'>
                    <span class='icon text-white-50'>
                    <i class='fas fa-bed'></i>
                    </span>
                    <span class='text'>$room_no</span>
                    </a> ";                
                                
                }              
                                
                else {  ?>
                                        

                    <button class="btn btn-light btn-icon-split">
                    <span class="icon text-white-50">
                    <i class="fas fa-bed"></i>
                    </span>
                    <span class="text"><?php echo $room_no;?></span>
                    </button>                  
                    
                    
                <?php }           

      } 

      echo "<hr>";
      
      
    }?>

                
        <hr>

      </div>      
    </div>
  </div>
    
    
    <div class="col-xl-4 col-lg-5">
      <div class="card shadow mb-4">
                  
          
              <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Today's Events</h6>

                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Action:</div>
                      <a class="dropdown-item" href="room_modes.php">Manage</a>                      
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="event_planner.php">Offline Events</a>
                    </div>
                  </div>

                </div>
                <!-- Card Body -->
                <div class="card-body">



        <div class="row">
          <!-- New Bookings -->
          <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
               <a href="<?= base_url('admin/bookings/new') ?>">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Bookings</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $newBookings; ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-handshake fa-2x text-gray-300"></i>
                  </div>
                </div>
                  </a>
              </div>
            </div>
          </div>

          <!-- Check IN -->
          <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-info  shadow h-100 py-2">
              <div class="card-body">
                <a href="<?= base_url('admin/bookings/active') ?>">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Check IN Due</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $newCheckIN; ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                  </div>
                </div>
                </a>
              </div>
            </div>
          </div>

          <!-- Check Out -->
          <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
              <div class="card-body">
                <a href="<?= base_url('admin/bookings/active') ?>">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Check Out Due</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $newCheckOut; ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                  </div>
                </div>
                </a>
              </div>
            </div>
          </div>
        </div>   

                </div>    
                       
        </div>        
    </div>
</div>
    
    
    
    
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Make Room Ready</h4>
        </div>
        <div class="modal-body">
          <p id="bid">Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">No &amp; Close</button>
           <button class="btn btn-primary" onclick='makeready()'>Yes &amp; Save changes</button>
        </div>
      </div>
      
    </div>
  </div>
    
    

</div>
<!-- /.container-fluid -->
