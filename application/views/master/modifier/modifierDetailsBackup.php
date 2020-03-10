<style type="text/css"> 
    .field_value{
        font-size: 16px;
        font-style: italic;
    }
</style> 

<section class="content-header">
    <h1>
        Modifier Details
    </h1>  
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary"> 
                <!-- form start --> 
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4"> 
                            <div class="form-group">
                                <h3>Name</h3>
                                <p class=""><?php echo $food_menu_details->name; ?></p>
                            </div> 
                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <h3>Price</h3>
                                <p class=""> <?php echo $this->session->userdata('currency'); ?> <?php echo $food_menu_details->price; ?></p>
                            </div>
                        </div> 
                        <div class="col-md-4">
                            <div class="form-group">
                                <h3>Description</h3>
                                <p class=""><?php echo $food_menu_details->description; ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="row"> 
                        <div class="col-md-12">
                            <div class="form-group"> 
                                <h3>Ingredient Consumptions</h3> 
                            </div>  
                        </div>  
                    </div>  

                    <?php $food_menu_ingredients = modifierIngredients($food_menu_details->id); ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive" id="ingredient_consumption_table">          
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Ingredient</th>
                                            <th>Consumption</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        if ($food_menu_ingredients && !empty($food_menu_ingredients)) {
                                            foreach ($food_menu_ingredients as $fmi) {
                                                $i++;
                                                echo "<tr>" .
                                                "<td style='width: 12%; padding-left: 10px;'><p>" . $i . "</p></td>" .
                                                "<td style='width: 23%'><span style='padding-bottom: 5px;'>" . getIngredientNameById($fmi->ingredient_id) . "</span></td>" .
                                                "<td style='width: 30%'>" . $fmi->consumption . " " . unitName(getUnitIdByIgId($fmi->ingredient_id)) . "</td>" .
                                                "</tr>";
                                            }
                                        }
                                        ?>  
                                    </tbody>
                                </table>
                            </div>

                        </div> 
                    </div> 
                </div>
                <!-- /.box-body -->

                <div class="box-footer"> 
                    <a href="<?php echo base_url() ?>Master/addEditModifier/<?php echo $encrypted_id; ?>"><button type="button" class="btn btn-primary">Edit</button></a>
                    <a href="<?php echo base_url() ?>Master/modifiers"><button type="button" class="btn btn-primary">Back</button></a>
                </div> 
            </div>
        </div>
    </div>
</section>