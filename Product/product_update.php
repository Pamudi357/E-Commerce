<?php
// Include configuration file
@include 'config.php';

// Check if product ID is provided
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    
    // Establish database connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Retrieve existing product data
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found";
        exit;
    }
    
    $conn->close();
} else {
    echo "Product ID not provided";
    exit;
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $weight = $_POST['weight'];
    $description = $_POST['description'];
    $imagePath = $_POST['image'];
    
    // Establish database connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Update product data in database
    $sql = "UPDATE products SET name='$name', price=$price, weight='$weight', description='$description', image='$image',  WHERE id=$product_id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully";
    } else {
        echo "Error updating product: " . $conn->error;
    }
    
    $conn->close();
}
?>
