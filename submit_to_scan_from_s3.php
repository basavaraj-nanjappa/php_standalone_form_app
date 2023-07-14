<?php

include "upload_to_s3.php";

// Get the uploaded file
$file = $_FILES['file'];

// Check if the file was uploaded successfully
if ($file['error'] === UPLOAD_ERR_OK) {

    // Generate a unique filename for the uploaded file
    $filename = uniqid() . '-' . $file['name'];

    $result = upload_to_s3($file['tmp_name'], $filename);

    echo 'File uploaded successfully. URL: ' . $result['ObjectURL'];
    
} else {
    echo 'Error uploading file: ' . $file['error'];
}
