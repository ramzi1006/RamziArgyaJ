<?php
include "koneksi.php";
session_start();

if (isset($_GET['fotoid'])) {
    $fotoid = $_GET['fotoid'];
} else {
    // Jika fotoid tidak disediakan, redirect ke foto.php
    header("location:foto.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the confirmation parameter is set
    if (isset($_POST['confirmDelete']) && $_POST['confirmDelete'] === 'yes') {
        // Pengguna mengkonfirmasi, lanjutkan dengan penghapusan
        $sql = mysqli_query($conn, "DELETE FROM foto WHERE fotoid='$fotoid'");
        header("location:foto.php");
        exit();
    } else {
        // Pengguna membatalkan penghapusan, redirect ke foto.php
        header("location:foto.php");
        exit();
    }
}

?>
<?php
// Skrip JavaScript untuk konfirmasi penghapusan menggunakan alert
echo '<script>
    var result = confirm("Are you sure you want to delete this photo?");
    if (result) {
        // User confirmed, submit the form
        window.location.href = "proses_hapus_foto.php?fotoid=' . $fotoid . '";
    } else {
        // User canceled the deletion, redirect to foto.php
        window.location.href = "foto.php";
    }
</script>';
?>
