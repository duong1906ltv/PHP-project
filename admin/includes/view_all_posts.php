<table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Tags</th>
                                <th>Comments</th>
                                <th>Date</th>
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
                                echo "<td>{$post_id}</td>";
                                echo "<td>{$post_author}</td>";
                                echo "<td>{$post_title}</td>";
                                echo "<td>{$post_category_id}</td>";
                                echo "<td>{$post_status}</td>";
                                echo "<td><img width='100' src='../images/{$post_image}' alg='image'/></td>";
                                echo "<td>{$post_tags}</td>";
                                echo "<td>{$post_comment_count}</td>";
                                echo "<td>{$post_date}</td>";

                                echo "</tr>";
                            }
                        ?>
                            <tr>
                                <th>10</th>
                                <th>Edwin Diaz</th>
                                <th>Bootstrap framework</th>
                                <th>Bootstrap</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Tags</th>
                                <th>Comments</th>
                                <th>Date</th>
                            </tr>
                        </tbody>
                    </table> 