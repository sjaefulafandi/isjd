<?php
$target_dir = "api/";
$target_file = $target_dir . basename($_FILES["thefile"]["name"]);

if ($_POST['posted'] == 'true') {
        if (move_uploaded_file($_FILES["thefile"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["thefile"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="thefile">
        <input type="hidden" name="posted" value="true">
        <button type="submit">upload</button>
</form>

