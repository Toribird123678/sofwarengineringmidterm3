<?php require_once 'dbConfig.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my stay</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>List of 5 Customers who book </h1>
    <?php
    $stmt = $pdo->prepare("SELECT Guests.FirstName, Guests.LastName, COUNT(bookings.BookingID) AS TotalBookings
        FROM Guests
        JOIN Bookings ON Guests.GuestID = Bookings.GuestID
        GROUP BY Guests.GuestID

        LIMIT 5;
");
        
    $executeQuery = $stmt->execute();

    if($executeQuery){
        $customers = $stmt->fetchAll();
    } else {
        echo "Query Failed";
        exit; // Stops further execution if query fails
    }
    ?>

    <table> 
        <tr>
            <th>First_name</th>
            <th>Last Name</th>
            <th>Booking ID</th>
        </tr>
        
    <?php if (!empty($customers)): ?>
        <?php foreach ($customers as $row): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['FirstName']); ?></td>
            <td><?php echo htmlspecialchars($row['LastName']); ?></td>
            <td><?php echo htmlspecialchars($row['TotalBookings']); ?></td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No data found</td>
        </tr>
    <?php endif; ?>
    </table>
</body>
</html>
