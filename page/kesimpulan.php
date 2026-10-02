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
$allSoal = Soal::getAllSoal();
$listHtml = "";

if ($allSoal) {
    foreach ($allSoal as $soal) {
        $idsoal = $soal['idSoal'];
        $nomor = $soal['nomor'];
        $pertanyaan = $soal['pertanyaan'];

        $listHtml .= "<p>Pertanyaan nomor {$nomor} : {$pertanyaan}<br>";

        $pilihanJawaban = Jawaban::getData($idsoal);
        
        $jwbUser = "Kosong / Tidak dijawab";
        $jwbBener = "";
        $status_benar = false;

        foreach ($pilihanJawaban as $pj) {
            if ($pj['benar'] == 1) {
                $jwbBener = $pj['jawab'];
            }
            if (isset($_SESSION['jawaban_user'][$idsoal]) && $_SESSION['jawaban_user'][$idsoal] == $pj['id']) {
                $jwbUser = $pj['jawab'];
                if ($pj['benar'] == 1) {
                    $status_benar = true;
                }
            }
        }
        if ($status_benar) {
            $skor_akhir += 10;
            $listHtml .= "Jawaban user : {$jwbUser} (benar)</p>";
        } else {
            $listHtml .= "Jawaban user : {$jwbUser} (salah)<br>";
            $listHtml .= "Jawaban benar : {$jwbBener}</p>";
        }
    }
}
?>

<div>
    <h2>Halaman Kesimpulan</h2>
    <hr>
    <?=$listHtml?>
    <p class="skor">Skor Akhir: <?=$skor_akhir?></p>
    <form method="post" action="">
        <input type="submit" name="play_again" value="PLAY AGAIN">
    </form>
</div>