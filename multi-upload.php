<?php

if (isset($_POST['btnUpload']) && $_POST['btnUpload'] == 'Upload') {
    echo "<pre>";
    print_r($_FILES); 

    $numOfFiles = count($_FILES['fileToUpload']['name']);

    for ($i=0; $i < $numOfFiles; $i++) { 
        $fileTmpPath = $_FILES['fileToUpload']['tmp_name'][$i];
        $fileName = $_FILES['fileToUpload']['name'][$i];

        $dest_path = 'images/'.$fileName;

        if(move_uploaded_file($fileTmpPath, $dest_path)) {
            echo $fileName." uploaded successfully<br>";
        } else {
            echo $fileName." could not be uploaded<br>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data" >
        <input type="file" multiple="multiple" name="fileToUpload[]">
        <input type="submit" value="Upload" name="btnUpload">
    </form>
</body>
</html>