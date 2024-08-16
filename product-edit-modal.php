<div class="modal fade" id="producteditModal<?php echo $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="product-edit-process.php?id=<?php echo $row['id']?>" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="unit">Product Breed</label>
                                <input type="text" class="form-control" name="breed" id="breed" value="<?php echo $row['breed']?>" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="product_quant">Product Stocks</label>
                                <input type="number" class="form-control" name="product_quant" id="product_quant" value="<?php echo $row['product_quant']?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="productedit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
