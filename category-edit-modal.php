<div class="modal fade" id="editModal<?php echo $rows['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">     
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="category-edit-process.php?id=<?php echo $rows['id']?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="breed">Breed</label>
                                <input type="text" class="form-control" name="breed" id="breed" value="<?php echo $rows['breed']?>" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="image">Category Image</label>
                                <input type="file" class="form-control" id="img" name="image" accept=".jpg, .jpeg, .png">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="edit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
