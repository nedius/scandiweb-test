<?php

namespace Nedius\Core;

class ResponseProvider {

    private static function getFile($fileName) {
        // $filePath = $_SERVER['DOCUMENT_ROOT'] . "/src/Public/" . $fileName;

        if(file_exists($fileName)) {
            header("Content-Type: " . mime_content_type($fileName));
            return readfile($fileName);
        } else {
            ResponseProvider::error(404);
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

    public static function getView($view) {
        $filePath = $_SERVER['DOCUMENT_ROOT'] . "/src/Views/" . $view . ".php";
        require $filePath;
    }

    public static function error(int $error) {
        http_response_code($error);
        $filePath = $_SERVER['DOCUMENT_ROOT'] . "/src/Views/error.php";
        require $filePath;
    }

}