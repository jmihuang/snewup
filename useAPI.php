<?php 

    session_start();
    header("Content-Type:text/html; charset=utf-8");
    include_once "connMysql.php";

    /*
    *參照教學:https://gist.github.com/jonsuh/3739844
    */
    if (is_ajax()) {
        
      if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
        $action = $_POST["action"];
        switch($action) { //Switch case for value of action
          case "inqueryForm":
             insertContactDB($crud);
             break;
          case "inquerySheet": 
             inquerySheet();
             break;
          case "checkAccout": 
             checkUserAccout(); 
             break;
        }
      }
    }
    //Function to check if the request is an AJAX request
    function is_ajax() {
      return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

    function checkUserAccout(){
           $tblName = 'admin';
           $username = $_POST['password'];
           $tokenStr = $_POST['username'].$_POST['password'];
           $token=md5($tokenStr);
           $conditions = array(
             'select' => 'password',
             'where' => array(
                'account' => $_POST['username']),
             'return_type'=>'single'
            );
           
            $rows = $GLOBALS['crud']->getRows($tblName,$conditions);
            if($rows){
              if($rows['password'] === md5($username)){         
                  $result = array(
                         'status' => 1,
                         'lanch' => '../index.php',
                         'token' => $token,
                         'message'=> '登入成功!!'
                  );
                  //資料正確 寫入session
                 $_SESSION['token'] = $result['token'];//寫入session
                 $_SESSION['username'] = $_POST['username'];//寫入session
                  
                 //記我30天
                 if( isset($_POST['rememberMe'])){
                     setcookie("temp_username",$_POST['username'], time()+3600*24*30);
                 }else{
                   setcookie ("temp_username", "", time() - 3600);
                 };
                 
              }else{
                $result = array(
                       'status' => 0,
                       'error' => 2,
                       'message'=> '密碼錯誤!!'
                );                
              }
           }else{
              $result = array(
                     'status' => 0,
                     'error' => 1,
                     'message'=> '帳號錯誤!!'
              );
           }
           echo json_encode($result);
    }

    function insertContactDB(){
              $tblName = 'contact';
              $userData = array(
                    'Name' => $_POST['name'],
                    'Company' => $_POST['company'],
                    'Phone'   => $_POST['phone'],
                    'Mail'    => $_POST['mail'],
                    'Date'    => date("Y-m-d H:i:s"),
                    'Comment' => $_POST['comment']
                );
                $lastId = $GLOBALS['crud']->create($tblName,$userData);
                if(!empty($lastId)){
                   $result = array(
                          'status' => 1,
                          'lastId'=> $lastId,
                          'restdata'=> $userData,
                          'message'=> '感謝您的填寫<br/>表單已成功送出!!'
                   );
                }else{
                   $result = array(
                          'status' => 0,
                          'message'=> '新增失敗'
                   );
                } 
                echo json_encode($result); 
      }


   function inquerySheet(){
         $ajaxUrl = new useAPI;
         $sql = "SELECT * FROM `contact`";
         $ajaxUrl->setData($sql);//寫入
         $ajaxUrl->showData();//回傳
   }







 ?>
