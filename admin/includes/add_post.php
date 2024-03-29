
<?php
    if(isset($_POST['publish'])){
        $post_title=$_POST['title'];
        $post_category_id=$_POST['post_category_id'];
        $post_author=$_POST['author'];
        $post_status=$_POST['status'];
        $post_image=$_FILES['image']['name'];
        $post_image_temp=$_FILES['image']['tmp_name'];
        $post_tags=$_POST['tags'];
        $post_content=$_POST['content'];
        $post_date=date('d-m-y');
      


        move_uploaded_file($post_image_temp,"../images/$post_image");

        $query="INSERT INTO posts(post_title,post_category_id,post_author,post_status,post_image,post_tags,post_content,post_date)";
        $query.="VALUES('$post_title','$post_category_id','$post_author','$post_status','$post_image','$post_tags','$post_content',now())";
        $create_post_query=mysqli_query($connection,$query);
        confirm($create_post_query);
        $last_id=mysqli_insert_id($connection);
        echo "<p class='bg-success'>Post Created: <a href='../post.php?p_id={$last_id}'>View Post</a> or <a href='posts.php'>Add More Post</a></p>";

    }
?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label for="post_category">
            Post Category Id
        </label>
        <select class="form-control" name="post_category_id" id="category">
            <?php
            $query="SELECT * FROM categories";
            $post_category=mysqli_query($connection,$query);
            confirm($post_category);
            while ($row=mysqli_fetch_assoc($post_category)){

                echo "<option  value='{$row['cat_id']}'>{$row['cat_title']}</option>";
            }

            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="author">
            Post Author
        </label>
        <input id="author" type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
        <label for="status">
            Post Status
        </label>
        <select name="status" id="" class="form-control">
            <option value="published" >
                Published
            </option>
            <option value="draft">
                draft
            </option>
        </select>
    <div class="form-group">
        <label for="image">
            Post Image
        </label>
        <input type="file" class="form-control" name="image">
    </div>
    <div class="form-group">
        <label for="tags">
            Post Tags
        </label>
        <input type="text" class="form-control" name="tags">
    </div>
    <div class="form-group">
        <label for="content">
            Post Content
        </label>

        <textarea name="content" class="form-control" id="body" cols="30" rows="30"></textarea>
    </div>
    <input type="submit" name="publish" value="Publish Post" class="btn btn-primary">
</form>
        <script>
    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );
</script>