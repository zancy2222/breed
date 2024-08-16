
<div class="modal fade" id="availabilitydeleteModal<?php echo $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Unit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="availability-delete-process.php?id=<?php echo $row['id']?>" method="post">
                    <p>Are you sure you want to delete this Product <?php echo $row['product_name']?>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-danger" name="availabilitydelete">Submit</button>
            </div>
            </form>
            </div>
        </div>
        </div>