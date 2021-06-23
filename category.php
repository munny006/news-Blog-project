<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php

                $sql2="SELECT * FROM category WHERE category_id ={$cat_id}";
                $run2 = mysqli_query($conn,$sql2) or die(" no pagination ");

                $query2 = mysqli_fetch_assoc($run2);

                ?>

                  <h2 class="page-heading"><?php echo $query2['category_name'];?></h2>
                    <?php
                    include("config.php") ;

                     if (isset($_GET['cid'])) {
                         $cat_id = $_GET['cid'];
                     }


                $limit = 3;//pagination ar code
                
                 //pagination code
                 if(isset($_GET['page'])){ //pagination code
                  $page = $_GET['page']; //pagination code
                 }
                 else{
                  $page=1; //pagination code
                 }  //pagination code

                $offset = ($page -1) * $limit; //pagination ar code

       $sql = "SELECT post.post_id,post.title,post.description,post.post_date,post.author,category.category_name,user.username,post.category,post.post_img FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id
         WHERE post.category = {$cat_id} ORDER BY post.post_id DESC LIMIT {$offset}, {$limit}";
                  $result = mysqli_query($conn,$sql) or die(" No OUtput.....");
                if (mysqli_num_rows($result) > 0) { 
                     while($row = mysqli_fetch_assoc($result)){
         ?>
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $row['post_id'];?>"><img src="admin/upload/<?php echo $row['post_img'];?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $row['post_id'];?>'><?php echo $row['title'];?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?cid=<?php echo $row['category'];?>'><?php echo $row['category_name'];?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php?aid=<?php echo $row['author'];?>'><?php echo $row['username'];?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                              <?php echo $row['post_date'];?>
                                            </span>
                                        </div>
                                        <p class="description">
                                            <?php echo substr($row['description'],0,40). "....";?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id'];?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php

                    }
                }else{
                    echo "Not Found !.....";
                }


                if (mysqli_num_rows($run2) > 0) {
                  $total_record = $query2['post'];
                 
                  $total_page = ceil( $total_record / $limit);

                  echo '<ul class="pagination admin-pagination">';

                  if($page > 1){

                  echo '<li><a href="index.php?cid='.$cat_id.' &page='.($page -1).'">Prev</li>';

                  }
                  for ($i=1; $i<= $total_page; $i++) { 
                    if ($i == $page) {
                      $active = "active";
                    }
                    else{
                      $active = "";
                    }
                   echo '<li class="'.$active.'""><a href ="index.php?cid='.$cat_id.'page='.$i.'">'.$i.'</a></li>';
                  }
                  if($total_page > $page){

                   echo '<li><a href="index.php?cid='.$cat_id.'page='.($page +1).'">Next</li>';

                  }
                  
                  echo '</ul>';
                }

          ?>
                       
                        <!--<ul class='pagination'>
                            <li class="active"><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                        </ul>-->
                    </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>