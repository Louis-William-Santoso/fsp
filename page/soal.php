<?php
require_once __Dir__.'/../class/Soal.php';

$listSoal = Soal::getData($conn->link[1]);
var_dump($conn->link[1]);
if($listSoal) $next = $conn->baseUrl."/soal/".$conn->link[1] + 1;
else $next = $conn->baseUrl."/kesimpulan"; 

if($conn->link[1]>1) $back = $conn->baseUrl."/soal/".$conn->link[1] - 1;
else $back = $conn->baseUrl."/soal/1";

$soal = "";
foreach ($listSoal as $i) {
    $jawab = "";
    foreach($i['jawaban'] as $j){
        $jawab .= "<input type='radio' id='radio{$j['id']}' name='{$j['idSoal']}' value='{$j['benar']}'>
                <label for='radio{$j['id']}'>{$j['jawab']}</label><br>";
    }
    $soal .= "<h3>{$i['nomor']}){$i['pertanyaan']}</h3> $jawab";
}
?>
<header>
    <h1>Quiz</h1>
    <p id="halaman">Halaman-<?=$conn->link[1]?></p>

    <form action="<?=$next?>">
        <div id="soal">
            <?=$soal?>
        </div>
        
        <div style="display:flex;">
            <button style="margin: 5px 20px;" id="back" type="button"><< Back</button>
            <button style="margin: 5px 20px;" id="next" type="submit">Next >></button>
        </div>
    </form>
</header>
<script>
let now = <?=$conn->link[1]?>;
let next = "<?=$next?>";

$('#back').click(function() { 
    window.location.href="<?=$back?>";
    alert("tess");
});

if(now < 2) {
    $('#back').attr('hidden',true);
}

if(next === "<?= $conn->baseUrl ?>/kesimpulan"){
    $('#soal').html(
        `<h2>Finish Quiz</h2>
        <p>Soal terjawab: tess</p>`
    );
    $('#next').html("Finish");
}
</script>