<?php
// try catch olası hataları görüntülemek için kullanılmıştır 
 try {
      $baglanti = new PDO("mysql:host=localhost;dbname=muhendi5_1601;charset=UTF8;", "muhendi5_1601", "1601");
      $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     } catch (PDOException $e) {
       echo "Veritabanı Hatası!: " . $e->getMessage();
     }
?>