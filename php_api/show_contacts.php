<?php
require_once "condb.php";

try {
    $stmt = $conn->prepare("SELECT contact_id, subject, detail, fullname, email, created_at FROM contacts ORDER BY contact_id ASC");
    $stmt->execute();
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "success" => true,
        "data" => $contacts
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "ไม่สามารถดึงข้อมูลติดต่อเราได้: " . $e->getMessage()
    ]);
}
?>
