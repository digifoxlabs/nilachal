 <!-- Why choose us-->
 <section class="section section-sm section-first bg-default text-md-left">
              <div class="container">
                  <div class="row row-50 justify-content-center align-items-xl-center">  

                      <div class="col-md-10 col-lg-10 col-xl-10">
                          <h3 class="text-spacing-25 font-weight-normal title-opacity-2">Welcome <?php echo $clientName; ?> </h3>
                          <!-- Bootstrap tabs-->
                          <div class="tabs-custom tabs-horizontal tabs-line" id="tabs-4">
                              <!-- Nav tabs-->
                              <ul class="nav nav-tabs">
                                  <li class="nav-item" role="presentation"><a class="nav-link active " href="#tabs-4-1" data-toggle="tab">Booking History</a></li>
                                  <li class="nav-item" role="presentation">
                                      
                                      <div class="group-md group-middle justify-content-sm-start"><a class="button button-sm button-primary button-ujarak" href="<?= base_url('/bookings') ?>">Book A Room</a></div>
                                  
                                  </li>
                              
                              </ul>
                              <!-- Tab panes-->
                              <div class="tab-content">
                                  
                                  <div class="tab-pane fade show active" id="tabs-4-1">                                 
                                        <div class="table-responsive">
                                          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                              <thead>
                                                  <tr>
                                                      <th>Booking ID</th>
                                                      <th>Check In</th>
                                                      <th>Check Out</th>
                                                      <th>Total Amount</th>
                                                      <th>Paid Amount</th>
                                                      <th>Status</th>
                                                      <th>Invoice</th>
                                                  </tr>
                                              </thead>
                                              <tbody>

                                              <?php foreach($clientBookings as $booking): ?>

                                                    <tr>

                                                        <td><?php echo $booking['booking_code'];  ?></td>
                                                        <td><?php echo $booking['check_in'];  ?></td>
                                                        <td><?php echo $booking['check_out'];  ?>  </td>
                                                        <td><?php echo $booking['total_amt'];  ?></td>
                                                        <td><?php echo $booking['amt_paid']; ?></td>
                                                        <td><?php echo $booking['booking_status']; ?></td>
                                                        <td>INVOICE</td>

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
        </div>                                 
  </section>