<?php

    function pathUploadImage($image, $imageTmp, $imageName, $imageError) {
        $imagePath = $_SERVER["DOCUMENT_ROOT"] . "/glamour-styles/upload/$imageName";
        if (isset($image) && $imageError === UPLOAD_ERR_OK) {
            if (file_exists($imagePath)) {
                $timestamp = time();
                $imageName = $timestamp . "-" . $imageName;
                $imagePath = $_SERVER["DOCUMENT_ROOT"] . "/glamour-styles/upload/$imageName";
            }
        }
        move_uploaded_file($imageTmp, $imagePath);
        return $imagePath;
    }