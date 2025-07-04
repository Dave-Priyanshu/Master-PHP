<?php

class calculation{
public $a,$b,$c;

    public function sum(){
        $this->c = $this->a + $this->b;
        return $this->c;
    }

    public function sub() {
        $this->c = $this->a - $this->b;
        return $this->c;
    }
}
echo "1. Simple Calculation code:";
$c1 = new calculation();
$c1->a=10;
$c1->b=10;
echo "Sum is: ". $c1->sum(). "<br>";
$c2 = new calculation();
$c2->a=50;
$c2->b=10;
echo "Sub is: ".$c2->sub(). "<br><br><br>";


// person class

class Person{
    public $name, $age, $email;

    public function __construct($name, $age, $email)
    {
        $this->name = $name;
        $this->age = $age;
        $this->email = $email;
    }

    public function sayHello(){
        if($this->age > 18){

            return "Hello $this->name, your new email is '<b>$this->email</b>' because your age is above 18";
        }else{
            return "Hello $this->name, your new email '<b>$this->email</b>' is not verified because your age is not above 18";
        }
    }
}
echo "2. Simple Person class with __construct method:<br>";
$sh = new Person("Priyanshu Dave",19,"test@123");
// $sh->name = "Priyanshu Dave";
// $sh->email = "test@gmail.com";
echo $sh->sayHello()."<br><br><br>";



class student{
    public $name, $rollNo, $percentage;

    public function __construct($name, $rollNo, $percentage)
    {
        $this->name = $name;
        $this->rollNo = $rollNo;
        $this->percentage = $percentage;
    }

    public function getResult(){
        if($this->percentage >= 40){
            return "Student : $this->name <br> Roll no: $this->rollNo has <b>Passed</b> the Exams.";
        }else{
            return "Student : $this->name <br> Roll no: $this->rollNo has <b>Failed</b> the Exams.";
        }
    }
}
echo "3. Student Registration :<br>";
$stud = new student("Priyanshu Dave",30,30);
echo $stud->getResult()."<br><br><br>";

class book{
    public $title, $author, $price;
    
    public function __construct($title, $author, $price)
    {
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
    }
    public function getSummary(){
        return "Book : $this->title by $this->author - Price $this->price";
    }
}

echo "4. Book Details Display :<br>";
$book = new book("The Dive","Priyanshu Dave",60000);
$book2 = new book("The Try","Priyanshu Dave",70000);
echo $book->getSummary()."<br>";
echo $book2->getSummary()."<br><br><br>";


class Employee{
    public $name, $position, $salary;

    public function __construct($name, $position, $salary){
        
        $this->name = $name;
        $this->position = $position;
        $this->salary = $salary;
    }
    public function calculateBonus(){
        $bonusPercentage = 0;

        switch(strtolower($this->position)){
            case 'manager':
                $bonusPercentage = 20;
                break;
            case 'developer':
                $bonusPercentage = 10;
                break;
            case 'intern':
                $bonusPercentage = 5;
                break;
            default:
                $bonusPercentage = 2;
                break;
        }
        $bonus = $this->salary * ($bonusPercentage / 100);
        $totalSalaray = $this->salary + $bonus;
        return "Bonus for $this->name (Position: $this->position) is $bonus<br> Total Salary: $totalSalaray";
    }
}

echo "5. Employee Bonus Calculator :<br>";
$emp1 = new Employee("Priyanshu Dave","developer",60000);
echo $emp1->calculateBonus()."<br><br><br>";
?>
