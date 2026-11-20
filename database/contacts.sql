CREATE DATABASE IF NOT EXISTS db_shop
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE db_shop;

CREATE TABLE IF NOT EXISTS contacts (
    contact_id INT AUTO_INCREMENT PRIMARY KEY,
    subject VARCHAR(255) NOT NULL,
    detail TEXT NOT NULL,
    fullname VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO contacts (subject, detail, fullname, email) VALUES
('สอบถามข้อมูลการสมัครเรียน', 'ต้องการสอบถามรายละเอียดเกี่ยวกับการสมัครเรียน', 'สมชาย ใจดี', 'somchai@gmail.com'),
('สอบถามสถานะคำสั่งซื้อ', 'ขอตรวจสอบสถานะการจัดส่งสินค้าหมายเลขคำสั่งซื้อ #1024', 'สุภาพร รักเรียน', 'supaporn@gmail.com'),
('แจ้งปัญหาการเข้าสู่ระบบ', 'ไม่สามารถล็อกอินเข้าสู่ระบบได้ ขึ้นข้อความรหัสผ่านไม่ถูกต้อง', 'กิตติพงษ์ มั่นคง', 'kittipong@gmail.com');
