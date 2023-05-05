<?php

if (isset($_POST['btnUpload']) && $_POST['btnUpload'] == 'Upload') {
    // echo "<pre>";
    // print_r($_FILES); 

    $numOfFiles = count($_FILES['fileToUpload']['name']);
    $maxFileSize = (1024 * 1024) * 5;
    $fileTypes = ["image/jpg", "image/jpeg", "image/png"];

    if ($numOfFiles > 3) {
        die("Cannot upload more than 3 files");
    }

    for ($i=0; $i < $numOfFiles; $i++) { 
        $fileTmpPath = $_FILES['fileToUpload']['tmp_name'][$i];
        $fileName = $_FILES['fileToUpload']['name'][$i];
        $fileSize = $_FILES['fileToUpload']['size'][$i];
        $fileType = $_FILES['fileToUpload']['type'][$i];

        if(in_array($fileType, $fileTypes)) {

            if($fileSize > $maxFileSize) {

                echo "file size exceeds<br>";
                echo "max file size could be 5MB";

            } else {
                $fileName_Arr = explode(".", $fileName);
                $nameOfFile = $fileName_Arr[0];
                $typeOfFile = $fileName_Arr[1];

                $new_fileName = $nameOfFile."-".substr(md5(rand()), 0, 6).".".$typeOfFile;

                $dest_path = "images/".$new_fileName;

                if(move_uploaded_file($fileTmpPath, $dest_path)) {
                    echo $new_fileName." uploaded successfully<br>";
                } else {
                    echo $new_fileName." could not be uploaded<br>";
                }
            }

        } else {
            echo "file type couldn't be accepted. <br>";
            echo "the accepted file types: ".str_replace("image/", "", implode(', ', $fileTypes))."<br>"; 
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