<?php
  //  class Database{
  //      public static function connect(){
  //          $db = new mysqli('192.99.46.110','postalmarketing','Samsung5#','reality2_postalmarketing');
  //          $db->query("SET NAMES 'utf8' ");
  //          return $db;
  //      }
  //  }


    class Database{
      public static function connect(){
          $db = new mysqli('162.216.5.96','devuelvo_data','devuelvo2020','devuelvo_devoluciones');
          $db->query("SET NAMES 'utf8' ");
          return $db;
      }
  }

    //  class Database{
       
    //      public static function connect(){
    //          $db = new mysqli('localhost','root','','reality2_postalmarketing');
    //          $db->query("SET NAMES 'utf8' ");
    //          return $db;
    //      }
    //  }