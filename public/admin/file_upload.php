<?php

require_once '../init.php';

include_once '../sidebar_data.php';

if (!is_admin()) {
    header('Location: index.php');
    exit;
}

// upload the file to the server's /uploads directory
$target_dir = __DIR__ . "/../uploads/";

$year = date('Y');
$month = date('m');

$target_dir .= $year . '/' . $month . '/';
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0775, true);
}

$target_file = $target_dir . basename($_FILES["userfile"]["name"]);

$error = "";
$file_url = "";

// check if file already exists
if (file_exists($target_file)) {
    $error = "Sorry, file already exists.";
}

// check file size
if ($_FILES["userfile"]["size"] > 500000) {
    $error = "Sorry, your file is too large.";
}

// only allow certain file types
$allowed = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'txt', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'zip', 'rar', '7z'];
$ext = pathinfo($_FILES["userfile"]["name"], PATHINFO_EXTENSION);
if (!in_array($ext, $allowed)) {
    $error = "Sorry, only JPG, JPEG, PNG, GIF, PDF, TXT, DOC, DOCX, XLS, XLSX, PPT, PPTX, ZIP, RAR, and 7Z files are allowed.";
}

// if the file type is an image, check if it is an actual image
if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
    $check = getimagesize($_FILES["userfile"]["tmp_name"]);
    if ($check === false) {
        $error = "File is not an image.";
    }
}

// if there were no errors, try to upload the file
if ($error == "") {
    if (!move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
        $error = "Sorry, there was an error uploading your file.";
    } else {
        $file_url = '/uploads/' . $year . '/' . $month . '/' . basename($_FILES["userfile"]["name"]);
    }
}

$data = [
    'error' => $error,
    'fileURL' => $file_url,
];

$data = array_merge($data, $commonData);
$data = array_merge($data, $sidebarData);

echo $twig->render('admin/file_upload_result.html.twig', $data);
