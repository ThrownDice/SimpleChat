<?php
/**
 * Created by PhpStorm.
 * User: TD
 * Date: 2015-08-17
 * Time: 오후 1:51
 */

$target_dir = "upload/";
$target_file = $target_dir . date('yyyymmddHHiissuu'). basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$response = array();
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        //echo "File is not an image.";
        $response["message"] = "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    //echo "Sorry, file already exists.";
    $uploadOk = 0;
    $response["message"] = "Sorry, file already exists.";
}
// Check file size
if ($_FILES["file"]["size"] > 500000) {
    //echo "Sorry, your file is too large.";
    $uploadOk = 0;
    $response["message"] = "Sorry, your file is too large.";
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    $response["message"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    // if everything is ok, try to upload file
    $response["status"] = "error";
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
        $response["status"] = "success";
        $response["filename"] = $target_file;
    } else {
        //echo "Sorry, there was an error uploading your file.";
        $response["status"] = "error";
        $response["message"] = "Sorry, there was an error uploading your file.";
    }
}

//처리 결과를 클라언트에게 돌려줌
echo json_encode($response);

/*$array = getimagesize($target_file);

if(!empty($array)) {

    $width = $array[0];
    $height = $array[1];
    $extension = $array[2];

    $im = imagecreatefrompng("$target_file");
    $black = imagecolorallocate($im, 0, 0, 0);
    $grey = imagecolorallocate($im, 128, 128, 128);
    $black_a = imagecolorallocatealpha($im, 0,0,0, 100);

    $text = '한글...';
    //imagestring($im, 1, 10, 10, 'Hellow!', $textcolor);

    imagealphablending($im, false);
    imagesavealpha($im, true);

    $font = 'font/NanumGothicCoding-Regular.ttf';
    imagettftext($im, 11, 0, 11, 21, $black_a, $font, $text);

    imagepng($im, $target_file);
    imagedestroy($im);

    echo "<img src='{$target_file}'>";
}else{
    echo "not image";
}

var_dump($array);
*/


?>