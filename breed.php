<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Modal Example</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>    
    <div class="modal fade" id="breedModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">     
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Sell Product</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name="sell_form" action="inventory-availability.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <div class="mb-3">
                            <label for="img" class="form-label" style="font-weight: bold; font-size: 15px; font-family: arial">Product Image:</label>
                            <input type="file" accept="image/png, image/jpeg, image/jpg" class="form-control" id="img" name="img" required>
                        </div>
                        <div class="mb-3">
                            <label for="breed" class="form-label" style="font-weight: bold; font-size: 15px; font-family: arial">Product Breed:</label>
                            <input type="text" class="form-control" id="breed" name="breed" value="<?php echo $row['breed']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="product_name" class="form-label" style="font-weight: bold; font-size: 15px; font-family: arial">Product Name:</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="hatched" class="form-label" style="font-weight: bold; font-size: 15px; font-family: arial">Hatched Date:</label>
                            <input type="text" class="form-control" id="hatched" name="hatched" value="<?php echo $row['hatched']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="age" class="form-label" style="font-weight: bold; font-size: 15px; font-family: arial">Age:</label>
                            <input type="text" class="form-control" id="age" name="age" value="<?php echo $row['age']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="product_weight" class="form-label" style="font-weight: bold; font-size: 15px; font-family: arial">Weight:</label>
                            <input type="text" class="form-control" id="product_weight" name="product_weight" required>
                        </div>
                        <div class="mb-3">
                            <label for="product_hei" class="form-label" style="font-weight: bold; font-size: 15px; font-family: arial">Height:</label>
                            <input type="text" class="form-control" id="product_hei" name="product_hei" required>
                        </div>
                        <div class="mb-3">
                            <label for="product_achieve" class="form-label" style="font-weight: bold; font-size: 15px; font-family: arial">Achievements:</label>
                            <input type="text" class="form-control" id="product_achieve" name="product_achieve" value="<?php echo $row['product_achieve']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="unit" class="form-label" style="font-weight: bold; font-size: 15px; font-family: arial">Unit:</label>
                            <select class="form-control" name="unit" required>
                                <option value="" disabled selected>Select Unit</option>
                                <?php
                                include 'conn.php';
                                $unit_query = mysqli_query($conn, "SELECT * FROM db_unit");
                                while ($unit_row = mysqli_fetch_assoc($unit_query)) {
                                    echo '<option value="' . $unit_row['unit'] . '">' . $unit_row['unit'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label" style="font-weight: bold; font-size: 15px; font-family: arial;">Product Price:</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="product_quant" class="form-label" style="font-weight: bold; font-size: 15px; font-family: arial;">Quantity to Sell:</label>
                            <input type="number" class="form-control" id="product_quant" name="product_quant" value="1" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="save" class="btn btn-primary" style="font-weight: bold; font-size: 15px; font-family: Arial;">Sell</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="font-weight: bold; font-size: 15px; font-family: Arial;">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.min.js"></script>
</body>
</html>
