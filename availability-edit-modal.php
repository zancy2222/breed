<div class="modal fade" id="availabilityeditModal<?php echo $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">     
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Availability</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="availability-edit-process.php?id=<?php echo htmlspecialchars($row['id']); ?>" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input type="text" class="form-control" name="product_name" id="product_name" value="<?php echo htmlspecialchars($row['product_name']); ?>" required>
                            </div><br>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="product_achieve">Achievements</label>
                                <input type="text" class="form-control" name="product_achieve" id="product_achieve" value="<?php echo htmlspecialchars($row['product_achieve']); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="price">Product Price</label>
                                <input type="number" class="form-control" name="price" id="price" value="<?php echo htmlspecialchars($row['price']); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="unit">Unit</label>
                                <select class="form-control" name="unit" required>
                                    <option value="" disabled>Select unit</option>
                                    <?php
                                    include 'conn.php';
                                    $unit_query = mysqli_query($conn, "SELECT * FROM db_unit");
                                    while ($unit_row = mysqli_fetch_assoc($unit_query)) {
                                        ?>
                                        <option value="<?php echo htmlspecialchars($unit_row['unit']); ?>" <?php if ($unit_row['unit'] == $row['unit']) echo 'selected'; ?>><?php echo htmlspecialchars($unit_row['unit']); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="availabilityedit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
