<?php
session_start();
if (isset($_POST['pilihan'])) {
    $_SESSION['pilihan'] = $_POST['pilihan'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Geometri</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(45deg, rgb(25, 56, 133), rgb(12, 18, 38), rgb(0, 27, 50));
            background-size: 400% 400%;
            animation: gradientShift 10s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 12px 24px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        select, input, button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        select:focus, input:focus, button:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            background: #28a745;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #218838;
        }

        .result {
            background: #f8f9fa;
            padding: 10px;
            margin-top: 20px;
            border-radius: 8px;
            font-size: 18px;
            color: #333;
        }

        .result h3 {
            color: #007bff;
        }

        /* Responsiveness */
        @media (max-width: 600px) {
            .container {
                width: 90%;
                padding: 15px;
            }

            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Kalkulator Geometri</h2>
        <form method="POST">
            <label>Pilih Perhitungan:</label>
            <select name="pilihan" onchange="this.form.submit()">
                <option value="">-- Pilih --</option>
                <option value="luasPersegiPanjang" <?= isset($_SESSION['pilihan']) && $_SESSION['pilihan'] == 'luasPersegiPanjang' ? 'selected' : '' ?>>Luas Persegi Panjang</option>
                <option value="kelilingPersegiPanjang" <?= isset($_SESSION['pilihan']) && $_SESSION['pilihan'] == 'kelilingPersegiPanjang' ? 'selected' : '' ?>>Keliling Persegi Panjang</option>
                <option value="luasPersegi" <?= isset($_SESSION['pilihan']) && $_SESSION['pilihan'] == 'luasPersegi' ? 'selected' : '' ?>>Luas Persegi</option>
                <option value="kelilingPersegi" <?= isset($_SESSION['pilihan']) && $_SESSION['pilihan'] == 'kelilingPersegi' ? 'selected' : '' ?>>Keliling Persegi</option>
                <option value="luasSegitiga" <?= isset($_SESSION['pilihan']) && $_SESSION['pilihan'] == 'luasSegitiga' ? 'selected' : '' ?>>Luas Segitiga</option>
                <option value="luasLingkaran" <?= isset($_SESSION['pilihan']) && $_SESSION['pilihan'] == 'luasLingkaran' ? 'selected' : '' ?>>Luas Lingkaran</option>
                <option value="kelilingLingkaran" <?= isset($_SESSION['pilihan']) && $_SESSION['pilihan'] == 'kelilingLingkaran' ? 'selected' : '' ?>>Keliling Lingkaran</option>
            </select>

            <?php 
            if (isset($_SESSION['pilihan'])) {
                $pilihan = $_SESSION['pilihan'];

                if ($pilihan == "luasPersegiPanjang" || $pilihan == "kelilingPersegiPanjang") {
                    echo '<input type="number" name="panjang" placeholder="Panjang" required>';
                    echo '<input type="number" name="lebar" placeholder="Lebar" required>';
                } elseif ($pilihan == "luasPersegi" || $pilihan == "kelilingPersegi") {
                    echo '<input type="number" name="sisi" placeholder="Sisi" required>';
                } elseif ($pilihan == "luasSegitiga") {
                    echo '<input type="number" name="alas" placeholder="Alas" required>';
                    echo '<input type="number" name="tinggi" placeholder="Tinggi" required>';
                } elseif ($pilihan == "luasLingkaran" || $pilihan == "kelilingLingkaran") {
                    echo '<input type="number" name="jariJari" placeholder="Jari-jari" required>';
                }
                echo '<button type="submit">Hitung</button>';
            }
            ?>
        </form>

        <?php
        class GeoCalculat {
            function luasPersegiPanjang($panjang, $lebar) {
                // Perhitungan luas persegi panjang
                return (float)$panjang * (float)$lebar;
            }
        
            function kelilingPersegiPanjang($panjang, $lebar) {
                // Perhitungan keliling persegi panjang
                return 2 * ((float)$panjang + (float)$lebar);
            }
        
            function luasPersegi($sisi) {
                // Perhitungan luas persegi
                return (float)$sisi * (float)$sisi;
            }
        
            function kelilingPersegi($sisi) {
                // Perhitungan keliling persegi
                return 4 * (float)$sisi;
            }
        
            function luasSegitiga($alas, $tinggi) {
                // Perhitungan luas segitiga
                return 0.5 * (float)$alas * (float)$tinggi;
            }
        
            function luasLingkaran($jariJari) {
                // Perhitungan luas lingkaran
                return round(pi() * (float)$jariJari * (float)$jariJari, 2);
            }
        
            function kelilingLingkaran($jariJari) {
                // Perhitungan keliling lingkaran
                return round(2 * pi() * (float)$jariJari, 2);
            }
        }
        

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pilihan"])) {
            $hitung = new GeoCalculat();
            $pilihan = $_POST["pilihan"];
            $hasil = "";
        
            switch ($pilihan) {
                case 'luasPersegiPanjang':
                    if (!empty($_POST["panjang"]) && !empty($_POST["lebar"])) {
                        $panjang = $_POST["panjang"];
                        $lebar = $_POST["lebar"];
                        $hasil = "Luas Persegi Panjang dengan panjang $panjang dan lebar $lebar adalah " . $hitung->luasPersegiPanjang($panjang, $lebar);
                    } else {
                        $hasil = "Harap isi panjang dan lebar!";
                    }
                    break;
                case 'kelilingPersegiPanjang':
                    if (!empty($_POST["panjang"]) && !empty($_POST["lebar"])) {
                        $panjang = $_POST["panjang"];
                        $lebar = $_POST["lebar"];
                        $hasil = "Keliling Persegi Panjang dengan panjang $panjang dan lebar $lebar adalah " . $hitung->kelilingPersegiPanjang($panjang, $lebar);
                    } else {
                        $hasil = "Harap isi panjang dan lebar!";
                    }
                    break;
                case 'luasPersegi':
                    if (!empty($_POST["sisi"])) {
                        $sisi = $_POST["sisi"];
                        $hasil = "Luas Persegi dengan sisi $sisi adalah " . $hitung->luasPersegi($sisi);
                    } else {
                        $hasil = "Harap isi sisi!";
                    }
                    break;
                case 'kelilingPersegi':
                    if (!empty($_POST["sisi"])) {
                        $sisi = $_POST["sisi"];
                        $hasil = "Keliling Persegi dengan sisi $sisi adalah " . $hitung->kelilingPersegi($sisi);
                    } else {
                        $hasil = "Harap isi sisi!";
                    }
                    break;
                case 'luasSegitiga':
                    if (!empty($_POST["alas"]) && !empty($_POST["tinggi"])) {
                        $alas = $_POST["alas"];
                        $tinggi = $_POST["tinggi"];
                        $hasil = "Luas Segitiga dengan alas $alas dan tinggi $tinggi adalah " . $hitung->luasSegitiga($alas, $tinggi);
                    } else {
                        $hasil = "Harap isi alas dan tinggi!";
                    }
                    break;
                case 'luasLingkaran':
                    if (!empty($_POST["jariJari"])) {
                        $jariJari = $_POST["jariJari"];
                        $hasil = "Luas Lingkaran dengan jari-jari $jariJari adalah " . $hitung->luasLingkaran($jariJari);
                    } else {
                        $hasil = "Harap isi jari-jari!";
                    }
                    break;
                case 'kelilingLingkaran':
                    if (!empty($_POST["jariJari"])) {
                        $jariJari = $_POST["jariJari"];
                        $hasil = "Keliling Lingkaran dengan jari-jari $jariJari adalah " . $hitung->kelilingLingkaran($jariJari);
                    } else {
                        $hasil = "Harap isi jari-jari!";
                    }
                    break;
            } 
            if (!empty($hasil)) {
                echo "<div class='result'><h3>Hasil: </h3>$hasil</div>";
            }
        }
        ?>
    </div>
</body>
</html>
