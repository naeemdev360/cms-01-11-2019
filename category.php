<?php include "includes/db.php";?>

<?php include "includes/header.php";?>

    <!-- Navigation -->
<?php include "includes/navigation.php";?>
<?php
if(isset($_GET['category'])){
    $cat_id=$_GET['category'];
}

?>

    <!-- Page Content -->
    <div class="container">

    <div class="row">



        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php
            mysqli_query($connection,'SET CHARACTER SET utf8');
            mysqli_query($connection,"SET SESSION collation_connection ='utf8_general_ci'");
            $query="SELECT * FROM posts WHERE post_category_id={$cat_id}";
            $post_select_query=mysqli_query($connection,$query);
            while ($row=mysqli_fetch_assoc($post_select_query)) {
            
                ?>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $row['post_id'];?>"><?php echo $row['post_title'];?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $row['post_author'];?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $row['post_date'];?> at 10:00 PM</p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $row['post_image'];?>" alt="">
                <hr>
                <p><?php echo substr($row['post_content'], 0,500);?></p>
               

                <hr>
				
				<?php }?>

         
             
            
              
        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php";?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
<?php include "includes/footer.php";?>