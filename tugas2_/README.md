# Tugas 2
_Object-Oriented Programming (OOP) dengan basis data MySQL_
## 📚 Pembahasan :
berikut merupakan script kodingan serta pembahasan singkat nya (yang penting untuk anda ketahui)  berupa point-point :
### Tampilan Database dan Tabel beserta isi nya :

### A. koneksi :
1) Class Database
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

2) Class Journals
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
3) Class Journal_Details
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
4) Class Journal
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
Penjelasa Singkat :
- Kelas journal mewarisi dari kelas database.

- Metode TampilkanData($journal_id = null) menampilkan data dari tabel journal_details dengan join untuk menggabungkan informasi dari tabel journal_details.

- Jika $journal_id diberikan, query akan menampilkan data spesifik berdasarkan ID; jika tidak, akan menampilkan semua data dengan nama detail jurnal.
