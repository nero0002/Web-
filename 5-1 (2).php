<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>mission_5-1</title>
</head>
<body>
       <h2>みねの掲示板</h2>
        <form action="" method="post">
            <input type="string" name="name" placeholder="名前"><br>
            <input type="string" name="comment" placeholder="コメント">
            <input type="submit" name="submit"> <br><br>
            <input type="number" name="dstep" placeholder="Delete Number">
            <button type="submit" name="dflag" value=1 >削除</button><br>
            <input type="number" name="estep" >
            <button type="submit" name="eflag" value=1>編集</button>
        </form>
        <?php
 $dsn = '';
 $user = '';
 $password = '';
 $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
         //投稿
            $name = $_POST["name"];
            $comment = $_POST["comment"];
            $submitDate = date("Y/m/d/ H:i:s");
        //削除
            $dstep = $_POST["dstep"];
            $dflag = $_POST["dflag"];
        //編集
            $estep = $_POST["estep"];
            $eflag = $_POST["eflag"];
          
        
            if($dflag == 1){
                $sql = $pdo -> prepare("DELETE FROM misson5 WHERE id = :id");
             $sql -> bindParam(':id', $dstep);
                $sql -> execute();

            }elseif($eflag == 1){
             $id = $estep; //編集
             $sql = 'UPDATE misson5 SET name=:name,comment=:comment WHERE id=:id';
             $stmt = $pdo->prepare($sql);
             $stmt -> bindParam(':name', $name, PDO::PARAM_STR);
             $stmt -> bindParam(':comment', $comment, PDO::PARAM_STR);
             $stmt -> bindParam(':id', $estep);
             $stmt -> execute();
            }else{
        //データ入力
            if(!empty($name && $comment)){
             $sql = $pdo -> prepare("INSERT INTO misson5 (name, comment, submitDate) VALUES (:name, :comment, :submitDate)");
             $sql -> bindParam(':name', $name, PDO::PARAM_STR);
             $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
             $sql -> bindParam(':submitDate', $submitDate);
             $sql -> execute();
                }
            }
         //表示
            echo "表示中"."<br>";
            $sql  =  'SELECT * FROM misson5';
            $stmt =  $pdo->query($sql);
         $results = $stmt->fetchAll();
         foreach ($results as $row){
  //表示のやつ
      echo $row['id'].',';
      echo $row['name'].',';
      echo $row['comment'].',';
      echo $row['submitDate'].'<br>';
         echo "<hr>";
     }
     
 
    

        ?>
</body>
</html>
