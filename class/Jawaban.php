<?php
require_once __DIR__ . '/Connect.php';
class Jawaban
{
    public static function setData($idsoal, $jwb, $bener)
    {
        $conn = new Connect();

        $stmt = $conn->koneksi->prepare("INSERT INTO jawaban(idsoal, isi_jawaban, benarkah) VALUES(?,?,?)");
        $stmt->bind_param("isi", $idSoal, $jwb, $bener);
        $tes = $stmt->execute();

        if ($tes)
            return true;
        else
            return false;
    }

    public static function getData($idSoal)
    {
        $conn = new Connect();

        $stmt = $conn->koneksi->prepare("SELECT * FROM jawaban WHERE idsoal = ?");
        $stmt->bind_param('i', $idSoal);
        $stmt->execute();
        $res = $stmt->get_result();
        $data = [];
        while ($row = $res->fetch_assoc()) {
            $data[] = [
                'id' => $row['idjawaban'],
                'idSoal' => $row['idsoal'],
                'jawab' => $row['isi_jawaban'],
                'benar' => $row['benarkah']
            ];
        }
        return $data;
    }
    public static function getDetailJawaban($idJawaban)
    {
        $conn = new Connect();
        $stmt = $conn->koneksi->prepare("SELECT * FROM jawaban WHERE idjawaban = ?");
        $stmt->bind_param('i', $idJawaban);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    public static function getJawabanBenar($idSoal)
    {
        $conn = new Connect();
        $stmt = $conn->koneksi->prepare("SELECT isi_jawaban FROM jawaban WHERE idsoal = ? AND benarkah = 1 LIMIT 1");
        $stmt->bind_param('i', $idSoal);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        return $row ? $row['isi_jawaban'] : '';
    }

}