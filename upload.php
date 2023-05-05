<?php

if(isset($_POST['btnUpload']) && $_POST['btnUpload'] == 'Upload') {
  
   
    if(isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']["error"] == 0) {

        $uploadOk = 1;
        $fileTmpPath = $_FILES["fileToUpload"]["tmp_name"];
        $fileName = $_FILES["fileToUpload"]["name"];
        $file_extensions = ["jpg", "jpeg", "png"];

        # dosya secilmis mi
        if(empty($fileName)) {
            echo "choose file to upload<br>";
            $uploadOk = 0;
        }

        # dosya boyutu
        $fileSize = $_FILES["fileToUpload"]["size"];
        if($fileSize > 500000) { #500KB
            echo "file size is too big<br>";
            $uploadOk = 0;
        }

        # dosya uzantisi 
        $fileName_Arr = explode(".", $fileName);
        $nameOfFile = $fileName_Arr[0];
        $extensionOfFile = $fileName_Arr[1];

        if(!in_array($extensionOfFile, $file_extensions)) {
            echo "file couldn't be accepted. <br>";
            echo "the accepted file extensions: ".implode(', ', $file_extensions)."<br>";
            $uploadOk = 0;
        }

        # dosya ismi -> random isim 
        // $new_fileName = md5(time().$nameOfFile).".".$extensionOfFile; # Dosyanin yüklendigi zamani kullanarak ve md5 yöntemi ile sifreleyerek dosyanin adini degistirme
        $new_fileName = $nameOfFile."-".rand().".".$extensionOfFile; # Dosyanin ismini kullanarak ve random sayi üreterek dosyanin adini degistirme

        $uploadFolder = "./files/";
        $dest_path = $uploadFolder.$new_fileName;

        if($uploadOk == 0) {
            echo "file could not be uploaded<br>";
        } else {
            if(move_uploaded_file($fileTmpPath, $dest_path)) {
                echo "file uploaded successfully<br>";
            } else {
                echo "Error uploading file<br>";
            }
        }
    } else {
        echo "Sorry, there was an error uploading";
        echo "ERROR: ".$_FILES['fileToUpload']['error'];
    }  
}

?>