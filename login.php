<?php
include("header.php");
include("connection.php");

if(isset($_POST['btnlogin']))
{
	$flag=true;	
	$email=$_POST['txtemail'];	
	$pwd=$_POST['txtpwd'];	
		
	if(empty($email)){
		$error_email="Please Enter Your Email ID";
		$flag=false;
	}else{
		if(!preg_match("/^[a-zA-Z0-9.-_ ]*@[a-zA-Z0-9.-_ ]*\.([a-zA-Z]{2,3})*$/",$email)){
			$error_email="Please Enter Valid Email ID";
			$flag=false;
		}		
	}
	
	if(empty($pwd)){
		$error_pwd="Please Enter Your Password";
		$flag=false;
	}
	
	if($flag)
	{
		$res=mysql_query("select * from admin_login where email_id='$email' and pwd='$pwd'");
		if(mysql_num_rows($res)>0)
		{
			echo "<script type='text/javascript'>";		
			echo "alert('Admin Login Successfully');";			
			echo "window.location.href='cart_master.php';";
			echo "</script>";
		}else{
			$res1=mysql_query("select * from cust_regist where email_id='$email' and pwd='$pwd'");
			if(mysql_num_rows($res1)>0)
			{
				echo "<script type='text/javascript'>";		
				echo "alert('Customer Login Successfully');";
				echo "window.location.href='custmer_booking.php';";				
				echo "</script>";
			}else{
				echo "<script type='text/javascript'>";		
				echo "alert('Invalid Email Id or Password');";			
				echo "</script>";
			}
		}	
	}	
}
?>
<form method="post">
<br>
<table width="62%" border="0" align="right" height="270px" bordercolor="hotpink">
		<td colspan="2">
            <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <font color="red" face="Times New Roman">LOGIN</font></h1>        
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<img src="images/login1.png" width="80px" height="80px"><br>
        </td> 
		
		<tr>
			<td width="12%">Enter Email ID:</td>
			<td>
				<input type="text" name="txtemail">
				<span style="color:red"><?php echo $error_email ?></span>					
			</td>
		</tr>
		
		<tr>
			<td>Enter Password:</td>
			<td>
				<input type="password" name="txtpwd">
				<span style="color:red"><?php echo $error_pwd ?></span>					
			</td>
		</tr>    
		
		<tr>    
			<td colspan="2"> <br />           
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;				
				<input type="submit" name="btnlogin" value="LOGIN">
			</td>
		</tr>
	</table>
	</form>
<?php
include("footer.php");
?>