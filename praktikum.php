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

// Mendapatkan filter dari form (jika ada)
$filter_id = isset($_GET['id']) ? $_GET['id'] : '';
$filter_name = isset($_GET['name']) ? $_GET['name'] : '';

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
        .filter-form {
            text-align: center;
            margin-bottom: 20px;
        }
        .filter-form input {
            padding: 8px;
            font-size: 14px;
            margin: 0 10px;
        }
        .filter-form button {
            padding: 8px 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .filter-form button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Data Countries dari REST Countries API (PHP)</h1>

    <!-- Form untuk filter data -->
    <div class="filter-form">
        <form method="GET" action="">
            <input type="text" name="id" placeholder="Filter by ID" value="<?php echo htmlspecialchars($filter_id); ?>">
            <input type="text" name="name" placeholder="Filter by Country Name" value="<?php echo htmlspecialchars($filter_name); ?>">
            <button type="submit">Filter</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>ID</th>
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
                $no = 1; // Untuk penomoran baris
                foreach ($countries as $country) {
                    // Mendapatkan nama negara, ibu kota, wilayah, dan populasi
                    $id = isset($country['cca3']) ? $country['cca3'] : 'N/A'; // ID Negara (misalnya: USA)
                    $name = isset($country['name']['common']) ? $country['name']['common'] : 'N/A';
                    $capital = isset($country['capital'][0]) ? $country['capital'][0] : 'N/A';
                    $region = isset($country['region']) ? $country['region'] : 'N/A';
                    $population = isset($country['population']) ? number_format($country['population']) : 'N/A';

                    // Filter berdasarkan ID dan Nama
                    if (($filter_id && stripos($id, $filter_id) === false) || 
                        ($filter_name && stripos($name, $filter_name) === false)) {
                        continue; // Lewati jika tidak sesuai filter
                    }

                    // Menampilkan data negara dalam bentuk tabel
                    echo "<tr>
                        <td>{$no}</td>
                        <td>{$id}</td>
                        <td>{$name}</td>
                        <td>{$capital}</td>
                        <td>{$region}</td>
                        <td>{$population}</td>
                    </tr>";
                    
                    $no++;
                }
            } else {
                echo '<tr><td colspan="6">No data available</td></tr>';
            }
            ?>
        </tbody>
    </table>
</body>
</html>
