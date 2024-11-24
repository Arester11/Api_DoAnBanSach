<?php
    class Discount {
        private $conn;

        public $idMGG;
        public $phantram;
        public $ngaybatdau;
        public $ngayketthuc;
        public $trangthai;
        //connect database
        public function __construct($db) {
            $this->conn = $db;
        }

        //read data
        public function read() {
            $query = "SELECT * FROM magiamgia";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        //show data
        public function show() {
            $query = "SELECT * FROM magiamgia WHERE idMGG = ? LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->idMGG);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->phantram = $row['phantram'];
            $this->ngaybatdau = $row['ngaybatdau'];
            $this->ngayketthuc = $row['ngayketthuc'];
            $this->trangthai = $row['trangthai'];
        }

        //create data
        public function create() {
            $query = "INSERT INTO magiamgia SET
                phantram = :phantram,
                ngaybatdau = STR_TO_DATE(:ngaybatdau, '%Y-%m-%d'),
                ngayketthuc = STR_TO_DATE(:ngayketthuc, '%Y-%m-%d'),
                trangthai = 'cdr'";

            $stmt = $this->conn->prepare($query);

            //clean data
            $this->phantram = htmlspecialchars(strip_tags($this->phantram));
            $this->ngaybatdau = htmlspecialchars(strip_tags($this->ngaybatdau));
            $this->ngayketthuc = htmlspecialchars(strip_tags($this->ngayketthuc));

            $stmt->bindParam(':phantram', $this->phantram);
            $stmt->bindParam(':ngaybatdau', $this->ngaybatdau);
            $stmt->bindParam(':ngayketthuc', $this->ngayketthuc);
            
            if($stmt->execute()) {
                return true;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        //update data
        public function update() {
            $query = "UPDATE magiamgia SET
                phantram = :phantram,
                ngaybatdau = STR_TO_DATE(:ngaybatdau, '%Y-%m-%d'),
                ngayketthuc = STR_TO_DATE(:ngayketthuc, '%Y-%m-%d')
                WHERE idMGG = :idMGG";

            $stmt = $this->conn->prepare($query);

            //clean data
            $this->phantram = htmlspecialchars(strip_tags($this->phantram));
            $this->ngaybatdau = htmlspecialchars(strip_tags($this->ngaybatdau));
            $this->ngayketthuc = htmlspecialchars(strip_tags($this->ngayketthuc));
            $this->idMGG = htmlspecialchars(strip_tags($this->idMGG));

            $stmt->bindParam(':phantram', $this->phantram);
            $stmt->bindParam(':ngaybatdau', $this->ngaybatdau);
            $stmt->bindParam(':ngayketthuc', $this->ngayketthuc);
            $stmt->bindParam(':idMGG', $this->idMGG);
            
            if($stmt->execute()) {
                return true;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        //delete data
        public function delete() {
            $query = "DELETE FROM magiamgia WHERE idMGG = :idMGG";

            $stmt = $this->conn->prepare($query);

            $this->idMGG = htmlspecialchars(strip_tags($this->idMGG));
            $stmt->bindParam(':idMGG', $this->idMGG);

            if($stmt->execute()) {
                return true;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }
?>