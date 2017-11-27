<html>
    <head>
        <meta charset="UTF-8"/>
        <title>注册结果</title>
        <link rel="stylesheet" type="text/css" href="models.css"/>
    </head>
<body>
<div id="register_result_message">
<?php
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $passwordConfirmed = $_POST['passwordConfirmed'];
    $labtype = $_POST['labtype'];
    if (!trim($userName)) {
       echo '<p> <span class="label_title">注册失败</span>                </p>';
       echo "您还未输入名称，请退回注册页重新输入。";
       exit;
    }

    if (!trim($password)) {
           echo '<p> <span class="label_title">注册失败</span>                </p>';
       echo "密码不能为空，请退回注册页重新输入。";
       exit;
    }

    if (!trim($passwordConfirmed)) {
           echo '<p> <span class="label_title">注册失败</span>                </p>';
       echo "需要重新输入一遍密码，请退回注册页重新输入。";
       exit;
    }

   if (strcmp($password, $passwordConfirmed) != 0) {
              echo '<p> <span class="label_title">注册失败</span>                </p>';
      echo "两次输入的密码不一致，请退回注册页重新输入。";
      exit;
   }

   if (!get_magic_quotes_gpc()) {
      $userName = addslashes($userName);
      $password = addslashes($password);
   }

   $labtypeindex = 0;
   if (strcmp("一室", $labtype) == 0) $labtypeindex = 1;
   else if (strcmp("二室", $labtype) == 0) $labtypeindex = 2;
   else if (strcmp("三室", $labtype) == 0) $labtypeindex = 3;
   else if (strcmp("四室", $labtype) == 0) $labtypeindex = 4;
   else if (strcmp("五室", $labtype) == 0) $labtypeindex = 5;
   else if (strcmp("六室", $labtype) == 0) $labtypeindex = 6;
   else if (strcmp("七室", $labtype) == 0) $labtypeindex = 7;
   else if (strcmp("八室", $labtype) == 0) $labtypeindex = 8;
   else if (strcmp("九室", $labtype) == 0) $labtypeindex = 9;

   @ $db = new mysqli('localhost', 'modelorama', 'models2017', 'models');
   if (mysqli_connect_errno()) {
      echo '<p> <span class="label_title">注册失败</span> </p>';
      echo "无法连接到数据库，请稍后尝试。";
      exit;
   }

   $query = "select * from customers where name='".$userName."' and labname=".$labtypeindex;
   $result = $db->query($query);
   if ($result->num_rows > 0) {
       echo '<p> <span class="label_title">注册失败</span> </p>';
       echo $labtype."已存在名为".$userName."的用户，请退回注册页重新输入";
       exit;
   }

   $query = "insert into customers values
           (NULL, '".$userName."', '".$password."', '$labtypeindex')";
   $result = $db->query($query);
   if ($result) {
      echo '<p> <span class="label_title">注册成功</span> </p>';
      echo "欢迎".$userName."注册使用XX仿真模型库，请返回登陆页面";
      echo '<a href="login.html">登陆</a>';
   }else {
      echo '<p> <span class="label_title">注册失败</span> </p>';
      echo "无法写入用户数据库，请稍后再试";
   }
?>

</div>
</body>
</html>