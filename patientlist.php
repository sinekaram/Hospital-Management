<?php

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `pattable` WHERE CONCAT( `fullname`, `userid`, `email`, `phoneno`, `password`, `gender`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `pattable` ";
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
    <title>Patient Details</title>
<style>
   body{
	   width:500px;
       height:1000px;
       background:white;
	   
    }
  
    .content-table{
		margin:20px 0;
		font-size:0.9em;
		text-align:center;
	}
	.content-table thead tr {
		background-color:indigo;
		color:white;
		text-align:center;
		font-weight:bold;
	}
	.content-table th,content-table tr{
		padding:20px 50px;
	}
	
	.content-table tbody tr{
		background-color:indianred;
		color:darkblue;
		font-weight:bold;
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
        <a class="float-right" href="adminpage.html" style="font-size:20px;color:white;text-decoration:none;font-family:sofia;"><h4><i> Back</i> </h4></a>
    </div>  
	<h1 style="color:indigo">PATIENT LIST</h1><br>
    
	<form action="" method="POST" autocomplete="off"> 
        <div class="search-box">
            <input class="search-txt" type="text" name="valueToSearch" placeholder="Value To Search">
            <input class="search-btn" type="submit"  name="search" value="SEARCH">
        </div>  
	</form>
   <table class="content-table">
        <thead>
        <tr>  
        <th>FULL NAME</th>     
            <th>USER ID</th> 
            <th>EMAIL</th> 		
            <th>PHONE NUMBER</th>   
            <th>PASSWORD</th>   
            <th>GENDER</th>     
        </tr>
        </thead>

 <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
      
        <tr>
			<td><?php echo $row['fullname'] ?></td>
            <td><?php echo $row['userid'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['phoneno'] ?></td>
            <td><?php echo $row['password'] ?></td>
            <td><?php echo $row['gender'] ?></td>
        </tr>
	
		<?php endwhile;?>
        </table>
   
        
    </body>
</html>