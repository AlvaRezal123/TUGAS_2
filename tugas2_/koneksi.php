<?php 
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
?>
