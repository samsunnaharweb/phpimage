<?php

$FileExtension  =['png','jpg','jpeg', 'pdf'];
$FileMime       =['image/png', 'image/jpeg', 'application/pdf'];
$uploadDir      ="upload/";
$maxFileSize    =5000*1000;
$fileName       ="";

function allowedFiles($tempName, $uploadPath){
    global $FileExtension, $FileMime;

    $fileExt    =pathinfo($uploadPath, PATHINFO_EXTENSION);
    $fileMime   =mime_content_type($tempName);

    $checkExt       =in_array($fileExt, $FileExtension);
    $checkMime      =in_array($fileMime, $FileMime);
    $allowedFile    =$checkExt && $checkMime;

    return allowedFile;
}

function handelFile($uploadDir, $maxFileSize){
    $tempName   =$_FILES['uploadedFile']['tmp_name'];
    $fileName   =basename($_FILES['uploadedFile']['name']);
    $isUpload   =is_uploaded_file('$tempName');
    $validSize  =$_FILES['uploadedFile']['size']<= $maxFileSize && $_FILES['uploadedFile']['size']>= 0;
    $filePath   =$uploadDir.$fileName;
    
    if($isUpload && $validSize && allowedFiles($tempName, $filePath)){
        $time       =date('ymd-His');
        $fileExt    =pathinfo($fileName, PATHINFO_EXTENSION);
        $fileName   =$time.".".$fileExt;

        if(move_uploaded_file($tempName,$fileName)){
            $message ="File upload success";
        }else{
            $message ="File not upoaded";
        }
    }else{
        $message ="ERROR: File type or File size is not valid";
    }

    return $message;
}

if(isset($_POST['submit'])){
    echo handelFile($uploadDir, $maxFileSize);
}


?>