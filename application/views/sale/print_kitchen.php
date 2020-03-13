<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Print Kitchen</title>
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


                            <br></p>
                    </div>

                    <?php
                        $id = explode(",", $_GET['id']);

                        foreach ($id as $previous_id) {
                            $print = $this->Kitchen_model->print_kitchen($previous_id);
                            $sales_id = $print->sales_id;
                            echo($previous_id);
                            $modifiers = $this->Kitchen_model->getModifiersBySaleAndSaleDetailsId($sales_id,$previous_id);
                            $items_by_sales_id = $this->Kitchen_model->getAllKitchenItemsFromSalesDetailBySalesId2($sales_id,$previous_id);
                            $menu_note = "";
                            foreach($items_by_sales_id as $sales_details){
                                $menu_note = $sales_details->menu_note;
                            }
                            $modifiers_length = count($modifiers);
                            $w = 1;
                            $modifiers_name = '';
                            foreach($modifiers as $single_modifier){
                                if($w==$modifiers_length){
                                    $modifiers_name .= $single_modifier->name;
                                }else{
                                    $modifiers_name .= $single_modifier->name.', ';
                                }
                                $w++; 
                            }
                            $table_order = $this->Sale_model->get_all_tables_of_a_sale_items($print->sales_id);
			    
                    ?>

                    <p>No. Order: <?php echo $print->sale_no; ?><br>
                      Date: <?php echo date($this->session->userdata('date_format'), strtotime($print->sale_date)); ?> <?= date('H:i',strtotime($print->order_time)) ?><br>
                        Customer: <?php echo $print->customer_name; ?><br>

                        <?php
                            $tables_booked = '';
                            if(count($table_order)>0){
                                $w = 1;
                                foreach($table_order as $single_table_booked){
                                    if($w == count($table_order)){
                                        $tables_booked .= $single_table_booked->table_name;
                                    }else{
                                        $tables_booked .= $single_table_booked->table_name.', ';
                                    }
                                    $w++;
                                }
                            }else{
                                $tables_booked = 'None';
                            }
                        ?>
                        Table Name : <?php echo "$tables_booked"; ?>
                    </p>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td><?php echo $print->menu_name; ?></td>
                            <td><?php echo "X $print->qty"; ?></td>
                        </tr>
                        <?php if($modifiers_name != "") {?>
                            <tr style="font-size:11px;">
                                <td colspan="2"><?php echo $modifiers_name ?></td>
                            </tr>
                        <?php } ?>
                        <?php if($menu_note != "") {?>
                            <tr style="font-size:11px;">
                                <td colspan="2"><?php echo $menu_note ?></td>
                            </tr>
                        <?php } ?>
                  </table>


                  <?php } ?>

                </div>
                <div style="clear:both;"></div>
            </div>

            <!-- <div id="buttons" style="padding-top:10px; text-transform:uppercase;" class="no-print">
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
        <script src="<?php echo base_url(); ?>assets/dist/js/print/jquery-2.0.3.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/js/print/custom.js"></script>
        <script type="text/javascript">

        // print struk
        function chr(x){
        	return String.fromCharCode(x);
        }
        // symbolic
        var ESC = chr(27);
        var LF = chr(10);
        var TAB = chr(9);

        // user friendly command name
        var PrnAlignLeft = ESC+'a'+chr(0);
        var PrnAlignCenter = ESC+'a'+chr(1);
        var PrnAlignRight = ESC+'a'+chr(2);
        var PrnBoldOn = ESC+'G'+chr(1);
        var PrnBoldOff = ESC+'G'+chr(0);


        // send to print
        function BtPrint(prn){
            var S = "#Intent;scheme=rawbt;";
            var P =  "package=ru.a402d.rawbtprinter;end;";
            var textEncoded = encodeURI(prn);
            window.location.href="intent:"+textEncoded+S+P;
        }
        slip()
        // demo document
        function slip(){

            // data=JSON.parse(data);
            // собираем чек
            var prn = '';
            prn += PrnAlignCenter;
            prn += PrnBoldOn+'<?php echo $this->session->userdata('outlet_name'); ?>'+PrnBoldOff+LF;
            prn += '<?php echo $this->session->userdata('address'); ?>'+LF;
            prn += 'Tel: <?php echo $this->session->userdata('phone'); ?>'+LF+LF;

            <?php
                // $id = explode(",", $_GET['id']);

                foreach ($id as $previous_id) {
                    $print = $this->Kitchen_model->print_kitchen($previous_id);
                    $table_order = $this->Sale_model->get_all_tables_of_a_sale_items($print->sales_id);

                    $tables_booked = '';
                    if(count($table_order)>0){
                        $w = 1;
                        foreach($table_order as $single_table_booked){
                            if($w == count($table_order)){
                                $tables_booked .= $single_table_booked->table_name;
                            }else{
                                $tables_booked .= $single_table_booked->table_name.', ';
                            }
                            $w++;
                        }
                    }else{
                        $tables_booked = 'None';
                    }
            ?>

            prn += PrnAlignCenter;
            prn += 'Order Numb. :'+PrnBoldOn+'<?php echo "$print->sale_no"; ?>'+PrnBoldOff+LF;
            prn += 'Date : <?php echo date($this->session->userdata('date_format'), strtotime($print->sale_date)); ?> <?= date('H:i',strtotime($print->order_time)) ?>'+LF;
            prn += PrnAlignLeft;
            prn += '--------------------------------'+LF;
            prn += PrnAlignRight;
            prn += 'Customer :'+PrnBoldOn+'<?php echo "$print->customer_name"; ?>'+PrnBoldOff+LF;
            prn += 'Table Name :  <?php echo "$tables_booked"; ?>'+LF;

            prn += PrnAlignLeft;
            prn += '--------------------------------'+LF;
            prn += PrnAlignLeft+ '<?php echo $print->menu_name; ?> '+TAB+'<?php echo "X $print->qty"; ?>'+LF;
            prn += PrnAlignLeft+ '<?php echo $print->modifiers_name; ?> '+LF;
            prn += PrnAlignLeft+ '<?php echo $print->menu_note; ?> '+LF;

            prn += PrnAlignLeft;
            prn += '--------------------------------'+LF;

                <?php } ?>

            prn += LF;

            prn += 'Selamat Bekerja!'+LF;
            prn += LF;

            // prn += PrnAlignCenter;
            // prn += QrCode('t=20171016T201109&s=7300.00&fn=0149060506089651&i=3&fp=846945255&n=1')+LF;
            // передаем на печать
            BtPrint(prn);


        }
        </script>
    </body>
</html>
