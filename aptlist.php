<?php

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `pattable` INNER JOIN `appointment` ON pattable.userid=appointment.userid WHERE CONCAT(pattable.userid,pattable.email,pattable.phoneno,pattable.gender,appointment.docid,appointment.userstatus,appointment.doctorstatus,appointment.specialization,appointment.consultancyfees,appointment.appointmenttime,appointment.appointmentdate) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `pattable` INNER JOIN `appointment` ON pattable.userid=appointment.userid ";
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
<title>Appointment Details</title>

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
        <a class="float-right" href="adminpage.html" style="font-size:20px;color:white;text-decoration:none;font-family:sofia;"><h4><i class="fa fa-backward" aria-hidden="true"> Back</i> </h4></a>
    </div>  
	<h1 style="color:indigo">FULL DETAILS ABOUT THE APPOINTMENT </h1><br>
    
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
        <th>USERID</th>  
        <th>DOCTORID</th>   		
        <th>DISEASE</th>   		
        <th>EMAIL</th>   
        <th>PHONENUMBER</th>   
        <th>GENDER</th>   
        <th>SPECIALIZATION</th>   
        <th>APPOINTMENT DATE</th>   
        <th>APPOINTMENT TIME</th>   
        <th>CONSULTANCY FEES</th>   
        <th>STATUS</th>      
        <th>ACTION</th>      
        </tr>
       </thead>    
	 
 <!-- populate table from mysql database -->
                <?php $count=0;while($row = mysqli_fetch_array($search_result)):
				$count+=1;
				?>
        
        <tr>     
        <td><?php echo $count; ?></td>
        <td><?php echo $row['userid']; ?></td>
		 <td><?php echo $row['docid']; ?></td>
		 <td><?php echo $row['disease']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['phoneno']; ?></td>
        <td><?php echo $row['gender']; ?></td>
        <td><?php echo $row['specialization']; ?></td>
       
        <td><?php echo $row['appointmentdate']; ?></td>
        <td><?php echo $row['appointmenttime']; ?></td>
        <td><?php echo $row['consultancyfees']; ?></td>   
        <td>		
        <?php
		           if(($row['userstatus']==1) && ($row['doctorstatus']==1))  
                    {
                      echo "Active";
                    }
                    if(($row['userstatus']==0) && ($row['doctorstatus']==1))  
                    {
                      echo "Cancelled by Patient";
                    }

                    if(($row['userstatus']==1) && ($row['doctorstatus']==0))  
                    {
                      echo "Cancelled By the Doctor";
                    }
					 if(($row['userstatus']==0) && ($row['doctorstatus']==0))  
                    {
                      echo " Appointment Expired";
                    }
        ?> 
		</td>
		<form action="appdeleted.php" method="POST" role="form">
        <td><input type='hidden' name='Sno' value='<?php echo $row['sno']?>'/>
        <input type='submit' class='btn' name='submit' style="outline:none;"onclick='return checkdelete()' value='DELETE' /></td>
        </form>
		</tr>
		
		<?php endwhile;?>
    </table>
 <script>
	function checkdelete(){
		return confirm('Are You Sure You Want Delete This Appointment');
	}
	</script>
        
    </body>
</html>
