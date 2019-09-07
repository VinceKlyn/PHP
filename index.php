<?php
//including the database connection file
include_once("config.php");

//fetching data in descending order (lastest entry first)
$result = $dbConn->query("SELECT oId,o.pId,pName,pDesc,uUserName,cName from orders o inner join products p on o.pId = p.pId inner join users u on o.uId = u.uId inner join customers c on o.cId = c.cId");
?>

<html>
<head>	
	<title>Homepage</title>
	
	<link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
<a href="add.html">Add New Data</a><br/><br/>

	<table width='80%' border=0>

	<tr bgcolor='#CCCCCC'>
		<td>Order ID</td>
		<td>Product ID</td>
		<td>Product Name</td>
		<td>Product Description</td>
		<td>UserName</td>
		<td>Customer Name</td>
		<td>Edit/Delete</td>
	</tr>
	<?php 	
	while($row = $result->fetch(PDO::FETCH_ASSOC)) { 	
		echo "<tr>";	
		echo "<tr>".$row['oId']."</td>";
		echo "<td>".$row['pId']."</td>";
		echo "<td>".$row['pName']."</td>";
		echo "<td>".$row['pDesc']."</td>";
		echo "<td>".$row['uUserName']."</td>";
		echo "<td>".$row['cName']."</td>";
		echo "<td><a href=\"edit.php?oId=$row[oId]\">Edit</a> | <a href=\"delete.php?oId=$row[oId]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
	}
	?>
	</table>
</body>
</html>
