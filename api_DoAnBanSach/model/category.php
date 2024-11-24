<?php
    class Category {
        private $conn;

        public $idTL;
        public $tenTL;
        public $trangthai;

        //connect database
        public function __construct($db) {
            $this->conn = $db;
        }

        //read data
        public function read() {
            $query = "SELECT * FROM theloai";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        //show data
        public function show() {
            $query = "SELECT * FROM theloai WHERE idTL = ? LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->idTL);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->tenTL = $row['tenTL'];
            $this->trangthai = $row['trangthai']; 
        }

        //create data
        public function create() {
            $query = "INSERT INTO theloai SET tenTL = :tenTL, trangthai = 1";
            
            $stmt = $this->conn->prepare($query);
            
            //clean data
            $this->tenTL = htmlspecialchars(strip_tags($this->tenTL));
            
            $stmt->bindParam(':tenTL', $this->tenTL);
            
            if($stmt->execute()) {
                return true;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        //update data
        public function update() {
            $query = "UPDATE theloai SET tenTL = :tenTL WHERE idTL = :idTL";
            
            $stmt = $this->conn->prepare($query);
            
            //clean data
            $this->idTL = htmlspecialchars(strip_tags($this->idTL));
            $this->tenTL = htmlspecialchars(strip_tags($this->tenTL));

            $stmt->bindParam(':idTL', $this->idTL);
            $stmt->bindParam(':tenTL', $this->tenTL);
            
            if($stmt->execute()) {
                return true;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        //delete data
        public function delete() {
            $query = "DELETE FROM theloai WHERE idTL = :idTL";

            $stmt = $this->conn->prepare($query);

            $this->idTL = htmlspecialchars(strip_tags($this->idTL));
            $stmt->bindParam(':idTL', $this->idTL);

            if($stmt->execute()) {
                return true;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }


?>