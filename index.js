const express = require('express');
const axios = require('axios');
const app = express();
const port = 3000;

// Mengambil data dari API JSON Placeholder
app.get('/', async (req, res) => {
    try {
        const response = await axios.get('https://jsonplaceholder.typicode.com/posts');
        const data = response.data;

        let tableHTML = `
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Data Posts (Node.js)</title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <h1>Data Posts dari JSONPlaceholder API (Node.js)</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Body</th>
                    </tr>
                </thead>
                <tbody>
        `;

        data.forEach(post => {
            tableHTML += `
            <tr>
                <td>${post.id}</td>
                <td>${post.title}</td>
                <td>${post.body}</td>
            </tr>
            `;
        });

        tableHTML += `</tbody>
        </table>
        </body>
        </html>
        `;

        res.send(tableHTML);
    } catch(error) {
        res.status(500).send('Error fetching data')
    }
});

// Menjalankan server
app.listen(port, () => {
    console.log(`Server sedang berjalan di http://localhost:${port}`);
})