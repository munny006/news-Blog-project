<?php include "header.php"; 

include('config.php');
if ($_SESSION['user_role'] == '0') {
  header("Location:{$hostname}/admin/post.php");

}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">

                <?php

                 $limit = 3;//pagination ar code
                
                 //pagination code
                 if(isset($_GET['page'])){ //pagination code
                  $page = $_GET['page']; //pagination code
                 }
                 else{
                  $page=1; //pagination code
                 }  //pagination code

                $offset = ($page -1) * $limit; //pagination ar code
                $sql = "SELECT * FROM user ORDER BY user_id DESC LIMIT {$offset}, {$limit}";
                $result = mysqli_query($conn,$sql) or die("No OUtput.....");
                if (mysqli_num_rows($result) > 0) {

                ?>
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php
                        while($row = mysqli_fetch_assoc($result))
                        {

                        ?>
                          <tr>
                              <td class='id'><?php echo $row['user_id'];?></td>
                              <td><?php echo $row['first_name'] ."".$row['last_name'];?></td>
                              <td><?php echo $row['username'];?></td>
                              <td><?php 

                              if ($row['role'] == 1) {
                                    echo "Admin";
                              }
                              else{
                                echo "Normal";
                              }


                              ?></td>
                              <td class='edit'><a href='update-user.php?id=<?php echo $row["user_id"];?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete.php?id=<?php echo $row["user_id"];?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                         
                          <?php

                        }

                          ?>
                      </tbody>
                  </table>
                  <?php
                }

                //pagination code
                $sql1="SELECT * FROM user";
                $run = mysqli_query($conn,$sql1) or die("no pagination");

                if (mysqli_num_rows($run) > 0) {
                  $total_record = mysqli_num_rows($run);
                 
                  $total_page = ceil( $total_record / $limit);

                  echo '<ul class="pagination admin-pagination">';

                  if($page > 1){

                  echo '<li><a href="users.php?page='.($page -1).'">Prev</li>';

                  }
                  for ($i=1; $i<= $total_page; $i++) { 
                    if ($i == $page) {
                      $active = "active";
                    }
                    else{
                      $active = "";
                    }
                   echo '<li class="'.$active.'""><a href ="users.php?page='.$i.'">'.$i.'</a></li>';
                  }
                  if($total_page > $page){

                   echo '<li><a href="users.php?page='.($page +1).'">Next</li>';

                  }
                  
                  echo '</ul>';
                }

              ?>
              <!--last pagination code-->
                  
               
              </div>
          </div>
      </div>
  </div>
<?php include "header.php"; ?>
