
<div class="modal fade" id="deleteModal<?php echo $rows['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="category-delete-process.php?id=<?php echo $rows['id']?>" method="post">
                    <p>Are you sure you want to delete this Category <?php echo $rows['breed']?>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-danger" name="delete">Submit</button>
            </div>
            </form>
            </div>
        </div>
        </div>