<?php

// URL API
$url = 'https://jsonplaceholder.typicode.com/posts';

// Mengambil data dari API
$response = file_get_contents($url);

// Mengubah data JSON menjadi array asosiatif
$data = json_decode($response, true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Posts (PHP)</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Data Posts dari JSONPlaceholder API (PHP)</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Body</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $post): ?>
            <tr>
                <td><?php echo $post['id']; ?></td>
                <td><?php echo htmlspecialchars($post['title']); ?></td>
                <td><?php echo htmlspecialchars($post['body']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

