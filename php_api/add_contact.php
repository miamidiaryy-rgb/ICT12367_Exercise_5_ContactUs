<?php
require_once "condb.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        "success" => false,
        "message" => "Method Not Allowed"
    ]);
    exit();
}

$input = json_decode(file_get_contents("php://input"), true);

$subject = trim($input['subject'] ?? '');
$detail = trim($input['detail'] ?? '');
$fullname = trim($input['fullname'] ?? '');
$email = trim($input['email'] ?? '');

if ($subject === '' || $detail === '' || $fullname === '' || $email === '') {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => "กรุณากรอกข้อมูลให้ครบทุกช่อง"
    ]);
    exit();
}

try {
    $sql = "INSERT INTO contacts (subject, detail, fullname, email)
            VALUES (:subject, :detail, :fullname, :email)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':subject' => $subject,
        ':detail' => $detail,
        ':fullname' => $fullname,
        ':email' => $email,
    ]);

    http_response_code(201);
    echo json_encode([
        "success" => true,
        "message" => "บันทึกข้อมูลติดต่อเราเรียบร้อยแล้ว",
        "contact_id" => $conn->lastInsertId()
    ]);
} catch (PDOException $e) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => "ไม่สามารถบันทึกข้อมูลได้: " . $e->getMessage()
    ]);
}
?>
