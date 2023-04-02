
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Transactions</h1>
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

            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr style="text-align:center;">
                            <th width="5%">Sl. No.</th>
                            <th>Txn ID</th>
                            <th>Amount</th>                           
                            <th>Guest</th>                           
                            <th>Contact</th>                           
                            <th>Dated</th>                           
                            <th>Mode</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $count = 0;
                        foreach ($transactions as $list) :                        

                        ?>
                            <tr style="text-align:center;">
                                <td><?php echo ++$count; ?></td>
                                <td><?php echo strtoupper($list['transaction_id']); ?></td>
                                <td><?php echo $list['amount']; ?></td>
                                <td><?php echo $list['name']; ?></td>
                                <td><?php echo $list['phone']; ?></td>
                               
                                <td><?= $list['created_at']; ?></td>
                                <td style="text-align:center;">
                                    <?= $list['hash']; ?>
                                </td>
                                <td style="text-align:center;">
                                    <?= $list['product_info']; ?>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>



    </div>

    </div>


<script>
$(document).ready(function() {
    
    $("#transactionMenu").addClass('active'); 

});

</script>   