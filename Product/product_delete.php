<?php
// Include configuration file
@include 'config.php';

// Establish database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve list of products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Display products
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<p>Name: {$row['name']}</p>";
        echo "<p>Price: {$row['price']}</p>";
        echo "<p>Weight: {$row['weight']}</p>";
        echo "<p>Description: {$row['description']}</p>";
        echo "<img src='{$row['image_path']}' alt='Product Image' width='100'>";
        echo "<p><a href='admin_product_delete.php?id={$row['id']}'>Delete</a></p>";
        echo "</div>";
    }
} else {
    echo "No products found";
}

$conn->close();
?>

