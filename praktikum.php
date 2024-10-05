<?php

// URL API untuk mengambil semua data negara
$url = 'https://restcountries.com/v3.1/all';

// Mengambil data dari API menggunakan file_get_contents
$response = file_get_contents($url);

// Memeriksa apakah data berhasil diambil
if ($response !== false) {
    // Mengubah JSON menjadi array asosiatif
    $countries = json_decode($response, true);
} else {
    // Jika gagal mengambil data, tampilkan pesan error
    die('Error fetching data from the API');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Countries dari REST Countries API (PHP)</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 1px;
        }
        td {
            background-color: #fff;
            color: #333;
        }
        tr:nth-child(even) td {
            background-color: #f2f2f2;
        }
        tr:hover td {
            background-color: #f1f1f1;
            cursor: pointer;
        }
        tr td:first-child {
            text-align: center;
            font-weight: bold;
        }
        tr:last-child td {
            border-bottom: 2px solid #4CAF50;
        }
        @media (max-width: 768px) {
            table {
                width: 100%;
            }
            th, td {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <h1>Data Countries dari REST Countries API (PHP)</h1>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Country Name</th>
                <th>Capital</th>
                <th>Region</th>
                <th>Population</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // Memeriksa apakah data negara tersedia
            if (!empty($countries)) {
                // Ambil hanya 5 negara pertama
                $countries = array_slice($countries, 0, 5);
                
                $no = 1; // Untuk penomoran baris
                foreach ($countries as $country) {
                    // Mendapatkan nama negara, ibu kota, wilayah, dan populasi
                    $name = isset($country['name']['common']) ? $country['name']['common'] : 'N/A';
                    $capital = isset($country['capital'][0]) ? $country['capital'][0] : 'N/A';
                    $region = isset($country['region']) ? $country['region'] : 'N/A';
                    $population = isset($country['population']) ? number_format($country['population']) : 'N/A';
                    
                    // Menampilkan data negara dalam bentuk tabel
                    echo "<tr>
                        <td>{$no}</td>
                        <td>{$name}</td>
                        <td>{$capital}</td>
                        <td>{$region}</td>
                        <td>{$population}</td>
                    </tr>";
                    
                    $no++;
                }
            } else {
                echo '<tr><td colspan="5">No data available</td></tr>';
            }
            ?>
        </tbody>
    </table>
</body>
</html>
