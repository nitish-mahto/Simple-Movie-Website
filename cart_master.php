<?php
include("admin_header.php");
include("connection.php");

if(isset($_POST['btnsave']))
{
	
	$flag=true;
	$movie=$_POST['txtmname'];
	$oday=$_POST['txtoday'];
	$eday=$_POST['txteday'];
	$cost=$_POST['txtcost'];
	$cid=$_REQUEST['ceid'];
		
	if(empty($movie)){
		$error_mname="Please Enter Movie Name";
		$flag=false;
	}
		
	if(empty($oday)){
		$error_oday="Please Enter Opening Day";
		$flag=false;
	}else{
		if(!preg_match('/^[a-zA-Z ]*$/',$oday)){
		$error_oday="Please Enter Only Alphabets in Day";
		$flag=false;
		}
	}
	
	if(empty($eday)){
		$error_eday="Please Enter Ending Day";
		$flag=false;
	}else{
		if(!preg_match('/^[a-zA-Z ]*$/',$eday)){
		$error_eday="Please Enter Only Alphabets in Day";
		$flag=false;
		}
	}
		
	if(empty($cost)){
		$error_cost="Please Enter Cost";
		$flag=false;
	}		
	
	if($flag)
	{
		$query="insert into cart_master(movie_name,opening,ending_day,cost) values('$movie','$oday','$eday','$cost')";
		if(mysql_query($query,$con))
		{
			echo "<script type='text/javascript'>";		
			echo "alert('Saved Successfully');";			
			echo "window.location.href='cart_master.php';";
			echo "</script>";
		}
	}	
}

if(isset($_REQUEST['ceid']))
{
	
	$cid1=$_REQUEST['ceid'];
	$res1=mysql_query("select * from cart_master where id='$cid1'");
	$r1=mysql_fetch_array($res1);
	$mname=$r1[1];
	$opday=$r1[2];
	$enday=$r1[3];
	$cost=$r1[4];
	
}


if(isset($_POST['btnedit']))
{
	$flag=true;
	$movie=$_POST['txtmname'];
	$oday=$_POST['txtoday'];
	$eday=$_POST['txteday'];
	$cost=$_POST['txtcost'];
	$cid=$_REQUEST['ceid'];
	
	if(empty($movie)){
		$error_mname="Please Enter Movie Name";
		$flag=false;
	}
	
	if(empty($oday)){
		$error_oday="Please Enter Opening Day";
		$flag=false;
	}else{
		if(!preg_match('/^[a-zA-Z ]*$/',$oday)){
		$error_oday="Please Enter Only Alphabets in Day";
		$flag=false;
		}
	}
	
	if(empty($eday)){
		$error_eday="Please Enter Ending Day";
		$flag=false;
	}else{
		if(!preg_match('/^[a-zA-Z ]*$/',$eday)){
		$error_eday="Please Enter Only Alphabets in Day";
		$flag=false;
		}
	}
	
	if(empty($cost)){
		$error_cost="Please Enter Cost";
		$flag=false;
	}	
	
	if($flag)
	{
		$query="update cart_master set movie_name='$movie',opening='$oday',ending_day='$eday',cost='$cost' where id='$cid'";
		if(mysql_query($query,$con))
		{
			echo "<script type='text/javascript'>";		
			echo "alert('Updated Successfully');";			
			echo "window.location.href='cart_master.php';";
			echo "</script>";
		}
	}	
}

if(isset($_REQUEST['cdid']))
{
	$cid1=$_REQUEST['cdid'];
	$query="delete from cart_master where id='$cid1'";
	if(mysql_query($query,$con))
	{
		echo "<script type='text/javascript'>";		
		echo "alert('Deleted Successfully');";			
		echo "window.location.href='cart_master.php';";
		echo "</script>";
	}
}

?>
<form method="post">
<table width="65%" border="0" align="right" height="200px" bordercolor="red" style="margin-bottom:100px; margin-top:100px;">
		  		
		<tr>
			<td width="20%"><b>Enter Movie Name :</b></td>
			<td>
				<input type="text" name="txtmname" value="<?php echo $mname; ?>">
				<span style="color:red"><?php echo $error_mname ?></span>					
			</td>
		</tr>
		
		<tr>
			<td><b>Enter Opening Day :</b></td>
			<td>
				<input type="text" name="txtoday" value="<?php echo $opday; ?>">
				<span style="color:red"><?php echo $error_oday ?></span>					
			</td>
		</tr>
		
		<tr>
			<td><b>Enter Ending Day :</b></td>
			<td>
				<input type="text" name="txteday" value="<?php echo $enday; ?>">
				<span style="color:red"><?php echo $error_eday ?></span>					
			</td>
		</tr>
		
		<tr>
			<td><b>Enter Cost :</b></td>
			<td>
				<input type="text" name="txtcost" value="<?php echo $cost; ?>">
				<span style="color:red"><?php echo $error_cost ?></span>					
			</td>
		</tr>
		
		<tr>    
			<td colspan ="2">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php
					if(isset($_REQUEST['ceid']))
					{
				?>
					<input type="submit" name="btnedit" value="UPDATE">					
				<?php
					}else{
				?>
					<input type="submit" name="btnsave" value="SAVE">
				<?php
					}
				?>		
			</td>
		</tr>
	</table>
	</form>
	<br/>
	<?php
	$res=mysql_query("select * from cart_master",$con);
	if(mysql_num_rows($res)>0)
	{
		echo "<table width='50%' border='1' align='center' bordercolor='red'>
			<th>SR. NO</th>
			<th>MOVIES Name</th>
			<th>OPENING DAY</th>
			<th>ENDING DAY</th>
			<th>PRICE</th>
			<th>EDIT</th>
			<th>DELETE</th>";
			
			while($row=mysql_fetch_array($res))			
			{
				echo "<tr>";
				echo "<td>$row[0]</td>";
				echo "<td>$row[1]</td>";
				echo "<td>$row[2]</td>";
				echo "<td>$row[3]</td>";	
				echo "<td>$row[4]</td>";				
			
				echo "<td><a href='cart_master.php?ceid=$row[0]'>EDIT</a></td>";
				echo "<td><a href='cart_master.php?cdid=$row[0]'>DELETE</a></td>";
				echo "</tr>";
			}
	}else{
		echo "No Record Found";
	}			
		echo "</table>";
	?>
<?php
include("footer.php");
?>