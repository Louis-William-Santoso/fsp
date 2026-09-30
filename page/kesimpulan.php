<?php
require_once __DIR__ . '/../class/Soal.php';
require_once __DIR__ . '/../class/Jawaban.php';
if (isset($_POST['play_again'])) {
    unset($_SESSION['jawaban_user']);
    
    global $conn; 
    header("Location: " . $conn->baseUrl . "/soal/1");
    exit;
}

$skor_akhir = 0;
$semuaSoal = Soal::getAllSoal();
$list_html = "";

if ($semuaSoal) {
    foreach ($semuaSoal as $soal) {
        $idsoal = $soal['idSoal'];
        $nomor = $soal['nomor'];
        $pertanyaan = $soal['pertanyaan'];

        $list_html .= "<p>Pertanyaan nomor {$nomor} : {$pertanyaan}<br>";

        $pilihanJawaban = Jawaban::getData($idsoal);
        
        $teks_jawaban_user = "Kosong / Tidak dijawab";
        $teks_jawaban_benar = "";
        $status_benar = false;

        foreach ($pilihanJawaban as $pj) {
            if ($pj['benar'] == 1) {
                $teks_jawaban_benar = $pj['jawab'];
            }
            if (isset($_SESSION['jawaban_user'][$idsoal]) && $_SESSION['jawaban_user'][$idsoal] == $pj['id']) {
                $teks_jawaban_user = $pj['jawab'];
                if ($pj['benar'] == 1) {
                    $status_benar = true;
                }
            }
        }
        if ($status_benar) {
            $skor_akhir += 10;
            $list_html .= "Jawaban user : {$teks_jawaban_user} (benar)</p>";
        } else {
            $list_html .= "Jawaban user : {$teks_jawaban_user} (salah)<br>";
            $list_html .= "Jawaban benar : {$teks_jawaban_benar}</p>";
        }
    }
}
?>

<div style="padding: 20px;">
    <h2>Halaman Kesimpulan</h2>
    <p>Menampilkan semua soal, dan jawaban user, beserta skor akhirnya.<br>
    Anggap saja satu nomor benar bernilai 10</p>
    <div style="margin-bottom: 30px;">
        <?=$list_html?>
    </div>

    <!-- Menampilkan Skor Akhir -->
    <h3 style="margin-bottom: 20px;">Skor Akhir : <?=$skor_akhir?></h3>

    <!-- Tombol Play Again -->
    <form method="post" action="">
        <input type="submit" name="play_again" value="PLAY AGAIN" style="padding: 10px 20px; font-weight: bold; cursor: pointer;">
    </form>
</div>