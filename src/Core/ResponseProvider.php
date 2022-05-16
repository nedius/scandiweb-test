<?php

namespace Nedius\Core;

class ResponseProvider {

    private static function getFile($fileName) {
        // $filePath = $_SERVER['DOCUMENT_ROOT'] . "/src/Public/" . $fileName;

        if(file_exists($fileName)) {
            header("Content-Type: " . mime_content_type($fileName));
            return readfile($fileName);
        } else {
            ResponseProvider::getPublicFile("Errors/404.html");
        }

    }

    public static function getPublicFile($fileName) {
        $filePath = $_SERVER['DOCUMENT_ROOT'] . "/src/Public/" . $fileName;
        return ResponseProvider::getFile($filePath);
    }

    public static function json($data) {
        header("Content-Type: application/json");
        echo json_encode($data);
        return;
    }

}
