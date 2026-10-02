    <?php
    require_once __DIR__.'/../class/Soal.php';

    $halaman_sekarang = (int)$conn->link[1];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_POST['jawaban'])) {
            foreach ($_POST['jawaban'] as $idSoal => $idJawaban) {
                $_SESSION['jawaban_user'][$idSoal] = $idJawaban;
            }
        }

        if (isset($_POST['nav'])) {
            if ($_POST['nav'] === 'next') {
            
                $cek_next = Soal::getData($halaman_sekarang + 1);
                if ($cek_next) {
                    $target = $conn->baseUrl . "/soal/" . ($halaman_sekarang + 1);
                } else {
                
                    $target = $conn->baseUrl . "/kesimpulan";
                }
            } elseif ($_POST['nav'] === 'back') {
                $target = $conn->baseUrl . "/soal/" . ($halaman_sekarang - 1);
            }
            
            header("Location: " . $target);
            exit;
        }
    }


    $listSoal = Soal::getData($halaman_sekarang);


    if (!$listSoal) {
        header("Location: " . $conn->baseUrl . "/kesimpulan");
        exit;
    }

    $soal = "";
    foreach ($listSoal as $i) {
        $jawab = "";
        $idSoal_saat_ini = $i['jawaban'][0]['idSoal']; 

        foreach($i['jawaban'] as $j){
            $checked = "";
            if (isset($_SESSION['jawaban_user'][$idSoal_saat_ini]) && $_SESSION['jawaban_user'][$idSoal_saat_ini] == $j['id']) {
                $checked = "checked";
            }
            $jawab .= "<input type='radio' id='radio{$j['id']}' name='jawaban[{$idSoal_saat_ini}]' value='{$j['id']}' $checked required>
                    <label for='radio{$j['id']}'>{$j['jawab']}</label><br>";
        }
        $soal .= "<h3>{$i['nomor']}) {$i['pertanyaan']}</h3> $jawab";
    }
    ?>

    <header>
        <h1>Quiz</h1>
        <p id="halaman">Halaman - <?= $halaman_sekarang ?></p>
        <form method="POST" action="">
            <div id="soal">
                <?= $soal ?>
            </div>
            <div class="nav-group">
                <?php if ($halaman_sekarang > 1): ?>
                    <button type="submit" name="nav" value="back">&lt;&lt; Back</button>
                <?php endif; ?>
                <button type="submit" name="nav" value="next">Next &gt;&gt;</button>
            </div>
        </form>
    </header>