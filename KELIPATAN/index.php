<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kelipatan</title>
    <link rel="stylesheet" href="kelipatan.css">
</head>
<body>
    <div class="canvas">
        <form method="POST" action="">
            <label for="kelipatan">Masukkan Kelipatan :</label>
            <input type="number" id="kelipatan" name="kelipatan" min="1">
            <button type="submit">Kirim</button>
        </form>

        <?php
        $kelipatan = isset($_POST['kelipatan']) ? (int)$_POST['kelipatan'] : 0;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $kelipatan <= 0) {
            echo "<script>alert('Masukkan angka positif!');</script>";
        }
        ?>

        <h2>Kelipatan dari <?php echo $kelipatan > 0 ? $kelipatan : 'Semua'; ?></h2>

        <table>
            <thead>
                <tr>
                    <th>Angka</th>
                    <th>Kelipatan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 1; $i <= 100; $i++) {
                    $class = 'green';
                    if ($kelipatan > 0 && $i % $kelipatan !== 0) {
                        $class = 'white';
                    }
                    echo "<tr><td>$i</td><td class='$class'>$i</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
