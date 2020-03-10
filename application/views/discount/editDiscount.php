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
       <?php echo ('Edit Discount'); ?>
    </h1>  
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary"> 
                <?php echo form_open(base_url('Discount/addEditDiscount/' . $encrypted_id)); ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?php echo ('Discount Name'); ?> <span class="required_star">*</span></label>
                                <input tabindex="1" type="text" name="discount_name" class="form-control" placeholder="<?php echo lang('discount_name'); ?>" value="<?php echo $category_information->discount_name; ?>">
                            </div>
                            <?php if (form_error('discount_name')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('discount_name'); ?></p>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?php echo lang('amount'); ?></label>
                                <input tabindex="2" type="text" name="amount" class="form-control" placeholder="<?php echo lang('amount'); ?>" value="<?php echo $category_information->amount; ?>">
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
                                  <input type="radio" id="option-0" name="options" value="Rp" checked="checked">Rp.</label>
                                <label class="btn btn-default">
                                  <input type="radio" id="option-1" name="options" value="%">%</label>
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
                <div class="box-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary"><?php echo lang('submit'); ?></button>
                    <a href="<?php echo base_url() ?>discount/discount"><button type="button" class="btn btn-primary"><?php echo lang('back'); ?></button></a>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section>