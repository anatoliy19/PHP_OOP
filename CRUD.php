<?php
//require "db.php";

require "libs/rb-mysql.php";
R::setup('mysql:host=localhost;dbname=school','root','');
//заморозка состояния базы данных от автоматического изменения
//R::freeze( TRUE);

//Создание новых записей
/*$course = R::dispense('courses');
//задание имени
$course->title = "Курс по <верстке> 2";

$course->tuts=10;
$course->homeworks=8;
$course->level="Для новичков";
R::store($course);

//сохранение имени
R::store($course);*/

//Получение всех записей
$courses = R::find('courses');
//print_r($courses);

foreach ($courses as $course => $value) {
		/*echo "ID: " . $value->id ."<br>";
		echo "Название: " . $value->title ."<br>";
		echo "Количество уроков: " . $value->tuts ."<br>";
		echo "Уровень: " . $value->level ."<br>";*/
}

//Обновление записи в БД
    //Получение одного курса

$course = R::load('courses',4);
//print_r($course);
echo "ID: " . $course->id . "<br>";
echo "Название: " . $course->title . "<br>";

     //Теперь изменение
$course->title = "Курс по React: ступень 1";
$course->tuts = 20;
$course->students = 20;
R::store($course);

//Удаление записей
$course = R::load('courses',16);
R::trash( $course);

?>