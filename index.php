<?php
require_once "classes/class.inc.php";
use PHPImageCompression\ImageCompression;

$compress = new ImageCompression;

if (isset($_POST['submit'])) {
    // Set the needed parameters
    $image = $_FILES['image']; //Image Upload
    $originalUploadDir = 'images'; //Original Upload Directory
    $compressedUploadDir= 'compressed'; //Compressed Upload Directory
    $quality = $_POST['quality']; //Set the quality 1-100.

    $upload = $compress->GetImage($image, $originalUploadDir, $compressedUploadDir, $quality);
    if ($upload) {
        $errorMsg = "Success";
    } else {
        $errorMsg = "Failed";
    }
    $uploadName = $upload;
    $original = "$originalUploadDir/$uploadName";
    $compressed = "$compressedUploadDir/$uploadName";
    $originalSize = round(filesize($original)/1024);
    $compressedSize =round(filesize($compressed)/1024);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <title>PHP Image Compression and Upload</title>
</head>

<body>
    <section>
        <div class="center">
            <h3>PHP Image Compression and Upload</h3>
        </div>
        <?php if (isset($quality)) {
    print "<div class='center'><h5>Compression at $quality%</h5></div>";
}
        ?>
        <div class="container center">
            <div>
                <span>
                    <?php if (isset($errorMsg)) {
            echo $errorMsg;
            unset($errorMsg);
        }
                    ?>
                </span>
            </div>
            <div>
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>Upload Image</span>
                            <input type="file" name="image" accept="image/*">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                        <span>(5MB max)</span>
                    </div>
                    <div class="row col s12 m6 l6">
                        <input type="number" name="quality" placeholder="Enter Quality (1-100)" required>
                    </div>
                    <div class="row col s12 m6 l6">
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
        <?php if (isset($uploadName)) {
                        print "
                <div class='container row'>
                    <div class='col s12 m6'>
                        <a target='_blank' href='$original'><img class='activator' src='$original' width='400'></a>
                        <div class='center'>Original Image($originalSize)KB</div>
                    </div>
                    <div class='col s12 m6'>
                        <a target='_blank' href='$compressed'><img class='activator' src='$compressed' width='400'></a>
                        <div class='center'>Compressed Image($compressedSize)KB</div>
                    </div>
                </div>";
                    }
        ?>
        <div class="center">
            <h6>Get Connected with me on Twitter <a target="_blank" href="https://twitter.com/heavykenny">@heavykenny</a></h6>
        </div>
    </section>
</body>

</html>