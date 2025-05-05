<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Services</title>
    <link rel="stylesheet" href="ser.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Manage Services</h1>
            <nav>
                <ul>
                    <li><a href="admin.html">Dashboard</a></li>
                    <li><a href="app.html">Appointments</a></li>
                    <li><a href="ser.html">Services</a></li>
                    
                    <li><a href="test.html">Logout</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <form id="serviceForm">
                <label for="service-name">Service Name:</label>
                <input type="text" id="service-name" required>

                <label for="service-price">Price:</label>
                <input type="number" id="service-price" required>

                <button type="submit">Add Service</button>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Service Name</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="service-list">
                <?php
require_once 'db_connect.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        // Add new service
        $stmt = $conn->prepare("INSERT INTO services (name, price) VALUES (?, ?)");
        $stmt->execute([$_POST['service-name'], $_POST['service-price']]);
    } elseif (isset($_POST['delete'])) {
        // Delete service
        $stmt = $conn->prepare("DELETE FROM services WHERE id = ?");
        $stmt->execute([$_POST['id']]);
    } elseif (isset($_POST['update'])) {
        // Update service
        $stmt = $conn->prepare("UPDATE services SET name = ?, price = ? WHERE id = ?");
        $stmt->execute([$_POST['service-name'], $_POST['service-price'], $_POST['id']]);
    }
}

// Get all services
$stmt = $conn->query("SELECT * FROM services ORDER BY id");
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Services</title>
    <link rel="stylesheet" href="ser.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Manage Services</h1>
            <nav>
                <ul>
                    <li><a href="admin.php">Dashboard</a></li>
                    <li><a href="app.php">Appointments</a></li>
                    <li><a href="ser.php">Services</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <form id="serviceForm" method="POST">
                <input type="hidden" name="id" id="edit-id" value="">
                <label for="service-name">Service Name:</label>
                <input type="text" id="service-name" name="service-name" required>

                <label for="service-price">Price:</label>
                <input type="number" id="service-price" name="service-price" step="0.01" required>

                <button type="submit" name="add" id="submit-btn">Add Service</button>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Service Name</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="service-list">
                    <?php foreach ($services as $service): ?>
                    <tr>
                        <td><?= $service['id'] ?></td>
                        <td><?= htmlspecialchars($service['name']) ?></td>
                        <td>Php.<?= number_format($service['price'], 2) ?></td>
                        <td>
                            <button class="edit-btn" data-id="<?= $service['id'] ?>" 
                                    data-name="<?= htmlspecialchars($service['name']) ?>" 
                                    data-price="<?= $service['price'] ?>">Edit</button>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="id" value="<?= $service['id'] ?>">
                                <button type="submit" name="delete" class="delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>

        <footer>
            <p>&copy; 2023 Barbershop. All rights reserved.</p>
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-btn');
            
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    const price = this.getAttribute('data-price');
                    
                    document.getElementById('edit-id').value = id;
                    document.getElementById('service-name').value = name;
                    document.getElementById('service-price').value = price;
                    document.getElementById('submit-btn').textContent = 'Update Service';
                    document.getElementById('submit-btn').name = 'update';
                });
            });
        });
    </script>
</body>
</html>