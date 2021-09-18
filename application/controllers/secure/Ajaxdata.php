<?php

 
class Ajaxdata extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
		$this->load->model('secure/States_model');
		$this->load->model('secure/Cities_model');
		$this->load->model('secure/Setting_model');
    } 

   	public function getState(){
			if(!empty($_POST['country_id'])){
				
				$query    = $this->States_model->get_state_by_country($_POST['country_id']);
				if($query > 0 && $query!=0){
				if($query==1){
				foreach($query as $row){ 
				echo '<option value="">Select State</option>';
				echo '<option value="'.$row['state_id'].'">'.$row['state_name'].'</option>';
						}
					}
				else{
				echo '<option value="">Select State</option>';
				foreach($query as $row){ 
				echo '<option value="'.$row['state_id'].'">'.$row['state_name'].'</option>';
							}
						}
					}
				}
			else{
				echo '<option value="">No State For This Country</option>';
				}
	 	  }
		  
	public function getCity(){
			if(!empty($_POST['state_id'])){
				
				$query    = $this->Cities_model->get_city_by_state($_POST['state_id']);
				if($query > 0 && $query!=0){
				if($query==1){
				foreach($query as $row){ 
				echo '<option value="">Select City</option>';
				echo '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>';
						}
					}
				else{
				echo '<option value="">Select City</option>';
				foreach($query as $row){ 
				echo '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>';
							}
						}
					}
				}
			else{
				echo '<option value="">No City For This State</option>';
				}
	 	  }
		public function uploadPostImg()
	   { 
	       $data = $_POST['image'];


				list($type, $data) = explode(';', $data);
				list(, $data)      = explode(',', $data);
				
				
				$data = base64_decode($data);
				$imageName = time().'.png';
				file_put_contents('uploads/post/photo/'.$imageName, $data);
				
				
				echo $imageName;
			
       }  
	   public function admin_menu_order(){
			if(!empty($_POST['menu_order'])){
				
				$data['admin_menu_order']= $_POST['menu_order'];
				$update = $this->Setting_model->update_setting(1, $data);
				if($update){
					echo '<div class="alert alert-success">Record Updated Successfully!</div>';
				}
				else{
					echo '<div class="alert alert-danger">Invalid Response! Try Again</div>';
				}
	 	  }
	   }
}
