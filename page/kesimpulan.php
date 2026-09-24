<?php
require_once __DIR__ . '/../class/Soal.php';
require_once __DIR__ . '/../class/Jawaban.php';

if (isset($_POST['jawaban'])) {
    foreach ($_POST['jawaban'] as $idSoal => $idJwb) {
        $_SESSION['jawaban'][$idSoal] = $idJwb;
    }
}


if (isset($_POST['play_again'])) {
    unset($_SESSION['jawaban']);
    
    global $conn; 
    header("Location: " . $conn->baseUrl . "/soal/1");
    exit;
}

$skor_akhir = 0;
$semuaSoal = Soal::getAllSoal();
$list_html = "<ol>";

if ($semuaSoal) {
    foreach ($semuaSoal as $soal) {
        $idsoal = $soal['idSoal'];
        $pertanyaan = $soal['pertanyaan'];

        $list_html .= "<li>$pertanyaan<br>";

        // Pengecekan jawaban user
        if (isset($_SESSION['jawaban'][$idsoal])) {
            $idjawaban_user = $_SESSION['jawaban'][$idsoal];
            $detailJawabanUser = Jawaban::getDetailJawaban($idjawaban_user);
            $teks_jawaban_user = $detailJawabanUser['isi_jawaban'];

            if ($detailJawabanUser['benarkah'] == 1) {
                $skor_akhir += 10;
                $list_html .= "Jawaban user : $teks_jawaban_user (benar)</li>";
            } else {
                $jawaban_benar = Jawaban::getJawabanBenar($idsoal);
                $list_html .= "Jawaban user : $teks_jawaban_user (salah)<br>";
                $list_html .= "Jawaban benar : $jawaban_benar</li>";
            }
        } else {
            // Jika tidak dijawab
            $jawaban_benar = Jawaban::getJawabanBenar($idsoal);
            $list_html .= "Jawaban user : Kosong (salah)<br>";
            $list_html .= "Jawaban benar : $jawaban_benar</li>";
        }
    }
}
$list_html .= "</ol>";
?>

<h2>Halaman Kesimpulan</h2>
<p>Menampilkan semua soal, dan jawaban user, beserta skor akhirnya.<br>
Anggap saja satu nomor benar bernilai 10</p>

<!-- Menampilkan list pertanyaan dan jawaban[cite: 6] -->
<?=$list_html?>

<!-- Menampilkan Skor Akhir di bawah list[cite: 6] -->
<p style="margin-left: 40px;">Skor Akhir : <?=$skor_akhir?></p>

<br>
<p>Kemudian ada satu tombol lagi:</p>
<form method="post" action="">
    <input type="submit" name="play_again" value="PLAY AGAIN">
</form>