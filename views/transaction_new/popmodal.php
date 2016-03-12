<script type="text/javascript">
	function get_quantity(type){
		
		var i_qty_popmodal = document.getElementById("i_qty_popmodal").value;
	
		if(type == 1){
			new_data = parseFloat(i_qty_popmodal) + 1;
		}else{
			if(i_qty_popmodal != 1){
				new_data = i_qty_popmodal - 1;
			}else{
				new_data = 1;
			}
		}
		
		document.getElementByName("i_qty_popmodal").value = "99";
		//alert(new_data);
	}
</script>

<div class="box-body">
<div class="row">
<div class="col-md-8">                                    
	<div class="popmodal_title"><?= $menu_name ?></div>                     
</div>
<div class="col-md-4"> 
                                   
	<!--<div class="col-md-3">                                    
		<a href="#" onclick="get_quantity(2)"><div class="btn btn-danger button_popmodal"><i class="fa fa-minus"></i></div></a>	
    </div>-->
                                       
		  <input type="text" class="form-control text_popmodal" value="1" name="i_qty_popmodal" id="i_qty_popmodal"  />
      <input type="hidden" class="form-control" value="<?= $menu_id ?>" name="i_menu_id_popmodal" id="i_menu_id_popmodal"  />
    <!--
    <div class="col-md-3">                                    
	
        <a href="#" onclick="get_quantity(1)"><div class="btn btn-success button_popmodal"><i class="fa fa-plus"></i></div></a>
    </div>
    -->	                     
</div>
</div>
                                    <?php
                                        $query_note_category = mysql_query("select * from note_categories order by note_category_id");
                                        while($row_note_category = mysql_fetch_array($query_note_category)){

                                        ?>
                                       

                                        <div class="col-md-3">
                                        <div class="row">


                                        <div class="form-group note_frame">
                                            <legend><?= $row_note_category['note_category_name']?></legend>
                                           
                                             <div id="donate">
                                             <?php
                                             $active = 0;

                                            $query_note = mysql_query("select * from notes where note_category_id = '".$row_note_category['note_category_id']."' order by note_id");
                                            while($row_note = mysql_fetch_array($query_note)){
                                             
                                              switch($row_note_category['note_category_id']){
                                                 case 1: $background_color= "#8ed0e1"; break;
                                                 case 2: $background_color= "#7edd8d"; break;
                                                 case 3: $background_color= "#f7b065"; break;
                                                 case 4: $background_color= "#d891ef"; break;
                                              }

                                              
                                                $checked = '';
                                           

                                              

                                            ?>  
                                          <label class="blue" style="background-color: <?= $background_color ?>">
                                             <input style="display:none;"  type="radio" name="i_note_<?= $row_note_category['note_category_id'] ?>" value="<?= $row_note['note_id'] ?>" <?= $checked ?>/>
                                            <span  onclick="get_change(<?= $row_note['note_id']?>, <?= $row_note_category['note_category_id'] ?>)" id="i_span_<?= $row_note['note_id']?>" class="i_span_<?= $row_note_category['note_category_id']?>"><?= $row_note['note_name'] ?>
                                            </span>
                                          </label>
                                              <?php
                                              }

                                              ?>
                                            </div>
                                           
                                        </div>
                                        </div>
                                      </div>
                                        <?php
                                        }
                                        ?>
                                      
                                      <br>
                                      <div class="row">
                                        <div class="col-md-12">
                                        <label>Keterangan</label>
                                        <div class="form-group">  
                                             <textarea class="form-control" rows="10" name="i_desc" ></textarea>
                                            </div>
                                          </div>
                                      </div>
                                        
                                       
                                        <div style="clear:both;"></div>
                                     
                                </div><!-- /.box-body -->