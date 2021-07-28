<?php

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `deleted_apt` WHERE CONCAT(`sno`, `userid`, `docid`, `action`,`deleted_at`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `deleted_apt` ";
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
    <title>Cancelled appointments </title>
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
		left:500px;
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
	<h1 style="color:indigo">CANCELLED APPOINTMENTS</h1><br>
    
	<form action="" method="POST" autocomplete="off"> 
        <div class="search-box">
            <input class="search-txt" type="text" name="valueToSearch" placeholder="Value To Search">
            <input class="search-btn" type="submit"  name="search" value="SEARCH">
        </div>  
	</form>
   <table class="content-table">
        <thead>
        <tr>  
        <th>SNO</th>     
        <th>USER ID</th> 
        <th>DOCTOR ID</th> 		
        <th>ACTION</th>   
        <th>DELETED_AT</th>   
		<th>DELETED_BY</th>		
        </tr>
        </thead>

 <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
      
        <tr>
        <td><?php echo $row['sno'] ?></td>
        <td><?php echo $row['userid'] ?></td>
        <td><?php echo $row['docid'] ?></td>
        <td><?php echo $row['action'] ?></td>
        <td><?php echo $row['deleted_at'] ?></td>
		<td> 
		<?php
					if(($row['userstatus']==0) && ($row['doctorstatus']==1))  
                    {
                      echo "Cancelled by patient";
                    }

                    if(($row['userstatus']==1) && ($row['doctorstatus']==0))  
                    {
                      echo "Cancelled By the Doctor";
                    }
					
                      ?> 
        </td>
        </tr>
	
		<?php endwhile;?>
        </table>
   
        
    </body>
</html>