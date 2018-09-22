<?php 
// Person 1
/*$person_name = 'Peter';
$person_speciality = 'Programmer';
$person_age = 25;
function person1_hello($name, $spec, $age) {
	echo "Hello! My name is $name. I am $spec and $age years old.";
}
person1_hello($persone_name, $person_speciality, $person_age);
echo "<br>";
echo "<br>";*/
// Person 2
/*$person2_name = 'Jane';
$person_speciality = 'Web-designer';
$person_age = 23;
function person2_hello($name, $spec, $age) {
	echo "Hello! My name is $name. I am $spec and $age years old.";
}
person2_hello($person_name, $person_speciality, $person_age);*/
class Person {
	public $name;
	public $speciality;
	public $age;
	public function __construct($name, $spec, $age){
		$this->name = $name;
		$this->speciality = $spec;
		$this->age = $age;
	}
	public function greeting() {
		echo "Hello! My name is ".$this->name.". I am ".$this->speciality." and ".$this->age." years old.";
	}
}
$person1 = new Person('Peter', 'programmer', '25');
$person2 = new Person('Jane', 'web-designer','23');
echo $person1->name;
echo "<br><br>";
$person1->greeting();
echo "<br><br>";
echo $person2->name;
echo "<br><br>";
$person2->greeting();
$person1->name = 'Peter';
$person1->speciality = 'Programmer';
$person1->age = 25;
// $person1->greeting($person1->name, $person1->speciality, $person1->age);
// $person1->greeting();
/*echo $person1 -> name;
echo $person1 -> speciality;
echo $person1 -> age;*/
 ?>