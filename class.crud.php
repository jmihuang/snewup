<?php 
   /**
   * Ajax url Reference:http://www.codexworld.com/php-oop-crud-operations-pdo-extension-mysql/
   */
   header("Content-Type:text/html; charset=utf-8");
   class crud{
       private $db;
 
       function __construct($DB_con)
       {
        $this->db = $DB_con;
       }
       /*
        * Returns rows from the database based on the conditions
        * @param string name of the tblName
        * @param array select, where, order_by, limit and return_type conditions
        */
       public function getRows($tblName,$conditions = array()){
            $sql = 'SELECT ';
            $sql .= array_key_exists("select",$conditions)?$conditions['select']:'*';
            $sql .= ' FROM '.$tblName;
            if(array_key_exists("where",$conditions)){
                $sql .= ' WHERE ';
                $i = 0;
                foreach($conditions['where'] as $key => $value){
                    $pre = ($i > 0)?' AND ':'';
                    $sql .= $pre.$key." = '".$value."'";
                    $i++;
                }
            }
            
            if(array_key_exists("order_by",$conditions)){
                $sql .= ' ORDER BY '.$conditions['order_by']; 
            }
            
            if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
                $sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit']; 
            }elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
                $sql .= ' LIMIT '.$conditions['limit']; 
            }

            $query = $this->db->prepare($sql);
            $query->execute();

            if(array_key_exists("return_type",$conditions) && $conditions['return_type'] != 'all'){
                switch($conditions['return_type']){
                    case 'count':
                        $data = $query->rowCount();
                        break;
                    case 'single':
                        $data = $query->fetch(PDO::FETCH_ASSOC);
                        break;
                    default:
                        $data = '';
                }
            }else{
                if($query->rowCount() > 0){
                    $data = $query->fetchAll();
                }
               
                
            }
            return !empty($data)? $data:false;
        }



       public function create($tblName,$userData)
        {
         $columnString = implode(',', array_keys($userData));
         $valueString = ":".implode(',:', array_keys($userData));
         try
         {
           $sql = "INSERT INTO ".$tblName."(".$columnString.") 
                 VALUES(".$valueString.")";
           $stmt = $this->db->prepare($sql);
           foreach ($userData as $key => $val) {
            $stmt->bindValue(':'.$key, $val);
           }
           $stmt->execute();
           $lastId = $this->db->lastInsertId();
           return $lastId;
         }
         catch(PDOException $e)
         {
          echo $e->getMessage(); 
          return false;
         }

         
        }



   }
 ?>
