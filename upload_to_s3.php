<?php

require 'vendor/autoload.php'; // Include the AWS SDK for PHP

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

function upload_to_s3($file_name_with_path, $objectKey) {
	// Set your AWS credentials
	$accessKeyId = 'AKIA3PDZHMKUZV4IALLT';
	$secretAccessKey = 'HOZkAn+LcX6eLKTLo6XpqOAr+hy8gKC17GlEvxtn';

	// Set the AWS region and S3 bucket name
	$region = 'us-east-1';
	$bucketName = 'oghackathon23';

    try {

        $s3Client = new S3Client([
            'version' => 'latest',
            'region' => $region,
            'credentials' => [
                'key' => $accessKeyId,
                'secret' => $secretAccessKey,
            ],
        ]);

        // Upload the file to S3
        $result = $s3Client->putObject([
            'Bucket' => $bucketName,
            'Key' => $objectKey,
            'SourceFile' => $file_name_with_path,
        ]);

        // print('File uploaded successfully. URL: ' . $result['ObjectURL']);

        return $result;

    } catch (AwsException $e) {
        echo 'Error uploading file: ' . $e->getMessage();

        return null;
    }
}