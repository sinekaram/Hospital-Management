<?php
session_start();
$userid=$_SESSION['userid'];
if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `prescription` WHERE userid='$userid' AND CONCAT( `sno`, `docid`, `userid`, `disease`, `medicine`, `meet`, `message`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `prescription` where userid='$userid' ";
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
	.btn{
		background-color:indigo;
		border: none;
		color: white;
		text-align: center;
		font-size: 16px;
		margin: 4px 2px;
		opacity: 0.6;
		width:170px;
		height:30px;
		transition: 0.3s;
		border-radius:8px;
		 opacity: 1;
	}
	.btn:hover{
		background-color:indigo;;
		color:white;
	}
    #btn{
		background-color:indigo;
		border: none;
		color: white;
		text-align: center;
		font-size: 16px;
		margin: 4px 2px;
		opacity: 0.6;
		width:170px;
		height:30px;
		transition: 0.3s;
		border-radius:8px;
		 opacity: 1;
    }

    #btn:hover {
	   background-color:indigo;
	}
	
	
	 </style>
    </head>
<body>
    <div class="link">
        <a class="float-right" href="patientpage.php" style="font-size:20px;color:white;text-decoration:none;font-family:sofia;"><h4><i class="fa fa-backward" aria-hidden="true"> Back</i>		</h4></a>
    </div> 
	<h1 style="color:indigo;">REPORT DETAILS</h1><br>
	
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
        <th>FEES</th>
		<th>PAYMENTSTATUS</th>  		
        <th>ACTION</th>     
        </tr>
		</thead>
	
 <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
       
        <tr>
            <td><?php echo $row['fullname'] ?></td>
            <td><?php echo $row['userid'] ?></td>
            <td><?php echo $row['docid'] ?></td>
            <td><?php echo $row['disease'] ?></td>
            <td><?php echo $row['cfees'] ?></td>
			<td>
			<?php
			 if(($row['status']==1))  {
				 echo "Paid";
			 }
			 else {
				 echo "Pending";
			 }
			 ?>
			</td>
			<td>
			   <form method="POST" action='viewpres.php'>
			   <input type='hidden' name='fullname' value='<?php echo $row['fullname'] ?>'/>
			   <input type='hidden' name='userid' value='<?php echo $row['userid'] ?>'/>
			   <input type='hidden' name='docid' value='<?php echo $row['docid'] ?>'/>
			   <input type='hidden' name='disease' value='<?php echo $row['disease'] ?>'/>
			   <input type='hidden' name='medicine' value='<?php echo $row['medicine'] ?>'/>
			   <input type='hidden' name='fees' value='<?php echo $row['cfees'] ?>'/>
			   <?php
					if(($row['status']==1))  {
                        echo "<input id='btn' type='submit' style='outline:none' name='pay'  value='View Report' onclick='return genereatepres();'/>";
			 }?>
			 </form>
			   <form method="POST" action='paybill.php'>
			   <input type='hidden' name='SNo' value='<?php echo $row['sno'] ?>'/>
			 <?php
					 if(($row['status']==0))  {
                        echo "<input class='btn' type='submit' style='outline:none' name='pay'  value='Pay Bill' onclick='return bill();'/>";
        		    }
					?>
				</form>
			</td>
	    </tr>
		 <?php endwhile;?>
		</table>
		<script>
		function genereatepdf(){
			return confirm('Are You Sure You Want To Download The Prescription');
		}
		function bill(){
			return confirm('Are You Sure You Want To Pay The Bill');
		}

		</script>
 </body>
</html>
