<?php
header('Content-Type: application/json');
include 'db.php';
session_start();


$data = json_decode(file_get_contents('php://input'), true);
$user_id = $_SESSION['user_id']; // Pastikan user login
$id_produk = $data['id_produk'];
$rating = $data['rating'];

// Cek apakah user sudah memberikan rating
$query = "SELECT rating_id FROM rating WHERE user_id = ? AND id_produk = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $user_id, $id_produk);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Jika sudah pernah memberi rating, tolak
    echo json_encode(['success' => false, 'message' => 'Anda sudah memberikan rating!']);
} else {
    // Simpan rating baru
    $query = "INSERT INTO rating (user_id, id_produk, rating) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iii', $user_id, $id_produk, $rating);
    echo json_encode(['success' => $stmt->execute()]);
}
?>
