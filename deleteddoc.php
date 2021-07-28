<?php

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `deleted_doc` WHERE CONCAT(`docid`, `docname`, `specilaization`, `password`, `confirmpassword`, `consultancyfees`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `deleted_doc` ";
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
<title>Deleted doctors</title>
<style>
    body{
	   width:500px;
       height:1000px;
       background:white;
    }
  
    .content-table{
		border-collapse:collapse;
		margin:25px 0;
		font-size:1.5em;
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
        <a class="float-right" href="adminpage.html" style="font-size:20px;color:white;text-decoration:none;font-family:sofia;"><h4> Back</h4></a>
    </div>
	<h1 style="color:indigo;">DELETEd DOCTORS LIST</h1><br>

	<form action="" method="POST" autocomplete="off"> 
        <div class="search-box">
            <input class="search-txt" type="text" name="valueToSearch" placeholder="Value To Search">
            <input class="search-btn" type="submit"  name="search" value="SEARCH">
        </div>  
    </form>
   <table class="content-table">
        <thead>
        <tr>  
        <th>DOCTORID</th>     
        <th>DOCTORNAME</th> 
        <th>SPECIALIZATION</th> 		
        <th>PASSWORD</th>   
        <th>CONFIRMPASSWORD</th>   
        <th>CONSULTANCY FEES</th>           
        <th>ACTION</th>      
        </tr>
        </thead>
		
 <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
        
        <tr>
        
        <td><?php echo $row['docid'] ?></td>
        <td><?php echo $row['docname'] ?></td>
        <td><?php echo $row['specilaization'] ?></td>
        <td><?php echo $row['password'] ?></td>
        <td><?php echo $row['confirmpassword'] ?></td>
        <td><?php echo $row['consultancyfees'] ?></td>
		<form action="docadded.php" method="POST" role="form">
        <td><input type='hidden' name='docid' value='<?php echo $row['docid']?>'/>
		<input type='hidden' name='docname' value='<?php echo $row['docname']?>'/>
		<input type='hidden' name='specilaization' value='<?php echo $row['specilaization']?>'/>
		<input type='hidden' name='password' value='<?php echo $row['password']?>'/>
		<input type='hidden' name='confirmpassword' value='<?php echo $row['confirmpassword']?>'/>
		<input type='hidden' name='consultancyfees' value='<?php echo $row['consultancyfees']?>'/>
        <input type='submit' class='btn'style="outline:none;" name='submit' onclick='return checkadd()' value='ADD' /></td>
		
        </form>
        </tr>
      

<?php endwhile;?>
        </table>
   
        <script>
	function checkadd(){
		return confirm('Are You Sure You Want Add This Doctor');
	}
	</script>
    </body>
</html>
