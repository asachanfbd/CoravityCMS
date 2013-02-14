<?php
  class pages{
      
      private static $page = '';
      
      private static $name = '';
      
      private function getpage($name){
          global $db;
          if(self::$name != $name){
               self::$name = $name;
               self::$page = $db->querydb("SELECT p.id, t.name, t.parent, p.title, p.content, p.editedby, p.seotags, t.priority, p.added, p.modified FROM pages as p, page_tree as t WHERE p.name = '".$name."' && p.name = t.name ORDER BY p.added DESC", true);
          }
          return self::$page;
      }
      
      function getcontent($name){
          $p = $this->getpage($name);
          return stripslashes($p->content);
      }
      
      public function gettitle($name){
          $p = $this->getpage($name);
          return stripslashes($p->title);
      }
      
      public function getparent($name){
          $p = $this->getpage($name);
          return stripslashes($p->parent);
      }
      
      public function getcreated($name){
          global $db;
          $q = "SELECT MIN(added) as created FROM pages WHERE name = '".$name."'";
          $r = $db->querydb($q, true);
          return $r->created;
      }
      
      public function getauthor($name){
          $p = $this->getpage($name);
          return $p->editedby;
      }
      
      public function getlastedited($name){
          $p = $this->getpage($name);
          return $p->modified;
      }
      
      public function getseotags($name){
          $p = $this->getpage($name);
          return $p->seotags;
      }
      
      private function insert($tbl, $val){
          global $db;
          return $db->insert($tbl, $val);
      }
      
      private function update($tbl, $val, $con){
          global $db;
          return $db->update($tbl, $val, $con);
      }
      
  }
?>
