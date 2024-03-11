<?php


class EmailManager {
    private $data;

    public function __construct($data) {
        $this->data = $data;
        $this->connect = mysqli_connect('localhost', 'root', '', 'subscribers');

    }

    
    public function getDatabaseConnection() {
        return $this->connect;
    }

    public function sortByEmail() {
        usort($this->data, function ($a, $b) {
            return strcasecmp($a['email'], $b['email']);
        });
    }

    public function sortByDate() {
        usort($this->data, function ($a, $b) {
            return strtotime($a['date']) - strtotime($b['date']);
        });
    }

    public function getEmails() {
        return $this->data;
    }

    public function deleteEmail($emailId) {
        // Delete an email by its ID
        $sql = "DELETE FROM emails WHERE id = ?";
        $stmt = $this->connect->prepare($sql);
        $stmt->bind_param("i", $emailId);
        $stmt->execute();
        $stmt->close();
    }
}

