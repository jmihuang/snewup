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
           $password = $_POST['password'];
           $tokenStr = $_POST['account'].$_POST['password'].time();
           $token=md5($tokenStr);
           
           //檢查是否有帳號
            $conditions = array(
             'select' => 'account',
             'where' => array(
                'account' => $_POST['account']),
             'return_type'=>'single'
            );
           
            $rows = $GLOBALS['crud']->getRows($tblName,$conditions);
            if($rows){
              //有註冊帳號 檢查密碼
               $pconditions = array(
                'select' => 'password',
                'where' => array(
                   'account' => $_POST['account']),
                'return_type'=>'single'
               );
              
               $prows = $GLOBALS['crud']->getRows($tblName,$pconditions);
              if($prows['password'] === $password){         
                  $result = array(
                         'status' => 1,
                         'lanch' => '../index.php',
                         'token' => $token,
                         'message'=> '登入成功!!'
                  );
                  //資料正確 寫入session
                 $_SESSION['token'] = $result['token'];//寫入session
                 $_SESSION['username'] = $_POST['account'];//寫入session
                  
                 //記我30天
                 if( isset($_POST['rememberMe'])){
                     setcookie("temp_username",$_POST['account'], time()+3600*24*30);
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
                     'send' => $conditions,
                     'message'=> '帳號錯誤!!'
              );
           }
           echo json_encode($result);
    }


    //送出聯絡表單
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

                   //phpMailer
                   require './sendmail.php';

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
