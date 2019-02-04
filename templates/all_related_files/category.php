<?php
    $category = new CategoryController();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $errors = $category->setCategory($_REQUEST);
      }
?>
<section class="category">
    <div class="container">
        <div class="row">
            <!-- this is for category add from -->
            <div class="col-md-8 offset-md-2">
                <div class="card" style="margin-top:10px;">
                    <div class="card-header text-center">
                        Add new Category
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-md-9 offset-md-1">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="category" placeholder="Enter Category">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">submit</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>

            <?php
                $allcategory = $category->getAllCategory();
                // edit category
                if (isset($_GET['editId'])) {
                    //write code later.
                }

                // edit category
                if (isset($_GET['deleteId'])) {
                    $deleteCategory = $category->deleteCategory($_GET['deleteId']);
                    if($deleteCategory) {
                        echo $deleteCategory;
                    }
                }

            ?>

            <!-- this is list of category -->
            <div class="col-md-8 offset-md-2">
                <div class="card" style="margin-top:50px;">
                    <div class="card-header text-center">
                        All Category List
                    </div>
                    <div class="card-body">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if($allcategory){
                                    $i=1;
                                    while($category = $allcategory->fetch_assoc()){
                            ?>
                                <tr>
                                    <th scope="row"> <?php echo $i; $i++; ?> </th>
                                    <td> <?php echo $category['category_name']; ?> </td>
                                    <td>                                     
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="?editId=<?php echo $category['id']; ?>" class="btn btn-info btn-sm">
                                                    <i class="far fa-question-circle"></i>
                                                    Edit
                                                </a>
                                            <a href="?deleteId=<?php echo $category['id']; ?>" class="btn btn-danger btn-sm" onclick="confirm('Are You Sure to Delete This User...?')">
                                            <i class="far fa-trash-alt"></i>
                                                Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } } ?>
                            </tbody>
                            </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
							
