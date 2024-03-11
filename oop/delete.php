<?php

require('db.php');

class DeleteEmails
{
    private $db;

    public function __construct()
    {
        // Initialize database connection (you can adjust this as needed)
        $this->db = new Database();
    }

    public function getEmails()
    {
        // Fetch email data from the database
        $sql = "SELECT * FROM emails";
        return $this->db->fetchData($sql);
    }

    public function filterByEmailProvider($provider)
    {
        // Implement your filtering logic here
        // ...
    }

    public function sortByDate()
    {
        // Implement sorting by date logic here
        // ...
    }

    public function deleteEmail($emailId)
    {
        // Delete an email based on its ID
        $sql = "DELETE FROM emails WHERE id = ?";
        $stmt = $this->db->prepareStatement($sql);
        $stmt->bind_param("i", $emailId);
        $stmt->execute();
        $stmt->close();
    }
}

// Usage example:
$emailManager = new EmailManager();
$filteredAndSortedData = $emailManager->getEmails();

// Handle delete request (assuming you have an email ID)
if (isset($_GET['delete'])) {
    $emailIdToDelete = $_GET['delete'];
    $emailManager->deleteEmail($emailIdToDelete);
    // Redirect to the same page to refresh the data
    header("Location: your_page.php");
    exit;
}
?>

<!-- Display the sorted data in an HTML table -->
<table>
    <thead>
        <tr>
            <th>Email</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($filteredAndSortedData as $entry) {
            echo '<tr>';
            echo '<td>' . $entry['email'] . '</td>';
            echo '<td>' . $entry['date'] . '</td>';
            echo '<td><a href="?delete=' . $entry['id'] . '">Delete</a></td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>
