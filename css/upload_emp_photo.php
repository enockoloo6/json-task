<?php
	
	
	if(isset($_FILES['emp_picture']) && isset($_SESSION['session_id']) && !empty($_SESSION['session_id']))
	{
		$image_name = $_FILES['emp_picture']['name'];
		$upload_error = $_FILES['emp_picture']['error'];
		$image_type = $_FILES['emp_picture']['type'];
		$image_size = $_FILES['emp_picture']['size'];
		$temp_location = $_FILES['emp_picture']['tmp_name'];
		
		$session_var = $_SESSION['session_id'];
		$employee_image_path = "img/employee_images/";
		
		$allowed_ext = 'image/jpg' || 'image/jpeg' || 'image/gif' || 'image/png';
		$max_image_size = 3000000;
		
		if(!empty($image_name))
		{
			if($upload_error == 0)//0 when it is successful
			{
				if($image_type == $allowed_ext)
				{
					if($image_size <= $max_image_size)
					{
						//$health_officer_national_id = get_ho_field('member','HO_National_Id','HO_Auto_Id');
						
						
						$new_image_name = $image_name;
						
						move_uploaded_file($temp_location, $employee_image_path.$new_image_name);
						
						$update_employee_image_query = "UPDATE `member` SET `picture` = '".$new_image_name."'WHERE `employee_Auto_Id` = '".$session_var."'";
						$update_employee_image_query_run = mysql_query($update_employee_image_query);
						
						if($update_employee_image_query_run)
						{
							
							header('Location:index.php?member_id='.$name);//variable defined in header.inc.php			
									
						} 
					
						
					}
				}
			}
			
				
		}
	}
	
?>