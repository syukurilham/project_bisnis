<?php
include 'db.php'; // Koneksi ke database

// Ambil id_produk dari URL
$id_produk = isset($_GET['id_produk']) ? (int)$_GET['id_produk'] : 0;

// Query detail produk
$query = "SELECT * FROM product WHERE id_produk = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id_produk);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

// Query rata-rata rating
$query = "SELECT AVG(rating) as avg_rating FROM rating WHERE id_produk = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id_produk);
$stmt->execute();
$avg_rating = $stmt->get_result()->fetch_assoc()['avg_rating'] ?? 0;

// Query rating user (hanya jika user login)
session_start();
$user_rating = 0;
if (isset($_SESSION['user_id'])) {
    $query = "SELECT rating FROM rating WHERE user_id = ? AND id_produk = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $_SESSION['user_id'], $id_produk);
    $stmt->execute();
    $user_rating = $stmt->get_result()->fetch_assoc()['rating'] ?? 0;
}

// Ambil status bookmark dari database
$query_status = "SELECT * FROM bookmarks WHERE user_id = ? AND id_produk = ?";
$stmt = $conn->prepare($query_status);
$stmt->bind_param('ii', $_SESSION['user_id'], $id_produk);
$stmt->execute();
$bookmark_exists = $stmt->get_result()->num_rows > 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>datail mie ayam</title>
    <link rel="stylesheet" href="css/detail.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="pembayaran-container">
        <div class="back-button">
            <a href="homepage.php">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="produk-detail">
            <img src="images/menu/gudeg.jpg" alt="mie ayam">
            <h2>Gudeg</h2>
            <div class="bookmark">
                <a href="save_bookmark.php?id_produk=<?= $id_produk; ?>" class="bookmark-button">
                 <i class="fas fa-bookmark <?= $bookmark_exists ? 'bookmarked' : ''; ?>"></i>
                </a>
            </div>
            <p>Bahan-bahan yang diperlukan :</p> <br>
                <li>
                1 kg nangka muda.
                </li> <br>
                <li>
                1 liter santan dan 500 ml Air.
                </li> <br>
                <li>
                5 lbr daun salam, 1 ruas lengkuas, 
                </li> <br>
                <li>
                2 sdm minyak goreng.
                </li> <br>
                <li>
                5 siung bawang putih dan 15 siung bawang merah.
                </li> <br>
                <li>
                1 sdm ketumbar halus.
                </li> <br>
                <li>
                5 butir kemiri.
                </li> <br>
                <li>
                250 gram gula merah.
                </li> <br>
                <li>
                1 sdm garam.
                </li> <br>

            <h2>Cara Pembuatan</h2>
            <ul>
                <li>
                Rebus nangka muda dengan 500 ml air, tambahkan minyak goreng dan 2 lbr salam.
                </li>
                <li>
                Setelah setengah empuk, tiriskan.
                </li>
                <li>
                Haluskan bawang putih, bawang merah,kemiri dan ketumbar.
                </li>
                <li>
                Siapkan panci presto, tata daun salam didasar panci presto.
                </li>
                <li>
                masukkan lengkuas dan rebusan nangka, bumbu halus, irisan gula merah, garam, penyedap opsional dan 1 liter santan
                </li>
                <li>
                Tutup panci presto. Panaskan panci selama 30 menit, lalu maitikan presto sebentar.
                </li>
                <li>
                Setelah panas uap panci presto hilang, tutup dibuka, lalu didihkan lagi sampai air mulai habis, aduk2 supaya tidak gosong.
                </li>
                <li>
                Setelah warna coklat karamel. Matikan kompor. Dinginkan.
                </li>
                <li>
                Hidangkan dengan krecek, dan tahu tempe bacem, telur pindang.
                </li>
            </ul>
        </div>
        <div class="rating-section">
        <p class="rating-text">Rata-rata rating: <?= number_format($avg_rating, 1); ?> dari 5</p>
        <div class="stars">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <i class="<?= $i <= $user_rating ? 'fas' : 'far'; ?> fa-star" data-value="<?= $i ?>"></i>
            <?php endfor; ?>
        </div>
    </div>
    </div>
</body>
<script>
    document.querySelectorAll('.stars i').forEach(star => {
    star.addEventListener('mouseover', function () {
        const rating = this.getAttribute('data-value');
        document.querySelectorAll('.stars i').forEach(starElement => {
            if (starElement.getAttribute('data-value') <= rating) {
                starElement.classList.add('hover');
            } else {
                starElement.classList.remove('hover');
            }
        });
    });

    star.addEventListener('mouseout', function () {
        document.querySelectorAll('.stars i').forEach(starElement => {
            starElement.classList.remove('hover');
        });
    });

    star.addEventListener('click', function () {
        const rating = this.getAttribute('data-value');
        const productId = <?= $id_produk; ?>;

        fetch('submit_rating.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id_produk: productId, rating: rating })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Rating berhasil disimpan!');
                location.reload(); // Reload untuk memperbarui tampilan
            } else {
                alert(data.message);
            }
        });
    });
});
</script>
<script>
    document.querySelector('.bookmark-button').addEventListener('click', function (event) {
    event.preventDefault(); // Mencegah reload halaman

    const id_produk = <?= $id_produk; ?>;
    const icon = this.querySelector('i');

    // Menggunakan fetch untuk mengirim permintaan ke save_bookmark.php
    fetch('save_bookmark.php?id_produk=' + id_produk)
        .then(response => response.text())
        .then(data => {
            if (data.includes('ditambahkan')) {
                icon.classList.add('bookmarked'); // Tambahkan kelas bookmarked
            } else if (data.includes('dihapus')) {
                icon.classList.remove('bookmarked'); // Hapus kelas bookmarked
            }
            alert(data); // Tampilkan pesan hasil
        })
        .catch(error => console.error('Terjadi kesalahan:', error));
});
</script>
</html>
