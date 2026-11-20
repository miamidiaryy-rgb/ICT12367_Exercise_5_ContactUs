# แบบฝึกหัดที่ 5: เพิ่มข้อมูลและแสดงข้อมูลติดต่อเรา (Contact Us)

รายวิชา **ICT12367 การใช้กรอบงานสำหรับการพัฒนาเว็บแอปพลิเคชันเพื่อความปลอดภัย**

## โครงสร้างโปรเจกต์
- `src/` — Front-end พัฒนาด้วย Vue 3 + Bootstrap 5
  - `src/components/ContactList.vue` — หน้าแสดงรายการติดต่อเราจากตาราง `contacts`
  - `src/components/AddContact.vue` — หน้าฟอร์มเพิ่มข้อมูลติดต่อเรา (`Contact Us`)
- `php_api/` — Back-end พัฒนาด้วย PHP (PDO)
  - `condb.php` — เชื่อมต่อฐานข้อมูล MySQL (`db_shop`) ด้วย PDO
  - `show_contacts.php` — API ดึงข้อมูลจากตาราง `contacts` (`GET`)
  - `add_contact.php` — API เพิ่มข้อมูลลงตาราง `contacts` (`POST`)
- `database/contacts.sql` — คำสั่ง SQL สร้างฐานข้อมูล `db_shop` และตาราง `contacts`

## วิธีติดตั้งและรันโปรเจกต์

### 1. สร้างฐานข้อมูลและตาราง
นำเข้าไฟล์ `database/contacts.sql` ใน MySQL / phpMyAdmin

### 2. รัน PHP API
```bash
php -S localhost:8001
```
*(หรือนำโฟลเดอร์ `php_api` ไปวางใน `htdocs` ของ XAMPP แล้วปรับ `API_BASE_URL` ใน `src/config.js`)*

### 3. รัน Vue.js Front-end
```bash
npm install
npm run dev
```
เปิดเบราว์เซอร์ไปที่ `http://localhost:5176`
