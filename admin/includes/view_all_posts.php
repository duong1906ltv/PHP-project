<?php
if (isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $postValueId){
        $bulk_options = $_POST['bulk_options'];
        switch ($bulk_options) {
            case 'published':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' ";
                $query .= "WHERE post_id = '{$postValueId}' ";
                $update_to_published_status = mysqli_query($connection, $query);
                confirmQuery($update_to_published_status);
                break;
            case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' ";
                $query .= "WHERE post_id = '{$postValueId}' ";
                $update_to_draft_status = mysqli_query($connection, $query);
                confirmQuery($update_to_draft_status);
                break;
            case 'delete':
                $query = "DELETE FROM posts ";
                $query .= "WHERE post_id = '{$postValueId}' ";
                $update_to_delete_status = mysqli_query($connection, $query);
                confirmQuery($update_to_delete_status);
                break;
            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' ";
                $select_post_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_array($select_post_query)) {
                    $post_category_id = $row['post_category_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    // $post_date = now();
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_tags = $row['post_tags'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_status = "draft";
                }

                $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
                $query .= "VALUES($post_category_id, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', $post_comment_count, '{$post_status}') ";
                $copy_query = mysqli_query($connection, $query);
                confirmQuery($copy_query);

                header("Location: posts.php");
                break;
            case 'reset':
                $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($connection, $postValueId) . " ";
                $reset_query = mysqli_query($connection, $query);
                confirmQuery($reset_query);

                header("Location: posts.php");
                break;
        }
    }
}
?>
<form action="" method="POST">
    <div id="bulkOptionsContainer" class="col-xs-4">
        <select class="form-control" name="bulk_options" id="">
            <option value="">Select Options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
        </select>
    </div>
    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
    </div>
    <table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th><input id="selectAllBoxes" type="checkbox"></th>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>View Post</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $query = "SELECT * FROM posts ";
        $select_categories = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_categories)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_comment_count = $row['post_comment_count'];
            $post_title = $row['post_title'];
            $post_tags = $row['post_tags'];
            echo "<tr>";
            ?>
                <td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value=<?php echo $post_id; ?>></td>
            <?php
            echo "<td>{$post_id}</td>";
            echo "<td>{$post_author}</td>";
            echo "<td>{$post_title}</td>";
            echo "<td>{$post_category_id}</td>";
            echo "<td>{$post_status}</td>";
            echo "<td><img width='100' src='../images/{$post_image}' alt='image'/></td>";
            echo "<td>{$post_tags}</td>";
            echo "<td>{$post_comment_count}</td>";
            echo "<td>{$post_date}</td>";
            echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?');\" href='posts.php?delete={$post_id}'>Delete</a></td>";
            echo "</tr>";
        }
    ?>
    </tbody>
</table>
</form>
<?php

if (isset($_GET['delete'])) {
    $the_post_id = $_GET['delete'];

    $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
    $delete_query = mysqli_query($connection, $query);

    confirmQuery($delete_query);

    header("Location: posts.php");
}

?>