<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <title>Invoice No: <?= $sale_object->sale_no ?></title>
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="pragma" content="no-cache" />
    <script src="/cdn-cgi/apps/head/Bx0hUCX-YaUCcleOh3fM_NqlPrk.js"></script>
    <link rel="stylesheet" href="theme.css" type="text/css" />
    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="print.css" type="text/css" />
    <style type="text/css" media="all">
    body { color: #000; }
    #wrapper { max-width: 480px; margin: 0 auto; padding-top: 20px; }
    .btn { border-radius: 0; margin-bottom: 5px; }
    .bootbox .modal-footer { border-top: 0; text-align: center; }
    h3 { margin: 5px 0; }
    .order_barcodes img { float: none !important; margin-top: 5px; }
    @media print {
        .no-print { display: none; }
        #wrapper { max-width: 480px; width: 100%; min-width: 250px; margin: 0 auto; }
        .no-border { border: none !important; }
        .border-bottom { border-bottom: 1px solid #ddd !important; }
        table tfoot { display: table-row-group; }
    }
</style>
</head>
<body>
    <div id="wrapper">
        <div id="receiptData">

            <div id="receipt-data">
                <div class="text-center">
                    <h3>
                        <?php echo $this->session->userdata('outlet_name'); ?>
                    </h3>
                    <p><?php echo $this->session->userdata('address'); ?>
                    <br>
                    Tel: <?php echo $this->session->userdata('phone'); ?>

                    <?php
                    if ($this->session->userdata['tax_registration_no'] && $this->session->userdata('collect_tax')=='Yes'):
                        ?>
                        <br>
                        Tax Registration No: <?php
                        echo $this->session->userdata('tax_registration_no');
                    endif;
                    ?>

                    <?= isset($sale_object->token_no) && $sale_object->token_no ? "Token No: " . $sale_object->token_no : '' ?>
                    <br>
                    <?php 
                    $order_type = '';
                    if($sale_object->order_type == 1){
                        $order_type = 'A';
                    }elseif($sale_object->order_type == 2){
                        $order_type = 'B';
                    }elseif($sale_object->order_type == 3){
                        $order_type = 'C';
                    }
                    ?>
                    Invoice No: <?= $order_type.' '.$sale_object->sale_no ?>
                    <br></p>
                </div>

                <div style="border-bottom:3px dashed #000; "></div>
                <div style="padding-top:10px">
                    <p >Date: <?= date($this->session->userdata('date_format'), strtotime($sale_object->sale_date)); ?> <?= date('H:i',strtotime($sale_object->order_time)) ?><br>
                        Sales Associate: <?php echo $sale_object->user_name; ?><br>
                        Customer: <?php echo "$sale_object->customer_name"; ?>
                    </p>
                </div>
                <div style="border-bottom:3px dashed #000;"></div>
                
                <div style="clear:both;"></div>
                <table class="table table-condensed">
                    <tbody>
                        <?php
                        if (isset($sale_object->items)) {
                            $i = 1;
                            $totalItems = 0;
                            foreach ($sale_object->items as $row) {
                                $totalItems+=$row->qty;

                                ?>
                                <tr><td colspan="2" class="no-border">
                                    # <?php echo $i++; ?>: &nbsp;&nbsp;<?php echo $row->menu_name; ?>
                                    <span class="pull-right"></span>
                                </td>
                            </tr>

                            <tr>
                                <td class="no-border border-bottom">(CODE:<?php echo $row->code; ?>)
                                    <small></small> <?php echo "$row->qty X $row->menu_unit_price"; ?> </td>
                                    <td class="no-border border-bottom text-right"><?php echo $this->session->userdata('currency') . " " . $row->menu_price_without_discount; ?></td>
                                </tr>
                                <?php if(count($row->modifiers)>0){ ?>
                                    <tr>
                                        <td class="no-border border-bottom">Modifier:
                                            <small></small>
                                            <?php
                                            $l = 1;
                                            $modifier_price = 0;
                                            foreach($row->modifiers as $modifier){
                                                if($l==count($row->modifiers)){
                                                    echo $modifier->name;
                                                }else{
                                                    echo $modifier->name.',';
                                                }
                                                $modifier_price+=$modifier->modifier_price;
                                                $l++;
                                            }
                                            ?>
                                        </td>
                                        <td class="no-border border-bottom text-right"><?php echo $this->session->userdata('currency') . " " . $modifier_price; ?></td>
                                    </tr>
                                <?php } ?>
                            <?php }
                        }
                        ?>

                    </tbody>

                    <tfoot>
                     <tr>
                         <th style="border-bottom:3px dashed #000; "></th>
                         <th style="border-bottom:3px dashed #000; "></th>
                     </tr>   
                     <tr>
                        <th>Total Item(s) &nbsp;: <?= $totalItems ?></th>
                        <th style="text-align:left "></th>
                    </tr>
                    <tr>
                        <th class="text-right" width="370">Sub Total &nbsp;:</th>
                        <th class="text-right"><?php echo $this->session->userdata('currency') . " " . number_format($sale_object->sub_total, 2); ?></th>
                    </tr>
                    <th class="text-right" width="370">Disc Amt (%) &nbsp;:</th>
                    <th class="text-right"><?php echo $this->session->userdata('currency') . " " . $sale_object->total_discount_amount; ?></th>
                </tr>
                <th class="text-right" width="370">Service/Delivery Charge &nbsp;:</th>
                <th class="text-right"><?php echo $this->session->userdata('currency') . " " . $sale_object->delivery_charge; ?></th>
            </tr>
            <?php
            if ($this->session->userdata('collect_tax')=='Yes' && $sale_object->sale_vat_objects!=NULL):
                ?>
                <?php foreach(json_decode($sale_object->sale_vat_objects) as $single_tax){ ?>
                    <tr>
                        <th class="text-right" width="370"><?php echo $single_tax->tax_field_type; ?></th>
                        <th class="text-right"><?php echo $this->session->userdata('currency') . " " . number_format($single_tax->tax_field_amount, 2); ?></th>
                    </tr>
                <?php } ?>

                <?php
            endif;
            ?>
            <tr>
                <th class="text-right" width="370">Grand Total &nbsp;:</th>
                <th class="text-right"><?php echo $this->session->userdata('currency') . " " . number_format($sale_object->total_payable, 2); ?></th>
            </tr>
                        <!-- <tr>
                            <th>Paid Amount</th>
                            <th class="text-right"><?php echo $this->session->userdata('currency') . " " . number_format($sale_object->paid_amount, 2); ?></th>
                        </tr> -->
                        <tr>
                            <th class="text-right" width="370">Cash &nbsp;:</th>
                            <th class="text-right"><?php echo $this->session->userdata('currency') . " " . number_format($sale_object->given_amount, 2); ?></th>
                        </tr>
                        <tr>
                            <th class="text-right" width="370">Change Amount &nbsp;:</th>
                            <th class="text-right"><?php echo $this->session->userdata('currency') . " " . number_format($sale_object->change_amount, 2); ?></th>
                        </tr>
                       <!--  <tr>
                            <th>Due Amount</th>
                            <th class="text-right"><?php echo $this->session->userdata('currency') . " " . number_format($sale_object->due_amount, 2); ?></th>
                        </tr>
                    -->
                </tfoot>
            </table>
            <div style="border-bottom:3px dashed #000;"></div>
            <table class="table table-striped table-condensed"><tbody>
                           <!--  <tr>
                                <td>&nbsp;</td>
                                <td style="text-align: right"><?php echo $this->session->userdata('currency') . " " . number_format($sale_object->total_payable, 2); ?></td>
                            </tr> -->
                        </tbody>
                    </table>
                    <p class="text-center"> <?php echo $sale_object->invoice_footer; ?></p>

                </div>
                <div style="clear:both;"></div>
            </div>
          <!--   
            <div id="buttons" style="padding-top:10px; text-transform:uppercase;" class="no-print">
                <hr>

                <span class="pull-right col-xs-12">
                    <button onclick="window.print();" class="btn btn-block btn-primary">Print</button> </span>
                <div style="clear:both;"></div>
                <div class="col-xs-12" style="background:#F5F5F5; padding:10px;">
                    <p style="font-weight:bold;">
                        Please don't forget to disble the header and footer in browser print settings.
                    </p>
                    <p style="text-transform: capitalize;">
                        <strong>FF:</strong> File &gt; Print Setup &gt; Margin &amp; Header/Footer Make all --blank--
                    </p>
                    <p style="text-transform: capitalize;">
                        <strong>chrome:</strong> Menu &gt; Print &gt; Disable Header/Footer in Option &amp; Set Margins to None
                    </p>
                </div>
                <div style="clear:both;"></div>
            </div> -->
        </div>
        <script >
            // window.print();
        </script>
        <script src="<?php echo base_url(); ?>assets/dist/js/print/jquery-1.6.4.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/js/print/epos-2.0.0.js"></script>
        <script type="text/javascript">
        
        printReceipt();
        function getTimestamp() {
        	var now = new Date();
        	var year = now.getYear();
        	if (year < 2000) {
        		year += 1900;
        	}
        	var month = now.getMonth() + 1;
        	var mstr='Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec';
        	month = mstr.split(',')[month];
        	var date = now.getDate();
        	if (date < 10) {
        		date = "0" + date;
        	}
        	var hour = now.getHours();
        	if (hour < 10) {
        		hour = "0" + hour;
        	}
        	var minute = now.getMinutes();
        	if (minute < 10) {
        		minute = "0" + minute;
        	}
        	var second = now.getSeconds();
        	if (second < 10) {
        		second = "0" + second;
        	}
        	return "" + month + "-" + date + "-" + year + " " + hour + ":" + minute + ":" + second;
        }

        function printReceipt() {
            // if (order.length == 0) {
            //     $('#empty').dialog('open');
            //     return;
            // }
        
            // open printing dialog
            // $('#send').dialog('open');
        
            var builder = new epson.ePOSBuilder();
            builder.addTextLang('ja').addTextSmooth(true);
        
            // header
            builder.addTextAlign(builder.ALIGN_CENTER);
            
            builder.addText('Thank you for shopping\n');
            builder.addText(getTimestamp() + '\n');
            builder.addTextAlign(builder.ALIGN_LEFT);
            builder.addFeedUnit(12);
        
            // items
            // var l_total = 0;
            // var r_total = 0;
            // for (var i = 0; i < order.length; i++) {
            //     builder.addText(order[i].item_name).addTextPosition(400).addText(toPrice8(order[i].price) + '\n');
            //     var sep = order[i].price.split(".");
            //     l_total += parseInt(sep[0]);
            //     r_total += parseInt(sep[1]);
            // }
            // l_total += Math.floor(r_total/100);
            // r_total = (r_total%100);
            // builder.addText('\n');
        
            // footer
            // builder.addTextSize(2, 1).addText('Amount').addTextPosition(320).addText(toPrice8(l_total+'.'+r_total) + '\n');
            // builder.addTextSize(1, 1).addText('\t\t' + order.length + ' items\t' + ('0000' + sequence).slice(-4) + '\n');
            // builder.addFeedUnit(24);
            // builder.addCut(builder.CUT_FEED);
        
            // send to printer
            var epos = new epson.ePOSPrint();
            epos.address = 'https://192.168.192.168/cgi-bin/epos/service.cgi?devid=local_printer&timeout=10000';
            epos.onreceive = function (res) {
                // $('#send').dialog('close');
                // if (!res.success) {
                //     $('#receive').dialog('open');
                //     return;
                // }
                clearAllLine();
            }
            epos.onerror = function (err) {
                // $('#send').dialog('close');
                // $('#error').dialog('open');
                console.log(err)
            }
            epos.send(builder.toString());
            sequence++;
        }
        
        function toPrice8(val) {
            return ('       $' + val).slice(-8);
        }


        

        </script>
    </body>
    </html>
