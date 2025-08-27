<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $n = $_POST['firstname'];
    $l = $_POST['lastname'];
    $p = password_hash($_POST['pass'], PASSWORD_DEFAULT); // Secure password

    $conn = mysqli_connect("127.0.0.1", "root", "root123", "e-commerce", 3307);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO signin(firstname, lastname, password) VALUES ('$n', '$l', '$p')";

    $r = mysqli_query($conn, $sql);

    if ($r) {
        echo "Signin successfully";
    } else {
        echo "Signin Failed: " . mysqli_error($conn);
    }
}
?>