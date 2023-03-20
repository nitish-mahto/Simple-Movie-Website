<?php
include("customer_header.php");
$con=mysql_connect("localhost","root","") or die("Connection Failed :".mysql_connect_error());
mysql_select_db("movies",$con);

$res=mysql_query("select * from cart_master",$con);
	if(mysql_num_rows($res)>0)
	{
		echo "<table width='50%' border='1' align='center' bordercolor='red'>
			<tr>
				<th colspan='6'><h2>AVAILABLE MOVIES DETAILS</h2></th>
			</tr>
			<th>SR. NO</th>
			<th>MOVIES Name</th>
			<th>OPENING DAY</th>
			<th>ENDING DAY</th>
			<th>PRICE</th>
			<th>SELECT</th>";
			
			while($row=mysql_fetch_array($res))			
			{
				echo "<tr>";
				echo "<td>$row[0]</td>";
				echo "<td>$row[1]</td>";
				echo "<td>$row[2]</td>";
				echo "<td>$row[3]</td>";	
				echo "<td>$row[4]</td>";				
			
				echo "<td><a href='custmer_booking.php?mid=$row[0]'>SELECT</a></td>";				
				echo "</tr>";
			}
	}else{
		echo "No Record Found";
	}			
		echo "</table>";
		
?>
<?php
if(isset($_REQUEST['mid'])){
	$cid1=$_REQUEST['mid'];
	$res1=mysql_query("select * from cart_master where id='$cid1'");	
	$r1=mysql_fetch_array($res1);
	$mov=$r1[1];	
	$cst=$r1[4];
		
}
?>
<?php
if(isset($_POST['btnbook'])){
	$flag=true;
	$name=$_POST['txtname'];
	$mov=$_POST['txtmovie'];
	$tm=$_POST['tme'];
	$tdate=$_POST['txtdate'];
	$qty1=$_POST['qty'];	
	$cst=$_POST['txtcost'];
	if(empty($name)){
		echo "<script type='text/javascript'>";
		echo "alert('please Enter Your Name');";
		echo "</script>";
		$flag=false;
	}else{		
		if(!preg_match('/^[a-zA-Z ]*$/',$name)){
			echo "<script type='text/javascript'>";
			echo "alert('please Enter Only Alphbets in Name');";
			echo "</script>";
			$flag=false;
		}
	}
	if($qty1==1){
		$cst=$cst * 1;
	}elseif($qty1==2){
		$cst=$cst * 2;
	}elseif($qty1==3){
		$cst=$cst * 3;
	}elseif($qty1==4){
		$cst=$cst * 4;
	}elseif($qty1==5){
		$cst=$cst * 5;
	}elseif($qty1==6){
		$cst=$cst * 6;
	}elseif($qty1==7){
		$cst=$cst * 7;
	}elseif($qty1==8){
		$cst=$cst * 8;
	}elseif($qty1==9){
		$cst=$cst * 9;
	}elseif($qty1==10){
		$cst=$cst * 10;
	}
	
	if($flag){
		$query="insert into custmer_booking (cust_name,movie_name,time,day,qty,cost) values('$name','$mov','$tm','$tdate','$qty1','$cst')";
		if(mysql_query($query,$con))
		{
			echo "<script type='text/javascript'>";		
			echo "alert('Booked Successfully');";			
			echo "window.location.href='custmer_booking.php';";
			echo "</script>";
		}
	}
	
}
 ?>

<br>
<form method="post">
	<table width='30%' border='1' align='center' bordercolor="green">
		</tr>
			<th colspan="2" align="center"><h1><font color="red">Movie Booking Form</font></h1></th>
		</tr>	
		<tr>
			<td>Enter Name :</td>
			<td>
				<input type="text" name="txtname" value="<?php echo $name; ?>">				
			</td>
		</tr>		
		<tr>
			<td>Movie Name :</td>
			<td>
				<input type="text" name="txtmovie" value="<?php echo $mov; ?>">				
			</td>
		</tr>		
		<tr>
			<td>Time :</td>
			<td>
				<select name="tme">
					<option>08:00 AM - 11:00 AM</option>
					<option>11:00 AM - 02:00 PM</option>
					<option>02:00 PM - 05:00 PM</option>
					<option>05:00 PM - 08:00 PM</option>
					<option>08:00 PM - 11:00 PM</option>			
					<option>11:00 PM - 01:00 AM</option>
				</select>
			</td>
		</tr>		
		<tr>
			<td>Date :</td>
			<td>
				<input type="date" name="txtdate" value="<?php echo $tdate; ?>">				
			</td>
		</tr>		
		<tr>
			<td>Quentity :</td>
			<td>
				<select name="qty">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>					
					<option>8</option>					
					<option>9</option>					
					<option>10</option>					
				</select>
			</td>
		</tr>		
		<tr>
			<td>Cost :</td>
			<td>
				<input type="text" name="txtcost" value="<?php echo $cst; ?>">				
			</td>
		</tr>		
		<tr>			
			<td align="center" colspan="2">
			<?php/*
				if($_REQUEST['mid'])
				{*/
			?>
			<!--	<input type="submit" name="btnupdate" value="UPDATE">				-->
			<?php/*
				}else{*/
			?>
				<input type="submit" name="btnbook" value="BOOK">				
			<?php/*
				}*/
			?>
			</td>
		</tr>				
	</table>	
</form><br>
<?php
$res=mysql_query("select * from custmer_booking",$con);
if(mysql_num_rows($res)>0)
	{
		echo "<table width='65%' border='1' align='center' bordercolor='blue'>
			<tr>
				<th colspan='9'><h2>CUSTOMER BOOKING DETAILS </h2></th>
			</tr>
			<th>ID</th>
			<th>CUSTOMER NAME</th>
			<th>MOVIES NAME</th>
			<th>TIME</th>
			<th>DATE</th>
			<th>QUENTITY</th>
			<th>COST</th>
			<th>BOOKING DATE</th>
			<th>SELECT</th>
			";
			
			while($row=mysql_fetch_array($res)){
				echo "<tr>";
				echo "<td>$row[0]</td>";
				echo "<td>$row[1]</td>";
				echo "<td>$row[2]</td>";
				echo "<td>$row[3]</td>";	
				echo "<td>$row[4]</td>";				
				echo "<td>$row[5]</td>";				
				echo "<td>$row[6]</td>";
				echo "<td>$row[7]</td>";					
				echo "<td><a href='custmer_booking.php?mid=$row[0]'>UPDATE</a></td>";				
				echo "</tr>";
			}
	}else{
		echo "No Record Found";
	}			
		echo "</table>";
?>
<?php
include('footer.php');
?>