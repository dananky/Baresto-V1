<style type="text/css">
    .required_star{
        color: #dd4b39;
    }
    .radio_button_problem{
        margin-bottom: 19px;
    }
</style> 

<section class="content-header">
    <h1>
        <?php echo ('Add Discount'); ?>
    </h1>  
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary"> 
                <?php echo form_open(base_url('discount/addEditDiscount')); ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?php echo ('Discount Name'); ?> <span class="required_star">*</span></label>
                                <input tabindex="1" type="text" name="discount_name" class="form-control" placeholder="<?php echo lang('discount_name'); ?>" value="<?php echo set_value('discount_name'); ?>">
                            </div>
                            <?php if (form_error('discount_name')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('discount_name'); ?></p>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?php echo lang('amount'); ?> <span class="required_star">*</span> </label>
                                <input tabindex="2" type="text" name="amount" class="form-control" placeholder="<?php echo lang('amount'); ?>" value="<?php echo set_value('amount'); ?>">
                            </div>
                            <?php if (form_error('amount')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('amount'); ?></p>
                                </div>
                            <?php } ?>  
                        </div>

                        <div class="col-sm-5">
                            <div class="form-group"><br>
                            <div class="btn-group btn-toggle" data-toggle="buttons">
                                <label class="btn btn-primary active">
                                  <input type="radio" id="option-0" name="price" value="Rp" checked="checked">Rp.</label>
                                <label class="btn btn-default">
                                  <input type="radio" id="option-1" name="price" value="%">%</label>
                              </div>
                            </div>
                            <div class="btn-group btn-toggle" data-toggle="buttons">
                                <label class="btn btn-primary active">
                                  <input type="radio" id="option-0" name="status" value="Items" checked="checked"> Items </label>
                                <label class="btn btn-default">
                                  <input type="radio" id="option-1" name="status" value="All-items"> All Items </label>
                            </div>
                        </div> 

                    </div>
                </div>
                <script>

                $('.btn-toggle').click(function() {
                    $(this).find('.btn').toggleClass('active');  
                    
                    if ($(this).find('.btn-primary').length>0) {
                        $(this).find('.btn').toggleClass('btn-primary');
                    }
                    if ($(this).find('.btn-danger').length>0) {
                        $(this).find('.btn').toggleClass('btn-danger');
                    }
                    if ($(this).find('.btn-success').length>0) {
                        $(this).find('.btn').toggleClass('btn-success');
                    }
                    if ($(this).find('.btn-info').length>0) {
                        $(this).find('.btn').toggleClass('btn-info');
                    }
                    
                    $(this).find('.btn').toggleClass('btn-default');
                       
                });
                              
                </script>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary"><?php echo lang('submit'); ?></button>
                    <a href="<?php echo base_url() ?>Discount/discount"><button type="button" class="btn btn-primary"><?php echo lang('back'); ?></button></a>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

</section>