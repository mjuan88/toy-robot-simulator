<?php
require 'Simulator.php';
$sample = array();
$validUpload = FALSE;
if (isset($_POST["submit"])) {
    if ($_FILES['uploadFile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['uploadFile']['tmp_name'])) {
        $fp = fopen($_FILES['uploadFile']['tmp_name'], 'rb');
        while (($line = fgets($fp)) !== false) {
            array_push($sample, trim($line));
        }
        $validUpload = TRUE;
        $h = new Simulator($sample);
    } else {
        $validUpload = FALSE;
    }
}


?>
<form action="index.php" method="post" enctype="multipart/form-data">
    <input type="file" name="uploadFile" id="uploadFile">
    <input type="submit" name="submit" value="Submit">
</form>
<?php
if ($validUpload) {
    ?>
    <textarea><?php echo $h->executeCommand(); ?></textarea>
    <?php
}else{ ?>
    <textarea><?php echo "Please upload a valid file :)"; ?></textarea>
<?php
}
?>
