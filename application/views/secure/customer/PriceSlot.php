<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><a href="javascript:window.history.back();"><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold">
                            <a href="<?=base_url('dashboard');?>">Dashboard</a></span> - 
                            <a href="<?=base_url($this->uri->segment(2));?>"><?=ucfirst($this->uri->segment(2));?></a></h4>
						</div>

						
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="<?=base_url('dashboard');?>"><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="active"><a href="<?=base_url($this->uri->segment(2));?>"><?=ucfirst($this->uri->segment(2));?></a></li>
						</ul>

						
					</div>
				</div>
				<!-- /page header -->
<!-- Content area -->
				<div class="content">

					<!-- Horizontal form options -->
					<div class="row">
<div class="panel panel-flat">
							<div class="panel-heading">
								<h5 class="panel-title"></h5>
								<div class="heading-elements">
									<ul class="icons-list">
				                		<li><a data-action="collapse"></a></li>
				                		<li><a data-action="reload"></a></li>
				                		<li><a data-action="close"></a></li>
				                	</ul>
			                	</div>
							</div>

							<div class="panel-body">
                            <div id="the-slot"></div>
                        		<div id="the-slotData"></div>
								<div class="row">
									<div class="col-md-6">
                    		        
                             <div class="form-group col-md-12">
								<?php echo form_label('Loader'); ?>
                                <select class="form-control select2" name="loader_id" autofocus id="loader_id" onChange="getloaderslotd(this.value)">
                                <option value="">Select</option>
                                <?php foreach($loaderList as $item){?>
                                <option value="<?php echo $item['id'];?>"><?php echo $item['loader_name'];?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('loader_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                              
                        </div>
                        <div class="col-md-6">
                                
                        		<button class="btn btn-warning fa fa-plus" style="margin-top:4%" id="addRow">Add Slot</button>
                                
                        </div>
                                    <div class="col-md-12" style="overflow:scroll;">
										<fieldset>
						                	<legend class="text-semibold"> <?=ucfirst($this->uri->segment(2));?> List</legend>
                                            <input type="hidden" class="form-control" id="createIndex" value="0">
											<table cellpadding="10" cellspacing="10">
                      <thead>
                                              
                                              <th style="width:250px !important;">Slot Name</th>
                                              <th style="width:250px !important;">Doc Type</th>
                                              <th style="width:250px !important;">Amount/Percent</th>
                                              <th style="width:250px !important;">Doc Mode</th>
                                              <th style="width:200px;">From (Kg.)</th>
                                              <th style="width:200px;">To (Kg.)</th>
                                              <th style="width:200px;">Price (<i class="fa fa-inr text-primary" aria-hidden="true"></i>)</th>
                                              <th style="width:200px;">Additional (<i class="fa fa-inr text-primary" aria-hidden="true"></i>)</th>
                                              <th style="width:200px;">Additional (Kg.)</th>
                                              <th>Action</th>
                                           </thead>
                                		    <tbody>
												 
                                            </tbody>
                    </table>
                   <!-- <button  class="delete-row btn btn-danger">Delete Row</button>-->
										</fieldset>
									</div>
								</div>

								
							</div>
						</div>

</div>

</div>
<script>
 $(document).ready(function(e) {
	  $('#addRow').on('click',function(){
		  var i;
		  i = $('#createIndex').val();
		  var generatetable = '';
		  		generatetable = generatetable + "<tr id='rowId,"+i+"'>"+
				 
				  "<td> <input type='text' class='form-control' id='txt_"+i+","+0+"' > </td>"+  
				  "<td> <select class='form-control' onchange='doc("+i+")' id='thedoc"+i+"'>"+
				  			"<option value='1'>DOC</option>"+
							"<option value='2'>NON-DOC</option>"+
					  "</select>"+
					  "<input type='hidden' class='form-control' id='txt_"+i+","+6+"' value='1'>"+
				  "</td>"+ 
				   "<td> <select class='form-control' onchange='cal("+i+")' id='thecal"+i+"'>"+
				  			"<option value='1'>Amount</option>"+
							"<option value='2'>Percent</option>"+
					  "</select>"+
					  "<input type='hidden' class='form-control' id='txt_"+i+","+8+"' value='1'>"+
				  "</td>"+ 
				  "<td> <select class='form-control' onchange='mod("+i+")' id='themod"+i+"'>"+
				  				"<option>-Select-</option>"+
				  				"<?php foreach($modeData as $oneMode):?>
								  <option value='<?php echo $oneMode['id'];?>'> <?php echo $oneMode['mode_name'];?> </option> <?php endforeach;?>"+
						"</select>"+
					   "<input type='hidden' class='form-control' id='txt_"+i+","+7+"'>"+ 
				 "</td>"+
				 "<td> <input type='text' class='form-control' id='txt_"+i+","+1+"' > </td>"+
				 "<td> <input type='text' class='form-control' id='txt_"+i+","+2+"' > </td>"+
				 "<td> <input type='text' class='form-control' id='txt_"+i+","+3+"' > </td>"+
				 "<td> <input type='text' class='form-control' id='txt_"+i+","+4+"' > </td>"+
				 "<td> <input type='text' class='form-control' id='txt_"+i+","+5+"' > </td>"+ 
				 "<td> <input type='button' value='save' class='btn btn-primary' id='btnSave,"+i+"' onclick='insertOneRowData("+i+")' /><span id='ico"+i+"' style='font-size:22px;' ></span></td>"+
			"</tr>";
	  			$("table tbody").append(generatetable);
				i++;
				$('#createIndex').val(i);
	  });
	  
	   // Find and remove selected table rows
		$(".delete-row").click(function(){
			$("table tbody").find('input[name="record"]').each(function(){
				if($(this).is(":checked")){
					$(this).parents("tr").remove();
				}
			});
		});
		


});
function getloaderslotd(getId){
		   var generatetable = '';
				//var getId = $(this).val();
				if(getId){
						$.ajax({
							type:'POST',
							url:'<?php echo base_url('secure/loader/getPriceSlot');?>',
							data:'getId='+getId,
							dataType: 'json',
							success:function(data){
								$('#createIndex').val(0);
								if(data.length > 0){
									
									$('#createIndex').val(data.length);
									var modeId = new Array();
									var typeId = new Array();
									var calId = new Array();
									
									for(var x = 0 ; x < data.length ; x++){
												modeId[x] = data[x].docMode;
												typeId[x] = data[x].docType;
												calId[x] = data[x].calType;		
																
										generatetable = generatetable + "<tr id='rowId,"+x+"'>"+
												
												"<td><input type='text' class='form-control' id='txt_"+x+","+0+"' value='"+data[x].slotName+"' > </td>"+
												"<td><select class='form-control' onchange='doc("+x+")' id='thedoc"+x+"'>"+ 
															"<option value='1'>DOC</option>"+
															"<option value='2'>NON-DOC</option>"+
													"</select>"+
													"<input type='hidden' class='form-control' id='txt_"+x+","+6+"' value='"+data[x].docType+"' >"+
												"</td>"+
												"<td><select class='form-control' onchange='cal("+x+")' id='thecal"+x+"'>"+ 
															"<option value='1'>Amount</option>"+
															"<option value='2'>Percent</option>"+
													"</select>"+
													"<input type='hidden' class='form-control' id='txt_"+x+","+8+"' value='"+data[x].calType+"' >"+
												"</td>"+
												"<td> <select class='form-control modeset' onchange='mod("+x+")' id='themod"+x+"' > "+
															"<?php
															 foreach($modeData as $oneMode):?>
																<option value='<?php echo $oneMode['id'];?>'  >  <?php echo $oneMode['mode_name'];?> </option> <?php endforeach;?> "+
													"</select>"+ 
													"<input type='hidden' class='form-control myone' id='txt_"+x+","+7+"' value='"+data[x].docMode+"' > "+
												"</td>"+ 
												"<td> <input type='text' class='form-control' id='txt_"+x+","+1+"' value='"+data[x].form_kg+"' > </td>"+
												"<td> <input type='text' class='form-control' id='txt_"+x+","+2+"' value='"+data[x].to_kg+"' > </td>"+
												"<td> <input type='text' class='form-control' id='txt_"+x+","+3+"' value='"+data[x].price+"' > </td>"+
												"<td> <input type='text' class='form-control' id='txt_"+x+","+4+"' value='"+data[x].Addtional_amount+"'></td>"+
												"<td> <input type='text' class='form-control' id='txt_"+x+","+5+"' value='"+data[x].Addtional_kg+"'></td>"+
												"<td> <input type='button' value='update' class='btn btn-primary' id='btnSave,"+x+"' onclick='updateOneRowData("+data[x].id+","+x+")' /><span id='ico"+x+"' style='font-size:22px;' ></span></td>"+
									 "</tr>";
										
										
									
									}
									$("table tbody").html(generatetable);
									for(a = 0; a < modeId.length ;a++){
										$('select#themod'+a).find('option').each(function() {
												if($(this).val() == modeId[a]){
													$(this).prop('selected', true);
												}
												
										});
									}
									for(a = 0; a < typeId.length ;a++){
										$('select#thedoc'+a).find('option').each(function() {
												if($(this).val() == typeId[a]){
													$(this).prop('selected', true);
												}
												
										});
									}
									for(a = 0; a < calId.length ;a++){
										$('select#thecal'+a).find('option').each(function() {
												if($(this).val() == calId[a]){
													$(this).prop('selected', true);
												}
												
										});
									}
									
									
								}else{
									 	$("table tbody").empty();
										generatetable = "";
									 }
								 
							}
							
						}); 
        		}
				else{
					$("table tbody").empty();
					generatetable = "";
					}
	  }
function updateOneRowData(insertedId,linenumber){
		if($('#loader_id option:selected').val() == ''){
					alert('Please select Client!!!!');
		}else{
					//var linenumber;
					var finalStatus = false;
					
					if(linenumber >= 0){ finalStatus = true; }
					var finalData 	=   new Object();
					
					for(var z = 0 ;z <= 5 ; z++){
							 if(document.getElementById('txt_'+linenumber+','+z).value == ''){
								    finalStatus = false;
									break;
							 }else{
								 		finalStatus = true;
								  }
					}
					
					if(finalStatus == true){
					
					finalData	=	{
						
							id 				 :  insertedId,
							loader_id		 :  $('#loader_id option:selected').val(),
							docType			 :	document.getElementById('txt_'+linenumber+','+6).value,
							docMode			 :	document.getElementById('txt_'+linenumber+','+7).value,
							calType			 :	document.getElementById('txt_'+linenumber+','+8).value,
							slotName  		 :  document.getElementById('txt_'+linenumber+','+0).value,
							form_kg  		 :  document.getElementById('txt_'+linenumber+','+1).value,
							to_kg  			 :  document.getElementById('txt_'+linenumber+','+2).value,
							price  			 :  document.getElementById('txt_'+linenumber+','+3).value,
							Addtional_amount :  document.getElementById('txt_'+linenumber+','+4).value,
							Addtional_kg   	 :  document.getElementById('txt_'+linenumber+','+5).value
					};
					console.log(finalData);
					$.ajax({
							type :'POST',
							url  :'<?php echo base_url('secure/loader/updatePriceSlot');?>',
							data :'finalData='+JSON.stringify(finalData),
							dataType:'JSON',
							success:function(data){
								
								if(data.update == true){
									
										$('#the-slot').html('<div class="alert alert-success">' +
										'<span class="glyphn glyphn-ok"></span>' +
										' Slot Update Successfully'+
										'</div>');
										getloaderslotd(data.cid);
										
								}
								window.setTimeout(() => {
                                                  $('#the-slot').empty();
                                 }, 3000);
							}
							
					});
					
					}else{
								$('#the-slotData').html('<div class="alert alert-warning">' +
										'<span class="glyphn glyphn-ok"></span>' +
										' Please fill All Data'+
										'</div>');
						 }
					
					 
			 }
}

function insertOneRowData(rownum){
		if($('#loader_id option:selected').val() == ''){
					alert('Please select Client!!!!');
		}else{
					
					var finalStatus = false;
					var finalData 	=   new Object();
					for(var z = 0 ;z <= 5 ; z++){
							 if(document.getElementById('txt_'+rownum+','+z).value == ''){
								    finalStatus = false;
									break;
							 }else{
								 		finalStatus = true;
								  }
					}
					if(finalStatus == true){
						finalData	=	{
							loader_id		 :  $('#loader_id option:selected').val(),
							docType			 :	document.getElementById('txt_'+rownum+','+6).value,
							docMode			 :	document.getElementById('txt_'+rownum+','+7).value,
							calType			 :	document.getElementById('txt_'+rownum+','+8).value,
							slotName  		 :  document.getElementById('txt_'+rownum+','+0).value,
							form_kg  		 :  document.getElementById('txt_'+rownum+','+1).value,
							to_kg  			 :  document.getElementById('txt_'+rownum+','+2).value,
							price  			 :  document.getElementById('txt_'+rownum+','+3).value,
							Addtional_amount :  document.getElementById('txt_'+rownum+','+4).value,
							Addtional_kg   	 :  document.getElementById('txt_'+rownum+','+5).value
					};
					
					$.ajax({
							type :'POST',
							url  :'<?php echo base_url('secure/loader/insertPriceSlot');?>',
							data :'finalData='+JSON.stringify(finalData),
							dataType:'JSON',
							success:function(data){
								if(data.insert == true){
									
										$('#the-slot').html('<div class="alert alert-success">' +
										'<span class="glyphn glyphn-ok"></span>' +
										' Slot Saved Successfully'+
										'</div>');
										$("table tbody").find('input[name="record"]').each(function(){
											if($(this).is(":checked")){
												$(this).prop('checked',false);
											}
										});
										
										getloaderslotd(data.cid);
										
								}
								
								if(data.insert == false){
									$('#the-slot').html('<div class="alert alert-warning"><span class="glyphn glyphn-ok"></span>' + data.errorMsg +
								'</div>');	
								}
								window.setTimeout(() => {
                                                  $('#the-slot').empty();
                                 }, 3000);
							}
								
						});
					
					}else{
								$('#the-slotData').html('<div class="alert alert-warning">' +
										'<span class="glyphn glyphn-ok"></span>' +
										' Please fill All Data'+
										'</div>');
										
						 }
					
					 
			 }
}


 function doc(rowNumber){
 		document.getElementById('txt_'+rowNumber+','+6).value =  document.getElementById('thedoc'+rowNumber).value;
 }
 function cal(rowNumber){
 		document.getElementById('txt_'+rowNumber+','+8).value =  document.getElementById('thecal'+rowNumber).value;
 }
 function mod(rowNumber){
 		document.getElementById('txt_'+rowNumber+','+7).value =  document.getElementById('themod'+rowNumber).value;
 }
 
 function rowDesign(lineNumber){
	document.getElementById('rowId,'+lineNumber).style.background = 'green';
}
 
 
 </script>