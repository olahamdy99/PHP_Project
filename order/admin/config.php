<?php
try {
  $conn = new PDO("mysql:host=localhost;dbname=gose_cafeteria", "root", "");
  // Set PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection Error: " . $e->getMessage();
}
