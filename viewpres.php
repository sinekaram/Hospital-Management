<?php
session_start();
$user=$_SESSION['userid'];
$doctor=$_SESSION['docid'];

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `prescription` WHERE userid='$user' and docid='$doctor' WHERE CONCAT(`fullname`, `userid`, `gender`, `mobile`, `adate`, `atime`,'mailid','docid','disease','medicine','message','meet','cfees') LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `prescription` WHERE userid='$user' and docid='$doctor' ";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "hmsgds");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

?>

<html>
<head>
    <title>Prescription Details</title>
<style>
   body{
	   width:500px;
       height:1000px;
       background:white;
	   
    }
  
   .content-table{
		border-collapse:collapse;
		margin:25px 0;
		font-size:0.9em;
		text-align:center;
		height:30px;
		width:1200px;
	}
	.content-table thead tr {
		background-color:indigo;
		color:white;
		text-align:center;
		font-weight:bold;
	}
	.content-table th,content-table tr{
		padding:20px 8px;
	}
	.content-table tbody tr{
		border-bottom:1px solid #dddddd;
	   background-color:indianred;
		color:darkblue;
	}
	.link{
		background-color:indigo;
		width:1260px;
		height:40px;
	}
	.search-box{
		position:absolute;
		top:70px;
		left:300px;
		background:indigo;
		height:40px;
		}
	.search-btn{
		color:white;
		float:right;
		width:70px;
		height:40px;
		border:none;
		border-radius:40px;
		background:indigo;
		justify-content:center;
		align-items:center;
	}
	.search-box > .search-txt{
		width:200px;
		padding:0 6px;
	}
	
	.search-txt{
		border:5px;
		background:gainsboro;
		outline:none;
		float:left;
		padding:0;
		color:navy;
		font-size:20px;
		font-family:sans-serif;
		line-height:40px;
		width:0px;
	}
        </style>   
   </head>
<body>
    <div class="link">
        <a class="float-right" href="patpreslist.php" style="font-size:20px;color:white;text-decoration:none;font-family:sofia;"><h4><i> Back</i> </h4></a>
    </div>  
	<h1 style="color:indigo">Prescription LIST</h1><br>
    
	<form action="" method="POST" autocomplete="off"> 
        <div class="search-box">
            <input class="search-txt" type="text" name="valueToSearch" placeholder="Value To Search">
            <input class="search-btn" type="submit"  name="search" value="SEARCH">
        </div>  
	</form>
   <table class="content-table">
		<?php while($row = mysqli_fetch_array($search_result)):?>
		<thead>
        <tr> 		
        <th>FIELD</th>    
        <th>RESULTS</th>        
        </tr>
		</thead>
		<tr>
        <td>FULL NAME</td>
		<td><?php echo $row['fullname'] ?></td>
		</tr>
		<tr>
		<td>USER ID</td> 
		 <td><?php echo $row['userid'] ?></td>
		 </tr>
		<tr>
		<td>GENDER</td> 
		<td><?php echo $row['gender'] ?></td>
		</tr>
		<tr>
        <td>MOBILE</td>   
		<td><?php echo $row['mobile'] ?></td>
		</tr>
		<tr>
        <td>APPOINTMENT DATE</td>   
		<td><?php echo $row['adate'] ?></td>
		</tr>
		<tr>
        <td>APPOINTMENT TIME</td>
		<td><?php echo $row['atime'] ?></td>
		</tr>
		<tr>
		<td>MAILID</td>
		<td><?php echo $row['mailid'] ?></td>
		</tr>
		<tr>
		<td>DOCID</td>
		<td><?php echo $row['docid'] ?></td>
		</tr>
		<tr>
		<td>DISEASE</td>
		<td><?php echo $row['disease'] ?></td>
		</tr>
		<td>MEDICINE</td>
		<td><?php echo $row['medicine'] ?></td>
		</tr>
		<tr>
		<td>MESSAGE</td>
		<td><?php echo $row['message'] ?></td>
		</tr>
		<tr>
		<td>MEET</td>
		<td><?php echo $row['meet'] ?></td>
		</tr>
		<tr>
		<td>FEES</td>
		<td><?php echo $row['cfees'] ?></td>
        </tr>
		<?php endwhile;?>
        </table>
 
        
    </body>
</html>
