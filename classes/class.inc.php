<?php
namespace PHPImageCompression;

class ImageCompression
{
    // Image compression function.
    public function CompressImage($imageSource, $destinationDir, $quality)
    {
        $image_info = getimagesize($imageSource);
        
        if ($image_info['mime'] == 'image/jpeg') {
            $image = imagecreatefromjpeg($imageSource);
        } elseif ($image_info['mime'] == 'image/gif') {
            $image = imagecreatefromgif($imageSource);
        } elseif ($image_info['mime'] == 'image/png') {
            $image = imagecreatefrompng($imageSource);
        } elseif ($image_info['mime'] == 'image/jpg') {
            $image = imagecreatefrompng($imageSource);
        }
        imagejpeg($image, $destinationDir, $quality);
        
        return $destinationDir;
    }

    // Upload and Compression.
    public function GetImage($image, $originalUploadDir, $compressedUploadDir, $quality)
    {
        $imageName = $_FILES['image']['name'];
        $imageTemp = $_FILES['image']['tmp_name'];
        $imageSize = $_FILES['image']['size'];

        if (empty($imageName)) {
            $errorMsg = "Can't be empty";
        }
        if ($imageSize > 5000000) {
            $errorMsg = "File is too large. (5MB max)";
        }

        $validExtentions =array('jpeg','gif','png','jpg');
        $imageExtention = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        if (in_array($imageExtention, $validExtentions)) {
            $uploadName = rand(100000, 999999).".".$imageExtention;
            move_uploaded_file($imageTemp, "$originalUploadDir/$uploadName");
            $this->CompressImage("$originalUploadDir/$uploadName", "$compressedUploadDir/$uploadName", $quality);
            // return true;
            return $uploadName;
        }
    }
}
