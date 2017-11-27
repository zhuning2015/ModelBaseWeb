<?php
    session_start();
?>
<html>
  <head>
    <meta charset="UTF-8">
    <!-    <meta http-equiv="refresh" content="1;url=main.php">->
    <title>登陆结果</title>
    <link rel="stylesheet" type="text/css" href="models.css"/>
  </head>
  <body>
  <div id="login_result_message">
  <?php
    $userName=$_POST['userName'];
    $password=$_POST['password'];

    if (!$userName) {
        echo '<p> <span class="label_title">登陆失败</span></p>';
        echo "用户名不为空且不含空格，请返回登录页重新输入。";
        exit;
    }

    if (!trim($password)) {
       echo '<p> <span class="label_title">登陆失败</span></p>';
       echo "用户密码不为空，请返回登陆页重新输入。";
       exit;
    }

    if (!get_magic_quotes_gpc()) {
       $userName = addslashes($userName);
       $password = addslashes($password);
    }

   @ $db = new mysqli('localhost', 'modelorama', 'models2017', 'models');
   if (mysqli_connect_errno()) {
      echo '<p> <span class="label_title">登陆失败</span> </p>';
      echo "无法连接到数据库，请稍后尝试。";
      exit;
   }

   $query = "select * from customers where name='".$userName."' and password='".$password."'";
   $result = $db->query($query);
   if (!$result or $result->num_rows <= 0) {
       echo '<p> <span class="label_title">登陆失败</span> </p>';
       echo "用户名或密码不正确，请退回注册页重新输入";
       exit;
   }
       echo '<p> <span class="label_title">登陆成功</span> </p>';
       echo "欢迎".$userName."登陆模型库。1秒后将转到";
       echo '<a href="main.html">首页</a>';
       echo "。";
       $_SESSION['userName'] = $userName;
  ?>
  </div>
  </body>
</html>
