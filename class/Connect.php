<?php

class Connect {
    public $koneksi;
    public $link;
    public $page;

    function __construct(){
        $this->link = $this->parseUrl();
        $this->koneksi = $this->connectDb();
        $this->page = $this->pageSelect($this->link[0]);
    }

    function parseUrl(){
        $uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
            return false;
        }
        $url = trim($uri, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
    }

    function connectDb(){
        $mysql = new mysqli("localhost", "root", "", "fullstack");
        if($mysql->connect_errno){
            die( "err: gagal connect db" . $mysql->connect_error);
        }
        return $mysql;
    }

    function pageSelect($hal){
        switch ($hal) {
            case 'soal':
                return "page/soal.php";
                break;
            case 'kesimpulan':
                return "page/kesimpulan.php";
                break;
            case 'edit-soal':
                return "page/editSoal.php";
                break;
            default:
                return "page/homepage.php";
                break;
        }
    }

    function __destruct(){
        $this->koneksi->close();
    }
}