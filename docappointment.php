<?php

session_start(); 
$docid=$_SESSION['docid'];
if(isset($_POST['search']))
{
     $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `pattable` INNER JOIN `appointment` ON pattable.userid=appointment.userid WHERE docid='$docid'  AND   CONCAT(pattable.userid,pattable.email,pattable.phoneno,pattable.gender,appointment.docid,appointment.specialization,appointment.consultancyfees,appointment.appointmenttime,appointment.appointmentdate) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT  * FROM `pattable` INNER JOIN `appointment` ON pattable.userid=appointment.userid where docid='$docid' ";
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
<title>Doctor's Appointment details</title>

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
   .pres{
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

    .pres:hover {
	    background-color:indigo;
	}
	
	
	
	
        </style>
    </head>
<body>
     <div class="link">
        <a class="float-right" href="docpage.php" style="font-size:20px;color:white;text-decoration:none;font-family:sofia;"><h4><i> Back</i> </h4></a>
    </div>  
	<h1 style="color:indigo">APPOINTMENT DETAILS</h1><br>
    
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
        <th>PATIENT FULLNAME</th>   
        <th>PATIENT ID</th>   
        <th>EMAIL</th>   
        <th>CONTACT</th>   
        <th>GENDER</th>   
        <th>DISEASE</th>   
        <th>SPECIALIZATION</th>   
        <th>APPOINTMENT DATE</th>   
        <th>APPOINTMENT TIME</th>   
        <th>CONSULTANCY FEES</th>   
        <th>STATUS</th>   
        <th>ACTION</th>      
        </tr>
        </thead> 
	
  <!-- populate table from mysql database -->
    <?php
				$count=0;				
 while($row = mysqli_fetch_array($search_result)):

    $count = $count+1;
   ?>
      
        <tr class="activerow"> 
        
		 <td><?php echo $count?></td>
        <td><?php echo $row['fullname'] ?></td>
        <td><?php echo $row['userid'] ?></td>
        <td><?php echo $row['email'] ?></td>
        <td><?php echo $row['phoneno'] ?></td>
        <td><?php echo $row['gender'] ?></td>
        <td><?php echo $row['disease'] ?></td>
        <td><?php echo $row['specialization'] ?></td>
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
                      echo "Patient Appointment accepted";
					  
                    }
                    if(($row['userstatus']==0) && ($row['doctorstatus']==1)&& ($row['action']==0))  
                    {
                      echo "Cancelled by Patient";
                    }

                    if(($row['userstatus']==1) && ($row['doctorstatus']==0)&&($row['action']==0))  
                    {
                      echo "Cancelled By the Yourself";
                    }
                      ?> 
        <td>
		    <form method="POST" action='status.php'>
		        <input type='hidden' name='SNo' value='<?php echo $row['sno'] ?>'/>
            <?php
		           if(($row['userstatus']==1) && ($row['doctorstatus']==1)&&($row['action']==0))  
                    {				
                        echo "<input class='btn' type='submit' style='outline:none' name='accept'  value='Accept'/>";
				        echo "<input id='btn' type='submit' style='outline:none' name='reject'  value='Reject' />";
					}
					
				?>
			</form>
	
	    <form method="POST" action='docprescription.php'>
		    <input type='hidden' name='name' value='<?php echo $row['fullname'] ?>'/>
		    <input type='hidden' name='id' value='<?php echo $row['userid'] ?>'/>
		    <input type='hidden' name='mail' value='<?php echo $row['email'] ?>'/>
		    <input type='hidden' name='no' value='<?php echo $row['phoneno'] ?>'/>
		    <input type='hidden' name='gen' value='<?php echo $row['gender'] ?>'/>
		    <input type='hidden' name='di' value='<?php echo $row['disease'] ?>'/>
		    <input type='hidden' name='appointmentdate' value='<?php echo $row['appointmentdate'] ?>'/>
		    <input type='hidden' name='appointmenttime' value='<?php echo $row['appointmenttime'] ?>'/>
		    <input type='hidden' name='cfees' value='<?php echo $row['consultancyfees'] ?>'/>
		<?php
		if(($row['userstatus']==1) && ($row['doctorstatus']==1)&& ($row['action']==1))  
                    {
                      echo "<input class='pres' type='submit' style='outline:none' name='presc'  value='Report'/>";
                   
				   }
		?>
		</form>
			</td>
		</tr>
		
        
   <?php endwhile;?>
    </table>
	
    </body>
</html>
