<div>
    <div class="w3-padding-large">
        <h1>Hasil Tes Seleksi Calon Ketua OSIS dan Wakil Ketua OSIS</h1>
    </div>
    <div class="w3-padding-large">
        <div class="w3-responsive">
            <table class="w3-table-all w3-white">
                <tr class="w3-green">
                    <td>Username</td>
                    <td>Nama Lengkap</td>
                    <td>Jawaban Benar</td>
                    <td>Jawaban Salah</td>
                    <td>Jawaban Kosong</td>
                    <td>Nilai</td>
                </tr>
                <?php foreach ($results as $result) { ?>
                    <tr>
                        <td><?php echo $result['username']; ?></td>
                        <td><?php echo $result['full_name']; ?></td>
                        <td><?php echo $result['num_corrects']; ?></td>
                        <td><?php echo $result['num_incorrects']; ?></td>
                        <td><?php echo $result['num_unanswered']; ?></td>
                        <td><b><?php echo $result['score']; ?></b></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <div style="padding-top: 192 px"></div>
</div>
