	case "AddUser":
				Form_post_actions::_AddUser();
			break;

case "UpdateUser":
				Form_post_actions::_UpdateUser();
			break;


// Add new user
	public static function _AddUser(){
	
		// check category field has value or not
		if(isset($_POST['name']) && isset($_POST['email'])  && isset($_POST['username']) && isset($_POST['password']) ){
				
			if( !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']) ){
					
				global $mxDb;
	
				$user_id = Form_post_actions::getUserId();
	
				//Update Contact Us
				$insert = array(
						'name'=>$_POST['name'],
						'user_id'=>$user_id,
						'username'=>$_POST['username'],
						'password'=>hash("sha256",$_POST['password']),
						'email'=>$_POST['email'],
						'type'=>'sub_admin',
						'date'=>date('Y-m-d'),
						'add_date_time'=>date('Y-m-d H:i:s')
				);
	
				if($mxDb->insert_record( 'admin', $insert )){
						
					// insert privileage
					$privileage = $_POST['privileage'];
						
					foreach( $privileage as $privil){
	
						$insert_array = array(
								'privilege_page'=>$privil,
								'date'=>date('Y-m-d'),
								'add_date_time'=>date('Y-m-d H:i:s'),
								'admin_id'=>$user_id
						);
	
						$mxDb->insert_record( 'admin_privileges', $insert_array );
	
					}
						
					header("Location:sub-admin-manage.php?msg=Add user successfully!&res=1");
				}
				else{
					header("Location:sub-admin-manage.php?msg=Failed record insertion!&res=1");
				}
			}
			else
				header("Location:sub-admin-manage.php?msg=Please fill fields information!&res=0");
		}
		else
			header("Location:sub-admin-manage.php?msg=Please fill fields information!&res=0");
	
	}
	



	// Update User report
	public static function _UpdateUser(){
	
		// check category field has value or not
		if(isset($_POST['name']) && isset($_POST['email'])  && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['id']) ){
				
			if( !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['id']) ){
					
				global $mxDb;
	
				$user_id = $_POST['id'];
	
	
	            $res=mysql_fetch_array(mysql_query("select * from admin where user_id='$user_id'"));
				$res1=$res['password'];
				
				//echo $res1;print_r("<br/>");
				//echo $_POST['password'];
				
	            if($res1==$_POST['password'])
				{
					$update = array(
						'name'=>$_POST['name'],
						'username'=>$_POST['username'],
						'email'=>$_POST['email']
				);
				}
				else
				{
	
				//Update Contact Us
				$update = array(
						'name'=>$_POST['name'],
						'username'=>$_POST['username'],
						'password'=>hash("sha256",$_POST['password']),
						'email'=>$_POST['email']
				);
				}
	
				$where = " user_id=".$user_id;
	
				if($mxDb->update_record( 'admin', $update, $where )){
						
					// delete old privileage
					$mxDb->delete_record('admin_privileges', "admin_id='".$user_id."'");
						
					// insert privileage
					$privileage = $_POST['privileage'];
						
					foreach( $privileage as $privil){
	
						$insert_array = array(
								'privilege_page'=>$privil,
								'date'=>date('Y-m-d'),
								'add_date_time'=>date('Y-m-d H:i:s'),
								'admin_id'=>$user_id
						);
	
						$mxDb->insert_record( 'admin_privileges', $insert_array );
	
					}
						
					header("Location:sub-admin-manage.php?msg=Update User successfully!&res=1");
				}
				else{
					header("Location:sub-admin-manage.php?msg=Failed record updateion!&res=1");
				}
			}
			else
				header("Location:sub-admin-manage.php?msg=Please fill fields information!&res=0");
		}
		else
			header("Location:sub-admin-manage.php?msg=Please fill fields information!&res=0");
	
	}
	
