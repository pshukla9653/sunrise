<!-- Footer -->
					<div class="footer text-muted">
						&nbsp;&nbsp;&nbsp;&nbsp; &copy; <?php echo date('Y');?>. <a href="#"><?=$this->site_setting['title'];?></a> by <a href="http://cztn.co.in" target="_blank">CZTN</a>
					</div>
					<!-- /footer -->

				
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
    <script type="text/javascript">
$(document).ready(function() {
    $('#country_id').on('change',function(){
        var country_id = $(this).val();
        if(country_id){
            $.ajax({
                type:'POST',
                url:'<?=base_url('secure/ajaxdata/getState');?>',
                data:'country_id='+country_id,
                success:function(html){
                  $('#state_id').html(html);
                }
				
            }); 
        }else{
            $('#state_id').html('<div class="text-danger">Select Country</div>'); 
        }
    });
	$('#state_id').on('change',function(){
        var state_id = $(this).val();
		
        if(state_id){
            $.ajax({
                type:'POST',
                url:'<?=base_url('secure/ajaxdata/getCity');?>',
                data:'state_id='+state_id,
                success:function(html){
                  $('#city_id').html(html);
                }
				
            }); 
        }else{
            $('#city_id').html('<div class="text-danger">Select Country</div>'); 
        }
    });
	
	 $('#country_ids').on('change',function(){
        var country_id = $(this).val();
        if(country_id){
            $.ajax({
                type:'POST',
                url:'<?=base_url('secure/ajaxdata/getState');?>',
                data:'country_id='+country_id,
                success:function(html){
                  $('#state_ids').html(html);
                }
				
            }); 
        }else{
            $('#state_ids').html('<div class="text-danger">Select Country</div>'); 
        }
    });
	$('#state_ids').on('change',function(){
        var state_id = $(this).val();
		
        if(state_id){
            $.ajax({
                type:'POST',
                url:'<?=base_url('secure/ajaxdata/getCity');?>',
                data:'state_id='+state_id,
                success:function(html){
                  $('#city_ids').html(html);
                }
				
            }); 
        }else{
            $('#city_ids').html('<div class="text-danger">Select Country</div>'); 
        }
    });
	
	$('#editcountry_id').on('change',function(){
        var country_id = $(this).val();
        if(country_id){
            $.ajax({
                type:'POST',
                url:'<?=base_url('secure/ajaxdata/getState');?>',
                data:'country_id='+country_id,
                success:function(html){
                  $('#editstate_id').html(html);
                }
				
            }); 
        }else{
            $('#editstate_id').html('<div class="text-danger">Select Country</div>'); 
        }
    });
	$('#editstate_id').on('change',function(){
        var state_id = $(this).val();
		
        if(state_id){
            $.ajax({
                type:'POST',
                url:'<?=base_url('secure/ajaxdata/getCity');?>',
                data:'state_id='+state_id,
                success:function(html){
                  $('#editcity_id').html(html);
                }
				
            }); 
        }else{
            $('#editcity_id').html('<div class="text-danger">Select Country</div>'); 
        }
    });
	
	});
</script>
<script>
		window.setTimeout(function () {
			$(".alert-success").fadeTo(300, 0).slideUp(300, function () {
				$(this).remove();
			});
		}, 10000);
    	window.setTimeout(function () {
			$(".alert-info").fadeTo(300, 0).slideUp(300, function () {
				$(this).remove();
			});
		}, 3000);
		window.setTimeout(function () {
			$(".alert-danger").fadeTo(300, 0).slideUp(300, function () {
				$(this).remove();
			});
		}, 10000);
    
		window.setTimeout(function () {
			$(".alert-warning").fadeTo(300, 0).slideUp(300, function () {
				$(this).remove();
			});
		}, 10000);
    
	
    </script>	<!-- /page container -->
<script>
$(document).ready(function() {
	$('.listbox-no-selection').bootstrapDualListbox({
        preserveSelectionOnMove: 'moved',
        moveOnSelect: false
    });
$('.datatable-basic').DataTable({
	destroy: true,
	autoWidth: false,
    responsive: true,
	dom: 'Bfrtip',
	
	buttons: [
        <?php if($this->session->userdata('group_id') == 4){?>
		{ extend: 'copy', text: 'Copy | ' },
		{ extend: 'print', text: 'Print | ' },
        { extend: 'excel', text: 'Save as Excel ' }
		<?php }?>
    ]
	
	});
	
<?php /*?>$('.datatable-ajax').DataTable({
	destroy: true,
	autoWidth: false,
    responsive: true,
	dom: 'Bfrtip',
	
	buttons: [
        <?php if($this->session->userdata('group_id') == 4){?>
		{ extend: 'copy', text: 'Copy | ' },
		{ extend: 'print', text: 'Print | ' },
        { extend: 'excel', text: 'Save as Excel ' }
		<?php }?>
    ]
	
	});	<?php */?>

});
$('.select2').select2({
	 placeholder: 'Select an option',
	 allowClear: true,
	 closeOnSelect: true
});

$('#summernote').summernote();


</script>

</body>
</html>
