 <!-- Begin Page Content -->
 <div class="container-fluid">

 <div class="card shadow mb-4">
         <div class="card-header py-3" style="display:flex;align-items: center;justify-content:space-between;">
             <h6 class="m-0 font-weight-bold text-primary">Room Assign: <?php echo $booking_code;?></h6>
             <a id="go_back_button" href="javascript:GoBack()" class="btn btn-primary btn-icon-split btn-sm">
                 <span class="icon text-white-50">
                     <i class="fas fa-chevron-left"></i>
                 </span>
                 <span class="text">GO Back</span>
             </a>
         </div>
         <div class="card-body">



             <!-- Left Column-->

             <div class="col-lg-6">



                 <form action="<?= base_url('admin/bookings/selectRooms') ?>" method="post" class="user" onsubmit="return ValidateSelection()">

                 <input type = "hidden" name="booking_code" value="<?= $booking_code; ?>">
                 <input type = "hidden" name="row_id" value="<?= $row_id; ?>">
      

                     <div class="form-group row">
                         <label>Select <?php  echo $no_rooms. '  room' ?> </label>

                         <select id="userRequest_activity" class="form-control" name="r_number[]" multiple="multiple">
                    <?php 


                    $this->db = \Config\Database::connect();  

                    $builder2 = $this->db->table('rooms');
                    $builder2->where('cat_id', $cat_id);
                    $builder2->where('status', 'available');
                    $rowData = $builder2->get()->getResultArray();

                    foreach($rowData as $row){

                        $r_id = $row['room_id'];
                        $number = $row['room_no'];
                       
                        echo "<option value='{$r_id}'>$number</option>";



                    }


                    ?>

                    </select>
                     </div>
                     <hr>
                     <button style="width:50%!important;" class="btn btn-primary btn-block" type="submit" name="assign_room">Assign</button>
                     <hr>

                 </form>

                 <hr>
                 <p>
                     <emphasis>*Note: Hold Ctrl and click to select multiple rooms</emphasis>
                 </p>
             </div>

         </div>
     </div>
 </div>
 <!--Container Fluid-->

 <script>
     function GoBack() {
         history.back();
     }

 </script>

<script type="text/javascript">
     $(document).ready(function() {
         var last_valid_selection = null;
         $('#userRequest_activity').change(function(event) {
             if ($(this).val().length > <?php echo $no_rooms; ?>) {
                 $(this).val(last_valid_selection);
                 alert("Cannot Select More than <?php echo $no_rooms ?> Rooms");
             } else {
                 last_valid_selection = $(this).val();
             }
         });
     });

 </script>


 <script type="text/javascript">
     function ValidateSelection() {


         var opts = $('#userRequest_activity option:selected').length;

         if (opts == "") {
             alert("<?php echo "Please select rooms";?>");
             return false;
         }

         if (opts != <?php echo $no_rooms; ?>) {
             alert("<?php echo "Please select more rooms";?>");
             return false;
         }

         return true;
     }

 </script>