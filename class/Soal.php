<?php
require_once __DIR__.'/Connect.php';
require_once __DIR__.'/Jawaban.php';
class Soal{
    public static function getData($halaman){
        $conn = new Connect();
        
        $stmt = $conn->koneksi->prepare("SELECT * FROM soal WHERE halaman_ke = ? ORDER BY nomor asc");
        $stmt->bind_param("i", $halaman);
        $stmt->execute();
        $res = $stmt->get_result();
        $data = [];
        
        while($row = $res->fetch_assoc()){
            $jawab = Jawaban::getData($row['idsoal']);
            $data[] = [
                'nomor' => $row ['nomor'],
                'pertanyaan' => $row['pertanyaan'],
                'halKe' => $row['halaman_ke'],
                'jawaban' => $jawab
            ];
        }
        
        if(empty($data)) return false;
        return $data;
    }
    public static function getAllSoal() {
        $conn = new Connect();
        $stmt = $conn->koneksi->prepare("SELECT * FROM soal ORDER BY nomor asc");
        $stmt->execute();
        $res = $stmt->get_result();
        $data = [];
        
        while($row = $res->fetch_assoc()){
            $data[] = [
                'idSoal' => $row['idsoal'],
                'nomor' => $row['nomor'],
                'pertanyaan' => $row['pertanyaan']
            ];
        }
        return $data;
    }

}