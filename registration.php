<?php
include("header.php");
include("connection.php");

if(isset($_POST['btnregis']))
{
	$flag=true;
	$name=$_POST['txtname'];
	$add=$_POST['txtadd'];
	$city=$_POST['txtcity'];
	$mno=$_POST['txtmno'];
	$email=$_POST['txtemail'];	
	$pwd=$_POST['txtpwd'];	
	
	if(empty($name)){
		$error_name="Please Enter Your Name";
		$flag=false;
	}else{		
		if(!preg_match("/^[A-Za-z ]*$/",$name)){
			$error_name="Please Enter Only alphabets in Name";
			$flag=false;
		}
	}	
	
	if(empty($add)){
		$error_add="Please Enter Your Address";
		$flag=false;
	}
	
	if(empty($city)){
		$error_city="Please Enter Your City";
		$flag=false;
	}else{		
		if(!preg_match("/^[A-Za-z ]*$/",$city)){
			$error_city="Please Enter Only alphabets in City";
			$flag=false;
		}
	}
	
	if(empty($mno)){
		$error_mno="Please Enter Your Mobile No";
		$flag=false;
	}else if(!preg_match("/^[0-9]*$/",$mno)){
			$error_mno="Please Enter Only Digits in Mobile no";
			$flag=false;
	}else{
		if(strlen($mno)!=10){
			$error_mno="Please Enter Only 10 Digits in Mobile No";
			$flag=false;
		}
	}
	
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
	}else if(strlen($pwd)<6){
		$error_pwd="Please Enter Password more than 6 Characters";
		$flag=false;
	}else if(strlen($pwd)>10){
		$error_pwd="Please Enter Password less than 10 Characters";
		$flag=false;
	}
	
	if($flag)
	{
		$query="insert into cust_regist (cust_name,address,city,mobile_no,email_id,pwd) values('$name','$add','$city','$mno','$email','$pwd')";
		if(mysql_query($query,$con))
		{
			echo "<script type='text/javascript'>";		
			echo "alert('Registration Successfully');";			
			echo "window.location.href='login.php';";
			echo "</script>";
		}
	}	
}
?>
<form method="post">
<br>
<table width="62%" border="0" align="right" height="340px" bordercolor="hotpink">
		<td colspan="2">
            <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <font color="red" face="Times New Roman">REGISTRATION</font></h1>
        </td>       
		
		<tr>
			<td width="20%">Enter Name :</td>
			<td>
				<input type="text" name="txtname">
				<span style="color:red"><?php echo $error_name ?></span>					
			</td>
		</tr>
		
		<tr>
			<td>Enter Address :</td>      
			 <td>
				<textarea name="txtadd"></textarea>
				<span style="color:red"><?php echo $error_add ?></span>					
			</td>
		</tr>
		
		</tr>
		
		<tr>
			<td>Enter City:</td>
			<td>
				<input type="text" name="txtcity">
				<span style="color:red"><?php echo $error_city ?></span>					
			</td>
		</tr>
		</tr>
		
		<tr>
			<td>Enter Mobile No :</td>
			<td>
				<input type="text" name="txtmno" maxlength="10">
				<span style="color:red"><?php echo $error_mno ?></span>					
			</td>
		</tr>
			
		<tr>
			<td>Enter Email ID:</td>
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
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;
				<input type="submit" name="btnregis" value="REGISTER">
			</td>
		</tr>
	</table>
	</form>
<?php
include("footer.php");
?>