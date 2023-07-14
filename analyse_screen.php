<?php

if ($_FILES['screenshot']['error'] === UPLOAD_ERR_OK) {
  // Retrieve the temporary file path
  $tmpFilePath = $_FILES['screenshot']['tmp_name'];

  // Specify the destination folder to save the image
  $destinationFolder = './uploads/';

  // Generate a unique filename for the image
  $filename = uniqid() . '.png';

  // Move the uploaded image file to the destination folder
  if (move_uploaded_file($tmpFilePath, $destinationFolder . $filename)) {
    echo 'Screenshot uploaded and saved successfully.';
    // Now upload to s3
    // after uploading to s3, submit to analyse the document
  } else {
    echo 'Failed to save the uploaded screenshot.';
  }
} else {
  echo 'Error uploading the screenshot: ' . $_FILES['screenshot']['error'];
}
?>

