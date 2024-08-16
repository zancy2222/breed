<style>
    .modal-body .form-group label {
        font-size: 18px;
    }
    .modal-body .form-control {
        height: 45px;
        font-size: 13px;
    }
</style>
<div class="modal fade" id="productsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Add Hen</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
                <div class="col-md-12">
                            <div class="form-group">
                            <label for="img" style="font-weight: bold; font-size: 15px; font-family: arial">Hen Image:</label>
                            <input type="file" accept="image/png, image/jpeg, image/jpg" class="form-control" id="img" name="img" required><br>
                            </div>
                        </div>
                           <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="breed" style="font-weight: bold; font-size: 15px; font-family: arial">Breed Name</label>
                                    <select class="form-control" name="breed" required>
                                    <option value="" disabled selected>Select Breed</option>
                                    <?php
                                    include 'conn.php';
                                    $breeds_query = mysqli_query($conn, "SELECT * FROM db_category");
                                    while ($row = mysqli_fetch_assoc($breeds_query)) {
                                        ?>
                                        <option value="<?php echo $row['breed']; ?>"><?php echo $row['breed']; ?></option>
                                    <?php } ?>
                                </select>
                            </div><br>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" style="font-weight: bold; font-size: 15px; font-family: arial">Hatched Date</label>
                                <input type="datetime-local" class="form-control" name="hatched" required>
                            </div><br>
                        </div><br>
                        <div class="col-md-12">
                            <div class="form-group" style="font-weight: bold; font-size: 15px; font-family: arial">
                                <label for="" style="font-weight: bold; font-size: 15px; font-family: arial">Achievements</label>
                                <input type="text" class="form-control" name="product_ski">
                            </div><br>
                        </div><br>
                        <div class="col-md-12">
                            <div class="form-group" style="font-weight: bold; font-size: 15px; font-family: arial">
                                <label for="" style="font-weight: bold; font-size: 15px; font-family: arial">Hen Produce</label>
                                <input type="text" class="form-control" name="hen_produce">
                            </div><br>
                        </div><br>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" style="font-weight: bold; font-size: 15px; font-family: arial">Product Quantity</label>
                                <input type="number" class="form-control" name="product_quant" value="1" readonly>
                            </div><br>
                        </div>
                    </div><br><br>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="add_product"  style="font-size: 18px;">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  style="font-size: 18px;">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
