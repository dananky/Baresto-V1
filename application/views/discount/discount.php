 <script type="text/javascript">  
    var ingredient_id_container = [];

    $(function () {
        $('.select2').select2();
    })
</script>

<?php
if ($this->session->flashdata('exception')) {

    echo '<section class="content-header"><div class="alert alert-success alert-dismissible"> 
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p><i class="icon fa fa-check"></i>';
    echo $this->session->flashdata('exception');
    echo '</p></div></section>';
}
?> 

<style type="text/css">
    .top-left-header{
        margin-top: 0px !important;
    }
</style>

<section class="content-header">
    <div class="row">
        <div class="col-md-6">
            <h2 class="top-left-header"><?php echo lang('discount'); ?> </h2>
        </div>
        <div class="col-md-offset-4 col-md-2">
            <a href="<?php echo base_url() ?>Discount/addEditDiscount"><button type="button" class="btn btn-block btn-primary pull-right"><?php echo ('add discount'); ?></button></a>
        </div>
    </div> 
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary"> 
                <div class="box-body table-responsive"> 
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 1%"><?php echo lang('no'); ?></th>
                                <th style="width: 11%"><?php echo('Discount Name'); ?></th>
                                <th style="width: 8%"><?php echo lang('amount'); ?></th>
                                <th style="width: 15%"><?php echo ('price'); ?></th>
                                <th style="width: 15%"><?php echo ('status'); ?></th>
                                <th style="width: 12%"><?php echo lang('added_by'); ?></th>
                                <th style="width: 6%"><?php echo lang('actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($discount && !empty($discount)) {
                                $i = count($discount);
                            }
                            foreach ($discount as $disc) {
                                ?>                       
                                <tr> 
                                    <td style="text-align: center"><?php echo $i--; ?></td>
                                    <td><?php echo $disc->discount_name; ?></td>  
                                    <td><?php echo $disc->amount; ?></td>  
                                    <td><?php echo $disc->price; ?></td>  
                                    <td><?php echo $disc->status; ?></td>
                                    <td><?php echo userName($disc->user_id); ?></td>  
                                    <td style="text-align: center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-gear tiny-icon"></i><span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right" role="menu"> 
                                                <li><a href="<?php echo base_url() ?>discount/addEditDiscount/<?php echo $this->custom->encrypt_decrypt($disc->id, 'encrypt'); ?>" ><i class="fa fa-pencil tiny-icon"></i><?php echo lang('edit'); ?></a></li>
                                                <li><a class="delete" href="<?php echo base_url() ?>discount/deleteDiscount/<?php echo $this->custom->encrypt_decrypt($disc->id, 'encrypt'); ?>" ><i class="fa fa-trash tiny-icon"></i><?php echo lang('delete'); ?></a></li> 
                                            </ul> 
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?> 
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><?php echo lang('no'); ?></th>
                                <th><?php echo ('Discount Name'); ?></th>
                                <th><?php echo lang('amount'); ?></th>
                                <th><?php echo ('price'); ?></th> 
                                <th><?php echo lang('added_by'); ?></th>  
                                <th><?php echo lang('actions'); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div> 
        </div> 
    </div> 
</section>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<script>
    $(function () { 
        $('#datatable').DataTable({ 
            'autoWidth'   : false,
            'ordering'    : false
        })
    })
</script>
