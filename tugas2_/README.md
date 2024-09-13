# Tugas 2
_Object-Oriented Programming (OOP) dengan basis data MySQL_
## 📚 Pembahasan :
berikut merupakan script kodingan serta pembahasan singkat nya (yang penting untuk anda ketahui)  berupa point-point :
### Tampilan Database dan Tabel beserta isi nya :
### Pengaplikasian nya ke OOP :
### A. koneksi :
✅ 1) Class Database
```sh
class database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "tugas2";
    public $link;
    public $error;

    public function __construct() {
        $this->link = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (!$this->link) {
            $this->error = "Koneksi ke Database Gagal: " . mysqli_connect_error();
            return false;
        }
    }
}
```
Penjelasan Singkat :
- Kelas database mengelola koneksi ke database MySQL.
- Atribut private menyimpan informasi koneksi (host, username, password, dan database).
- Atribut public $link untuk menyimpan objek koneksi dan $error untuk menyimpan pesan kesalahan.
- Konstruktor __construct() membuat koneksi menggunakan mysqli_connect(). Jika koneksi gagal, pesan kesalahan disimpan di $error.

✅ 2) Class Journals
```sh
class journals extends database {
    public function TampilkanData($journal_id = null) {
        if ($journal_id) {
            $query = "SELECT * FROM journals WHERE id = $journal_id";
        } else {
            $query = "SELECT * FROM journals";
        }

        $result = mysqli_query($this->link, $query);

        if (!$result) {
            die("Query Error: " . mysqli_error($this->link));
        }

        $array = array();
        while ($row = mysqli_fetch_array($result)) {
            $array[] = $row;
        }
        return $array;
    }
}
```
Penjelasan Singkat :
- Kelas journals mewarisi dari kelas database, sehingga dapat menggunakan koneksi database.

- Metode TampilkanData($journal_id = null) menampilkan data dari tabel journals.
  
- Jika $journal_id diberikan, query akan menampilkan data spesifik berdasarkan ID; jika tidak, akan menampilkan semua data.
  
- Data hasil query diambil menggunakan mysqli_fetch_array() dan disimpan dalam array.
  
✅ 3) Class Journal_Details
  ```sh
  class journal_details extends database {
    public function TampilkanData($detail_id = null) {
        if ($detail_id) {
            $query = "SELECT * FROM journal_details WHERE id = $detail_id";
        } else {
            $query = "SELECT * FROM journal_details";
        }

        $result = mysqli_query($this->link, $query);

        if (!$result) {
            die("Query Error: " . mysqli_error($this->link));
        }

        $array = array();
        while ($row = mysqli_fetch_array($result)) {
            $array[] = $row;
        }
        return $array;
    }
}
```


✅ 4) Class Journal

```sh
class journal extends database {
    public function TampilkanData($journal_id = null) {
        if ($journal_id) {
            $query = "SELECT m.id, m.material, m.his_acc_Student, m.his_acc_Lecture, m.attendance_list_detail_id, m.journal_id, m.created_at, m.update_at, m.deleted_at, sp.journal_details_name 
                      FROM journal_details m
                      JOIN journal_details sp ON m.journal_details_id = sp.id
                      WHERE m.id = $journal_id";
        } else {
            $query = "SELECT m.id, m.material, sp.journal_details_name 
                      FROM journal_details m
                      JOIN journal_details sp ON m.journal_details_id = sp.id";
        }

        $result = mysqli_query($this->link, $query);

        if (!$result) {
            die("Query Error: " . mysqli_error($this->link));
        }

        $array = array();
        while ($row = mysqli_fetch_array($result)) {
            $array[] = $row;
        }
        return $array;
    }
}
```
Penjelasan Singkat :
- Kelas journal mewarisi dari kelas database.

- Metode TampilkanData($journal_id = null) menampilkan data dari tabel journal_details dengan join untuk menggabungkan informasi dari tabel journal_details.


- Jika $journal_id diberikan, query akan menampilkan data spesifik berdasarkan ID; jika tidak, akan menampilkan semua data dengan nama detail jurnal.

### B. Journal

✅ 1) Include Koneksi Database dan Inisialisasi class
```sh
include('koneksi.php');
$journal_details = new journals();
$JD = $journal_details->TampilkanData();
```
Pembahasan Singkat :
- include('koneksi.php'); menyertakan file koneksi.php yang berisi koneksi ke database dan definisi kelas journals.

- Membuat objek dari kelas journals dan menyimpan hasil pemanggilan metode TampilkanData() dalam variabel $JD.
  
✅ 2) Tabel untuk Menampilkan Data
  
```sh
<body>
    <h1>Journals</h1>
    <hr>

    <table>
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Attendance_List_Detail_ID</th>
            <th>Has Finished</th>
            <th>Has Acc Head Departement</th>
            <th>Lecture ID</th>
            <th>Course ID</th>
            <th>Student Class ID</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Deleted At</th>
        </tr>

        <?php 
        $no = 1;
        foreach($JD as $row){
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['attendace_list_id']; ?></td>
            <td><?php echo $row['has_finished']; ?></td>
            <td><?php echo $row['has_acc_head_departement']; ?></td>
            <td><?php echo $row['lecture_id']; ?></td>
            <td><?php echo $row['course_id']; ?></td>
            <td><?php echo $row['student_class_id']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td><?php echo $row['update_at']; ?></td>
            <td><?php echo $row['deleted_at']; ?></td>
        </tr>
        <?php 
        }
        ?>
    </table>
</body>
</html>
```
Penjelasan Singkat :
- Menampilkan header halaman dan garis pemisah.
- Membuat tabel dengan header kolom yang sesuai.
- Menggunakan loop foreach untuk menampilkan setiap baris data dari $JD dalam tabel.
  
    Menggunakan variabel $no untuk nomor urut.
  
    Menampilkan data dari $row yang merupakan hasil dari query database.

### C. Journal_Detail

✅ 1) Include dan Inisialisasi class
```sh
include('koneksi.php');
$JDS = new journal_details();
$Journal_details = $JDS->TampilkanData();

$Details = new journal_details();
$jurnal = $Details->TampilkanData();
```
Penjelasan Singkat :
- include('koneksi.php'); menyertakan file yang berisi koneksi database dan definisi kelas journal_details.
- Membuat objek journal_details dan memanggil metode TampilkanData() untuk mengambil data jurnal dan menyimpannya dalam variabel $Journal_details dan $jurnal.

✅ 2) HTML Header dan Styling
```sh
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Journal</title>
    <style>
        /* CSS styling untuk tampilan halaman */
    </style>
</head>
```
Penjelasan Singkat : 
- Menetapkan metadata dan styling untuk halaman.
- CSS digunakan untuk mengatur tampilan tabel dan elemen lainnya agar lebih estetis.

✅ 3) HTML Body
```sh
<body>
    <h1>Journals Details</h1>
    <hr>

    <table>
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Material</th>
            <th>his_acc_Student</th>
            <th>his_acc_Lecture</th>
            <th>attendance_list_detail_id</th>
            <th>Journal ID</th>
            <th>created_at</th>
            <th>update_at</th>
            <th>deleted_at</th>
        </tr>

        <?php 
        $no = 1;
        foreach($jurnal as $row){
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['material']; ?></td>
            <td><?php echo $row['his_acc_Student']; ?></td>
            <td><?php echo $row['his_acc_Lecture']; ?></td>
            <td><?php echo $row['attendance_list_detail_id']; ?></td>
            <td><?php echo $row['journal_id']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td><?php echo $row['update_at']; ?></td>
            <td><?php echo $row['deleted_at']; ?></td>
        </tr>
        <?php 
        }
        ?>
    </table>
</body>
</html>
```
Penjelasan Singkat :
- Menampilkan judul halaman h1 dan garis pemisah hr.
  
- Membuat tabel dengan kolom untuk setiap detail dari jurnal.

- Menggunakan loop foreach untuk menampilkan setiap baris data dari variabel $jurnal dalam tabel.

### D. Journal_1
✅ 1) Include dan Inisialisasi class
```sh
include('koneksi.php');
$JDS = new journal_details();
$Journal_details = $JDS->TampilkanData(101); 
```
Penjelasan Singkat :
- include('koneksi.php'); menyertakan file yang berisi koneksi database dan definisi kelas journal_details.
  
- Membuat objek journal_details dan memanggil metode TampilkanData(101) untuk mengambil data detail jurnal dengan ID 101 dari database. Data ini disimpan dalam variabel $Journal_details.
  
✅ 2) HTML Header dan Styling
```sh
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Journal Details</title>
    <style>
        /* CSS styling untuk tampilan halaman */
    </style>
</head>
```
Penjelasan Singkat :
- Menetapkan metadata dan styling untuk halaman.
- CSS digunakan untuk mengatur tampilan tabel, termasuk warna latar belakang, batas tabel, dan efek hover.

✅ 3) HTML Body
```sh
<body>
    <h1>Journal Details</h1>
    <hr>

    <table>
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Material</th>
            <th>His Acc Student</th>
            <th>His Acc Lecture</th>
            <th>Attendance List Detail ID</th>
            <th>Journal ID</th>
            <th>Created At</th>
        </tr>

        <?php 
        $no = 1;
        foreach($Journal_details as $row){
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['material']; ?></td>
            <td><?php echo $row['his_acc_Student']; ?></td>
            <td><?php echo $row['his_acc_Lecture']; ?></td>
            <td><?php echo $row['attendance_list_detail_id']; ?></td>
            <td><?php echo $row['journal_id']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
        </tr>
        <?php 
        }
        ?>
    </table>
</body>
</html>
```
Penjelasan Singkat :
- Menampilkan judul halaman  h1 dan garis pemisah hr.
  
- Membuat tabel dengan kolom untuk detail jurnal.
  
- Menggunakan loop foreach untuk menampilkan setiap baris data dari variabel $Journal_details dalam tabel.
  
Menggunakan PHP untuk menampilkan data dari array $Journal_details ke dalam tabel HTML.



### E. Journal_Details_1
✅ 1) Include dan Inisialisasi class
```sh
include('koneksi.php');
$journal_details = new journals();
$JD = $journal_details->TampilkanData(1);
```
Penjelasan Singkat :
- include('koneksi.php'); menyertakan file yang berisi koneksi database dan definisi kelas journals.
  
- Membuat objek journals dan memanggil metode TampilkanData(1) untuk mengambil data jurnal dengan ID 1 dari database. Data ini disimpan dalam variabel $JD.

✅ 2) HTML Header dan Styling
```sh
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Journals</title>
    <style>
        /* CSS styling untuk tampilan halaman */
    </style>
</head>
```
Penjelasan Singkat :
- Menetapkan metadata dan styling untuk halaman.
  
- CSS digunakan untuk mengatur tampilan tabel, termasuk warna latar belakang, batas tabel, dan efek hover.


✅ 3) HTML Body
```sh
<body>
    <h1>Journals</h1>
    <hr>

    <table>
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Attendance List ID</th>
            <th>Has Finished</th>
            <th>Has Acc Head Departement</th>
            <th>Lecture ID</th>
            <th>Course ID</th>
            <th>Student Class ID</th>
            <th>Created At</th>
        </tr>

        <?php 
        $no = 1;
        foreach($JD as $row){
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['attendace_list_id']; ?></td>
            <td><?php echo $row['has_finished']; ?></td>
            <td><?php echo $row['has_acc_head_departement']; ?></td>
            <td><?php echo $row['lecture_id']; ?></td>
            <td><?php echo $row['course_id']; ?></td>
            <td><?php echo $row['student_class_id']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
        </tr>
        <?php 
        }
        ?>
    </table>
</body>
</html>
```
Penjelasan Singkat :
- Menampilkan judul halaman  h1 dan garis pemisah hr.
  
- Membuat tabel dengan kolom untuk informasi jurnal.
  
- Menggunakan loop foreach untuk menampilkan setiap baris data dari variabel $JD dalam tabel HTML.
  
Menampilkan data dari array $JD ke dalam tabel HTML.

### 📎 Lampiran
## Koneksi
![alt](https://github.com/AlvaRezal123/TUGAS_2/blob/main/tugas2_/Screenshot/koneksi.PNG)
## Tampilan
![alt](https://github.com/AlvaRezal123/TUGAS_2/blob/main/tugas2_/Screenshot/tampilan.PNG)

## Tampilan Output
![alt](https://github.com/AlvaRezal123/TUGAS_2/blob/main/tugas2_/Screenshot/2.koneksi.output.PNG)

## Journal
![alt](https://github.com/AlvaRezal123/TUGAS_2/blob/main/tugas2_/Screenshot/1%2Cjournal.PNG)

## Journal Output
![alt](https://github.com/AlvaRezal123/TUGAS_2/blob/main/tugas2_/Screenshot/2.journals.output.PNG)

## Journal_details
![alt](https://github.com/AlvaRezal123/TUGAS_2/blob/main/tugas2_/Screenshot/1%2Cjournal_details.PNG)

## Journal_details Output
![alt](https://github.com/AlvaRezal123/TUGAS_2/blob/main/tugas2_/Screenshot/2.journals_details.output.PNG)

## Journal_1
![alt](https://github.com/AlvaRezal123/TUGAS_2/blob/main/tugas2_/Screenshot/1%2Cjournal_1.PNG)

## Journal_1 Output
![alt](https://github.com/AlvaRezal123/TUGAS_2/blob/main/tugas2_/Screenshot/2.journals_1.output.PNG)

## Journal_details_1
![alt](https://github.com/AlvaRezal123/TUGAS_2/blob/main/tugas2_/Screenshot/1%2Cjournal_details_1.PNG)

## Journal_details_1 Output
![alt](https://github.com/AlvaRezal123/TUGAS_2/blob/main/tugas2_/Screenshot/2.journals_details_1.output.PNG)



  


