<?php include "includes/admin_header.php"?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Blank Page
                            <small>Subheading</small>
                        </h1>
                        <div class="col-xs-6">
                        <?php
                        if(isset($_POST['submit'])){
                            $cat_title = $_POST['cat_title'];
                            if ($cat_title ==  ""|| empty($cat_title)){
                                echo "This field should not be empty";
                            }
                            else{
                                $query = "INSERT INTO categories(cat_title) ";
                                $query .= "VALUE('{$cat_title}')";
                                echo $cat_title;
                                $create_category_query = mysqli_query($connection, $query);
                                if (!$create_category_query){
                                    die('QUERY FAILED' . mysqli_error($connection));
                                }
                            }
                        }
                        ?>



                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="cat-title">Add Category</label>
                                    <input type="text" class="form-control" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form><!--Add Category form-->
                        </div>
                        <div class="col-xs-6">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $query = "SELECT * FROM categories ";
                                $select_categories = mysqli_query($connection,$query);
                                while($row = mysqli_fetch_assoc($select_categories)){
                                    $cat_title = $row['cat_title'];
                                    $cat_id = $row['cat_id'];
                                    echo "<tr>";
                                    echo "<td>{$cat_id}</td>";
                                    echo "<td>{$cat_title}</td>";
                                    echo "<td><a href ='categories.php?delete={$cat_id}'>DELETE</a></td>";
                                    echo "</tr>";
                                }
                                ?>
                                <?php
                                if(isset($_GET['delete'])){
                                    $the_cat_id = $_GET['delete'];
                                    $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
                                    $delete_query = mysqli_query($connection,$query);
                                    header("Location: categories.php");
                                }
                                ?>
                                </tbody>

                            </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php include "includes/admin_footer.php"?>
