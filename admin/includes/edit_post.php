<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title ?>" type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">
        <select name="post_category" id="post_category">
            <?php
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);

            confirmQuery($connection);

            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input value="<?php echo $post_author ?>" type="text" class="form-control" name="post_author">
    </div>
    <div class="form-group">
        <select name="post_status" id="post_status">
            <option value='<?php echo $post_status; ?>'><?php echo $post_status; ?></option>
            <?php

            if ($post_status == 'published') {
                echo "<option value='draft'>Draft</option>";
            } else {
                echo "<option value='published'>Publish</option>";
            }

            ?>
        </select>
    </div>
    <div class="form-group">
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
        <input type="file" class="form-control" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags ?>" type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="summernote" cols="30" rows="10" class="form-control"><?php echo $post_content ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Publish Post">
    </div>
</form>