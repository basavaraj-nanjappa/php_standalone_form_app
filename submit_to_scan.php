<?php

require 'vendor/autoload.php'; // Include the AWS SDK for PHP

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

// Set your AWS credentials
$accessKeyId = 'AKIA3PDZHMKUZV4IALLT';
$secretAccessKey = 'HOZkAn+LcX6eLKTLo6XpqOAr+hy8gKC17GlEvxtn';

// Set the AWS region and S3 bucket name
$region = 'us-east-1';
$bucketName = 'oghackathon23';

// Get the uploaded file
$file = $_FILES['file'];

// Check if the file was uploaded successfully
if ($file['error'] === UPLOAD_ERR_OK) {
    // Set up the S3 client
    $s3Client = new S3Client([
        'version' => 'latest',
        'region' => $region,
        'credentials' => [
            'key' => $accessKeyId,
            'secret' => $secretAccessKey,
        ],
    ]);

    // Generate a unique filename for the uploaded file
    $filename = uniqid() . '-' . $file['name'];

    try {
        // Upload the file to S3
        $result = $s3Client->putObject([
            'Bucket' => $bucketName,
            'Key' => $filename,
            'SourceFile' => $file['tmp_name'],
        ]);

        // Get the URL of the uploaded file
        $fileUrl = $result['ObjectURL'];

        echo 'File uploaded successfully. URL: ' . $fileUrl;
    } catch (AwsException $e) {
        echo 'Error uploading file: ' . $e->getMessage();
    }
} else {
    echo 'Error uploading file: ' . $file['error'];
}
