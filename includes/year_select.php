<div class="input-group me-4 ">
              <form action="table_user.php " method="get" id="filter" name="filter" class="">
                    <label style="font-size:16px;"> <strong>Year:&nbsp;&nbsp;</strong></label>
                    <select id="yr_name" name="yr_name" style="width:100px; height:25px">

                      <option value="0" >Selectin</option>
                      <?php 
                        $sql = "SELECT * FROM tbl001_year_main ORDER BY yr_name";
                        $result = mysqli_query($connection , $sql);		
                        while ($row = mysqli_fetch_array($result)){
                        echo "<option value=".$row['yr_name'].">".$row['yr_name']."</option>";                      
                        }
                      ?>  
                      
                    </select>
                    <input type="submit" id="go" value="GO"  class="bg-gradient-secondary text-white me-2 "/>
              </form>
</div>