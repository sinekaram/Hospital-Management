<?php
session_start();
$user=$_SESSION['userid'];
if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `appointment` WHERE userid='$user' AND CONCAT( `sno`, `userid`, `docid`, `specialization`, `disease`, `appointmentdate`, `appointmenttime`, `consultancyfees`, `userstatus`, `doctorstatus`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `appointment` where userid='$user' ";
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
<title>Patient Appointments</title>

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
		border-radius:5px,5px,0px,0px;
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
		font-family:sofia;
		color:yellow;
		width:70px;
		height:30px;
		border-radius:30%;
	}
	.btn:hover{
		background-color:green;
		color:white;
	}
	
	
	 </style>
    </head>
<body>
    <div class="link">
        <a class="float-right" href="patientpage.php" style="font-size:20px;color:white;text-decoration:none;font-family:sofia;"><h4><i> Back</i> </h4></a>
    </div> 
	<h1 style="color:indigo;">YOUR APPOINTMENTS</h1><br>
	
	<form action="" method="POST" autocomplete="off"> 
        <div class="search-box">
            <input class="search-txt" type="text" name="valueToSearch" placeholder="Value To Search">
            <input class="search-btn" type="submit"  name="search" value="SEARCH">
        </div>

   <table class="content-table">
        <thead>
        <tr>
        <th>USER ID</th>   
        <th>SPECIALIZATION</th>   
        <th>DOCTOR ID</th>   
        <th>DISEASE</th>   
        <th>APPOINTMENT DATE</th>   
        <th>APPOINTMENT TIME</th>   
        <th>CONSULTANCY FEES</th>   
        <th>YOUR STATUS</th>      
        <th>ACTION</th>   
        </tr>
		</thead>
	</form>
 <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
       
        <tr>
            
            <td><?php echo $row['userid'] ?></td>
            <td><?php echo $row['specialization'] ?></td>
            <td><?php echo $row['docid'] ?></td>
            <td><?php echo $row['disease'] ?></td>
            <td><?php echo $row['appointmentdate'] ?></td>
            <td><?php echo $row['appointmenttime'] ?></td>
            <td><?php echo $row['consultancyfees'] ?></td>
			<td> 
		<?php
		           if(($row['userstatus']==1) && ($row['doctorstatus']==1) && ($row['action']==0))  
                    {
                      echo "Active";
					  
                    }
					 if(($row['userstatus']==1) && ($row['doctorstatus']==1) && ($row['action']==1))  
                    {
                      echo "Your Appointment accepted <br>wait for the Report";
					  
                    }
                    if(($row['userstatus']==0) && ($row['doctorstatus']==1)&& ($row['action']==0))  
                    {
                      echo "Cancelled by Yourself";
                    }

                    if(($row['userstatus']==1) && ($row['doctorstatus']==0)&&($row['action']==0))  
                    {
                      echo "Cancelled By the Doctor";
                    }
					
                      ?> 
        </td>
		
			<td>
			 <form method="POST" action="patstatus.php">
			 <input type='hidden' name='SNo' value="<?php echo $row['sno'] ?>"/>
			 <?php
			 if(($row['userstatus']==1) && ($row['doctorstatus']==1)&& ($row['action']==0))  
                    {
                        echo "<input class='btn' type='submit' name='cancel' onclick='return checkcancel()' value='Cancel'/>";
					}
					?>
			</form>
            </td>
		
			</tr>
         
		

<?php endwhile;?>
        </table>
		        <script>
	function checkcancel(){
		return confirm('Are You Sure You Want Cancel Your Appointment');
	}
	</script>
    </body>
</html>
