<?php

    function pathUploadImage($photo, $photoTmp, $photoName, $photoError) {
        $photoPath = $_SERVER["DOCUMENT_ROOT"] . "/project-glamour-styles/upload/$photoName";
        if (isset($photo) && $photoError === UPLOAD_ERR_OK) {
            if (file_exists($photoPath)) {
                $timestamp = time();
                $photoName = $timestamp . "-" . $photoName;
                $photoPath = $_SERVER["DOCUMENT_ROOT"] . "/project-glamour-styles/upload/$photoName";
            }
        } else {
            $photoPath = $_SERVER["DOCUMENT_ROOT"] . "/project-glamour-styles/upload/default.png";
        }
        move_uploaded_file($photoTmp, $photoPath);
        return $photoPath;
    }