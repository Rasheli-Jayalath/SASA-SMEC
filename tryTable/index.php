

<?php 
include_once("config/config.php");
  $dbconn =       new Database();
  $objCmdArea =   new CommandArea();
  $canalNet =     new CanalNetworks();
  $objUser =      new Users();
  $objCanalUser = new CanalUsers();
  $objUserCrops = new UsersCrops();
  $objCrops =     new Crops();
  $objTimescale = new Timescale();
  $objReports =   new Reports();
?>
<?php
$con = mysqli_connect("localhost", "root", "", "sas20210601");
$query = "SELECT * FROM wh_000_network_canals ORDER BY nc_id DESC";
$result = mysqli_query($con, $query);
?>

<html>  
 <head>  
          <title>Live Table Data Edit Delete using Tabledit Plugin in PHP</title>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>            
    <script src="jquery.tabledit.min.js"></script>
    </head>  
    <body>  
  <div class="container">  
   <br />  
   <br />  
   <br />  
            <div class="table-responsive">  
    <h3 align="center">Live Table Data Edit Delete using Tabledit Plugin in PHP</h3><br />  
    <table id="editable_table" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>ID</th>
       <th>First Name</th>
       <th>Last Name</th>
      </tr>
     </thead>
     <tbody>
     <?php
     while($row = mysqli_fetch_array($result))
     {
      echo '
      <tr>
       <td>'.$row["nc_id"].'</td>
       <td>'.$row["nc_code"].'</td>
       <td>'.$row["nc_name"].'</td>
      </tr>
      ';
     }
     ?>
     </tbody>
    </table>
   </div>  
  </div>  
 </body>  
</html>  
<script>  
$(document).ready(function(){  
     $('#editable_table').Tabledit({
      url:'action.php',
      columns:{
       identifier:[0, "nc_id"],
       editable:[[1, 'nc_code'], [2, 'nc_name']]
      },
      restoreButton:false,
      onSuccess:function(data, textStatus, jqXHR)
      {
       if(data.action == 'delete')
       {
        $('#'+data.id).remove();
       }
      }
     });
 
});  
 </script>