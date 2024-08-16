<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Categories</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="inventory-category.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Breed Name</label>
                                <input type="text" class="form-control" name="breed">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Category Image</label>
                                <input type="file" class="form-control inpt-img" id="img" name="image" accept=".jpg, .jpeg, .png">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
