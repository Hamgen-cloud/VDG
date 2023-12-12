<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['file'])) {
        $errors = [];
        $file_name = $_FILES['file']['name'];
        $file_size = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_type = $_FILES['file']['type'];
        $tmp = explode('.', $file_name);
        $file_ext = end($tmp);

        $extensions = ['txt'];

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = 'Error: This file extension is not allowed. Please upload a .txt file.';
        }

        if ($file_size > 2097152) {
            $errors[] = 'Error: This file is more than 2 MB. Please upload a smaller file.';
        }

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "upload/" . $file_name);

            $lines = file("upload/" . $file_name, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $lines = array_unique($lines);

            $fp = fopen("upload/" . $file_name, 'w');

            foreach ($lines as $line) {
                fwrite($fp, $line . "\n");
            }

            fclose($fp);

            echo "The file " . $file_name . " has been uploaded and updated.";
        } else {
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
        }
    }
}
?>