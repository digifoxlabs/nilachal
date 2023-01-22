<script>
   
  $(document).ready(function() {
   var calendar = $('#calendar1').fullCalendar({
    editable:true,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek'
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

         <div class="col-lg-8">
             
                <!-- Dropdown Card Example -->
           <div class="card shadow mb-4">
             <!-- Card Header - Dropdown -->
             <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
               <h6 class="m-0 font-weight-bold text-primary">Showing All Bookings</h6>
               <div class="dropdown no-arrow">
                 <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                 </a>
                 <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">                     
                   <a class="dropdown-item" href="#">Action</a>                 
                 </div>
               </div>
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
         </div>
         
      
         

     </div>
     <!-- /.container-fluid -->