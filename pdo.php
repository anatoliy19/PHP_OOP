<?php

//Простой выбор данных из БД
//когда SQL запрос внутри кода
$db = new PDO('mysql:host=localhostldbname=WD04-filmoteka-andreev','root','');

$sql = "SELECT * FROM movies";
$result = $db->query($sql);

 
/*while($film = $result->fetch(PDO::FETCH_ASSOC)){
	print_r($film);
	echo "Название фильма: " . $film['title'] . "<br>";
}
*/

//============== 2 вариант
$sql = "SELECT * FROM movies";
$result = $db->query($sql);
$films = $result->fetchAll(PDO::FETCH_ASSOC);

foreach ($films as $film){
	echo "Название фильма: " . $film['title'] . "<br>";
}
//============= 3 вариант
$sql = "SELECT * FROM movies";
$result = $db->query($sql);

$result->bindColumn('id',$id);
$result->bindColumn('title',$title);
$result->bindColumn('year',$year);

while($result->fetch(PDO::FETCH_ASSOC)){	 
	echo "Название фильма: {$title}  <br>";
}

//Запрос с обработкой данных,
//если данные получаем от пользователя

$db = new PDO('mysql:host=localhostldbname=mini-site','root','');

//1.Выборка без защиты от SQL инъекции
$username = 'Joker';
$password = '555';
$sql = "SELECT * FROM users WHERE name = '{$username}' AND password = '{$password}' LIMIT 1";
$result = $db->query($sql);

if ($result->rowCount() == 1){

   $user = $result->fetch(PDO::FETCH_ASSOC);

   echo "Имя пользователя: {$user['name']} <br>";
}


//2. Выборка с защитой от SQL инъекции  
$username = 'Joker';
$password = '555';

$username = $db->quote($username);
$username = strtr($username, array('_'=>'\_','%'=>'\%'));

$password = $db->quote($password);
$password = strtr($password, array('_'=>'\_','%'=>'\%'));

$sql = "SELECT * FROM users WHERE name = '{$username}' AND password = '{$password}' LIMIT 1";

$result = $db->query($sql); 

if ($result->rowCount() == 1){

   $user = $result->fetch(PDO::FETCH_ASSOC);

   echo "Имя пользователя: {$user['name']} <br>";

}

//3. Выборка с защитой от SQL инъекции в автоматическом режиме

$sql = "SELECT * FROM users WHERE name = :username AND password = :password LIMIT 1";

$stmt = $db->prepare($sql);
$username = 'Joker';
$password = '555';

//первый вариант - bindValue
$stmt->bindValue(':username',$username);
$stmt->bindValue(':password',$password);
$stmt->execute();

//другой вариант - передать параметры в execute
//вместо bindValue
$stmt->execute(array(':username'=>$username, ':password'=>$password));
//------- 
$stmt->bindColumn('name',$name);
$stmt->bindColumn('email',$email);

$stmt->fetch();
echo "Имя пользователя: {$user['name']} <br>";


//4. Выборка с защитой от SQL инъекции в автоматическом режиме - другой формат запроса

$sql = "SELECT * FROM users WHERE name = ? AND password = ? LIMIT 1";
$stmt = $db->prepare($sql);

$username = 'Joker';
$password = '555';

//первый вариант - bindValue
$stmt->bindValue(1,$username); //Номера параметров в выражении SELECT
$stmt->bindValue(2,$password);
$stmt->execute();

//вариант с одной строкой execute:
$stmt->execute( array($username,$password));

//подготовить колонки 
$stmt->bindColumn('name',$name);
$stmt->bindColumn('email',$email);

$stmt->fetch();
echo "Имя пользователя: {$user['name']} <br>";

//Вставка данных в БД
$db = new PDO('mysql:host=localhostldbname=mini-site','root','');
$sql = "INSERT INTO (name,email) VALUES (:name,:email)";
$stmt = $db->prepare($sql);

$username = "Flash";
$email    = "flash@gmail.com";

//bindValue подставляет значения в placeholder ':name, :email'
$stmt->bindValue(':name',$name);
$stmt->bindValue(':email',$email);

$stmt->execute( array(':username'=>$username,':password'=>$password));

echo "Было затронуто строк: " .$stmt->rowCount() ."</p>";
echo "<p> ID последней вставленной записи: " .$db->lastInsertId() . "</p>";

//Обновление данных
$db = new PDO('mysql:host=localhostldbname=mini-site','root','');
$sql = "UPDATE users SET name = :name WHERE id = :id";
$stmt = $db->prepare($sql);

$username = "New Flash";
$id       = '7';
$stmt->bindValue(':name',$username);
$stmt->bindValue(':id',$id);
$stmt->execute();
echo "Было затронуто строк: " .$stmt->rowCount() ."</p>";

//Удаление данных
$db = new PDO('mysql:host=localhostldbname=mini-site','root','');
$sql = "DELETE FROM users WHERE name = :name";
$stmt = $db->prepare($sql);
 
$stmt->bindValue(':name',$username);
$stmt->execute();
echo "Было затронуто строк: " .$stmt->rowCount() ."</p>";

?> 