<?php
include 'conn.php';

if (isset($_GET['id']) && isset($_POST['edit'])) {
    $id = $_GET['id'];
    $breed = $_POST['breed'];
    $img = $_FILES['image']['name'];

    if (!empty($img)) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($img);

        // Attempt to move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $update = $conn->prepare("UPDATE db_category SET breed = ?, img = ? WHERE id = ?");
            $update->bind_param("ssi", $breed, $img, $id);
        } else {
            echo "<script>alert('Failed to upload image');window.location.href='inventory-category.php'</script>";
            exit();
        }
    } else {
        $update = $conn->prepare("UPDATE db_category SET breed = ? WHERE id = ?");
        $update->bind_param("si", $breed, $id);
    }

    if ($update->execute()) {
        echo "<script>alert('UPDATED');window.location.href='inventory-category.php'</script>";
    } else {
        echo "<script>alert('Failed to update category');window.location.href='inventory-category.php'</script>";
    }
}
?>
