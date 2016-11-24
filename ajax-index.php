<?php 
   /**
   * Ajax url
   */
   header("Content-Type:text/html; charset=utf-8");
   class useAPI{

     function __construct(){
          $db_host = "localhost";
          $db_user = "root";
          $db_pwd = "1234";
          $seldb = "snewup_db";
          
          $this->mysqli = new mysqli( $db_host,$db_user,$db_pwd, $seldb);

          /* check connection */
          if ($this->mysqli->connect_error) {
              printf("Connect failed: %s\n", mysqli_connect_error());
              exit();
          }

          $this->mysqli->set_charset("utf8");
     }

     function err_log($log){
        return htmlspecialchars("錯誤訊息:".$log);
     }



     var $action;
     var $DBname;
     var $sql;
     var $resdata;

     function setData($sql){
        $this->sql = $sql;
     }

     function showData()
     {

      $sql=$this->sql;
      $db_result = $this->mysqli->query($sql);
      $count = $db_result->num_rows;//筆數
      try{
          $resdata = mysqli_fetch_all($db_result,MYSQLI_ASSOC);
          $return = array(
                 'status' => 1,
                 'resdata'=> $resdata,
                 'count'=> $count
          );
      }catch(mysqli_sql_exception $e){
        throw new MySQLiQueryException($db_result, $e->getMessage(), $e->getCode());
        return $this->Result;
          $error = $this->err_log($e->getMessage());
          $return = array(
                 'status' => 0,
                 'error'=> $error
          );
      }
      echo json_encode($return);

     }

     function insertData(){
        $sql=$this->sql;
        $msg = '感謝您的填寫<br/>表單已成功送出!!';
        try{
            $this->mysqli->query($sql);
            $id = $this->mysqli->insert_id;
            $resdata = $_POST;
            $return = array(
                   'status' => 1,
                   'resdata'=> $resdata,
                   'msg'=> $msg,
                   'id'=> $id
            );
        }catch(mysqli_sql_exception $e){
          throw new MySQLiQueryException($db_result, $e->getMessage(), $e->getCode());
          return $this->Result;
            $error = $this->err_log($e->getMessage());
            $return = array(
                   'status' => 0,
                   'error'=> $error
            );
        }
        echo json_encode($return);
     }
     function checkData(){
        $sql=$this->sql;
        //是否存在 1存在0不存在
        $db_result = $this->mysqli->query($sql);
        try{
            $this->mysqli->query($sql);
            $checkAccoutExist = $db_result->num_rows;          
              $db_PassWord = mysqli_fetch_object($db_result)->password;
              //轉成全域變數
              $GLOBALS["db_PassWord"]=$db_PassWord;

              //判斷是否存在
            function checkPw(){
              return $GLOBALS["db_PassWord"] == md5($_POST['password']);
            }
            echo checkPw();
            $checkPw = checkPw();
            $return = array(
                   'status'=>1,
                   'checkExist'=>$checkAccoutExist,
                   'checkPw'=>checkPw()
            );
        }catch(mysqli_sql_exception $e){
          throw new MySQLiQueryException($db_result, $e->getMessage(), $e->getCode());
          return $this->Result;
            $error = $this->err_log($e->getMessage());
            $return = array(
                   'status' => 0,
                   'error'=> $error
            );
        }
        echo json_encode($return);
     }


     function __destruct(){
        $this->mysqli->close();
     }
   }
 ?>
