<?php
// session_start();
// $userid=$_SESSION['userid'];
if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `prescription` WHERE CONCAT( `sno`, `docid`, `userid`, `disease`, `medicine`, `meet`, `message`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `prescription`";
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
<title>Report</title>
<style>
    body{
	   width:500px;
       height:1000px;
       background:white;
    }
  
    .content-table{
		border-collapse:collapse;
		margin:25px 0;
		min-width:900px;
		font-size:1.2em;
		text-align:center;
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
		right:300px;
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
	<h1 style="color:indigo;">Report Details</h1><br>
	
	<form action="" method="POST" autocomplete="off"> 
        <div class="search-box">
            <input class="search-txt" type="text" name="valueToSearch" placeholder="Value To Search">
            <input class="search-btn" type="submit"  name="search" value="SEARCH">
        </div>
	</form>
   <table class="content-table">
        <thead>
        <tr>   
        <th>FULLNAME</th>    
        <th>USERID</th>    
        <th>DOCTORID</th>    
        <th>DISEASE</th>   
        <th>MEDICINE</th>   
        <th>MEETING</th>   
        <th>CURE</th>     
        </tr>
		</thead>

 <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
       
        <tr>
            
            <td><?php echo $row['fullname'] ?></td>
            <td><?php echo $row['userid'] ?></td>
            <td><?php echo $row['docid'] ?></td>
            <td><?php echo $row['disease'] ?></td>
            <td><?php echo $row['medicine'] ?></td>
            <td><?php echo $row['meet'] ?></td>
            <td><?php echo $row['message'] ?></td>
	    </tr>
         
		

<?php endwhile;?>
        </table>
		   </body>
</html>
