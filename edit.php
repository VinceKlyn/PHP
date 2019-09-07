<?php
// including the database connection file
include_once("config.php");

if(isset($_POST['update'])){

	$oId = $_POST['oId'];
	$pId = $_POST['pId'];
	$pName = $_POST['pName'];
	$pDesc = $_POST['pDesc'];
	$uUserName = $_POST['uUserName'];
	$cName = $_POST['cName'];
	
	// checking empty fields
	if(empty($oId) || empty($pId) || empty($pName) || empty($pDesc) || empty($uUserName) || empty ($cName)){	
			
		if(empty($oId)) {
			echo "<font color='red'>Order ID field is empty.</font><br/>";
		}
		
		if(empty($pId)) {
			echo "<font color='red'>Product ID field is empty.</font><br/>";
		}
		
		if(empty($pName)) {
			echo "<font color='red'>Product Name field is empty.</font><br/>";
		}

		if(empty($pDesc)) {
			echo "<font color='red'>Product Description field is empty.</font><br/>";
		}

		if(empty($uUserName)) {
			echo "<font color='red'>User UserName field is empty.</font><br/>";
        }		
        if(empty($cName)) {
			echo "<font color='red'>Customer Name field is empty.</font><br/>";
		}		
	} else {
		//updating the table
		$sql = "UPDATE vince_db SET oId=:oId, pId=:pId, pName=:pName,  pDesc=:pDesc, uUserName=:uUserName, cName=:cName WHERE oId=:oId";
		$query = $dbConn->prepare($sql);
		
		$query->bindparam(':oId', $oId);
		$query->bindparam(':pId', $pId);
		$query->bindparam(':pName', $pName);
		$query->bindparam(':pDesc', $pDesc);
		$query->bindparam(':uUserName', $uUserName);
		$query->bindparam(':cName', $cName);
		$query->execute();
		
		// Alternative to above bindparam and execute
		// $query->execute(array(':id' => $id, ':name' => $name, ':email' => $email, ':age' => $age));
				
		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
	}
}
?>
<?php
//getting id from url
$oId = $_GET['oId'];

//selecting data associated with this particular id
$sql = "SELECT oId,o.pId,pName,pDesc,uUserName,cName from orders o 
inner join products p on o.pId = p.pId 
inner join users u on o.uId = u.uId 
inner join customers c on o.cId = c.cId FROM vince_db WHERE oId=:oId";
$query = $dbConn->prepare($sql);
$query->execute(array(':oId' => $oId));

while($row = $query->fetch(PDO::FETCH_ASSOC)){

	$oId = $row['oId'];
    $pId = $row['pId'];
    $pName = $row['pName'];
	$pDesc = $row['pDesc'];
	$uUserName = $row['uUserName'];
	$cName = $row['cName'];
}
?>
<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
	<a href="index.php">Home</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>Order ID </td>
				<td><input type="text" name="oId" value="<?php echo $oId;?>"></td>
			</tr>
			<tr> 
				<td>Product Price</td>
				<td><input type="text" name="pId" value="<?php echo $pId;?>"></td>
			</tr>
			<tr>
				<td>Product Name</td>
				<td><input type="text" name="pName" value="<?php echo $pName;?>"></td>
			</tr>
			<tr>
				<td>Product Description</td>
				<td><input type="text" name="pDesc" value="<?php echo $pDesc;?>"></td>
			</tr>
			<tr>
				<td>UserName</td>
                <td><input type="text" name="uUserName" value="<?php echo $uUserName;?>"></td>
                
            </tr>
            <tr>
				<td>Customer Name</td>
                <td><input type="text" name="cName" value="<?php echo $cName;?>"></td>
                
			</tr>
			<tr>
				<td><input type="hidden" name="id" value="<?php echo $_GET['oId'];?>"></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>
