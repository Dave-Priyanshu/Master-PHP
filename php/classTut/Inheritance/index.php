<?php 
class Animal{
    public $animal , $sound;
    public function __construct($animal , $sound)
    {
        $this->animal = $animal;
        $this->sound = $sound;
    }

    public function makeSound(){
        return "$this->animal makes $this->sound Sound";
    }
}

class Dog extends Animal{

}

class Cat extends Animal{
    
}
class Cow extends Animal{
    
}
echo "<h3>1. Animal Sound Simulator 🐾</h3>";
$dog = new Dog("Dog", "barking");
$cat = new Cat("Cat", "Meow");
$Cow = new Cow("Cow", "Moo");
echo $dog->makeSound()."<br>";
echo $cat->makeSound()."<br>";
echo $Cow->makeSound()."<br><br>";

class Vehicle{
    public $brand, $year;

    public function __construct($brand, $year)
    {
        $this->brand = $brand;
        $this->year = $year;
    }
    public function getInfo(){
        return "This vehicale is manufractured by: $this->brand in Year $this->year ";
    }
}

class Car extends Vehicle{
    public $fuelType;

    public function __construct($brand, $year, $fuelType)
    {
        parent::__construct($brand, $year); //call to parent
        $this->fuelType = $fuelType;
    }
    public function getInfo()
    {
        return parent::getInfo(). "<br>The Fuel Type is: $this->fuelType";
    }

}

class Bike extends Car{
    public $hasCarrier;

    public function __construct($brand, $year, $fuelType, $hasCarrier)
    {
        parent::__construct($brand, $year, $fuelType);
        $this->hasCarrier = $hasCarrier;
    }

    public function getInfo()
    {
        $carrierText = $this->hasCarrier ? "<br>Comes with a Carrier" : "<br>Doesn't come with a Carrier";
        return parent::getInfo() . "$carrierText";
    }
}

echo "<h3>2. Vehicle Info System 🚗</h3>";
$car = new Car("Toyota",1976,"Petrol");
$bike = new Bike("Bajaj",2000,"Petrol",true);
echo $car->getInfo(). "<br>";
echo $bike->getInfo(). "<br><br>";

class Employee{
    public $name, $salary;
    public function __construct($name, $salary)
    {
        $this->name = $name;
        $this->salary = $salary;
    }

    public function getDetails(){
        return "Employee name -  $this->name : Employee Salary - $this->salary";
    }
}
class Manager extends Employee{
    public $department;
    public function __construct($name,$salary,$department)
    {
        parent::__construct($name,$salary);
        $this->department = $department;
    }
    public function getDetails(){
        return "Department: $this->department<br>" . parent::getDetails();
    }
}

echo "<h3>3. Employee Hierarchy 💼</h3>";
$emp1 = new Employee("Priyanshu Dave",60000);
$man1 = new Manager("Dhruvin Dave",90000,"Manager");
echo $emp1->getDetails(). "<br>";
echo $man1  ->getDetails(). "<br><br>";


class Account{
    public $accountNumber, $balance;
    public function __construct($accountNumber, $balance)
    {
        $this->accountNumber = $accountNumber;
        $this->balance = $balance;
    }

    public function deposit($amount){
        if($amount > 0){
            $this->balance += $amount;
            return "₹$amount deposited. New Balance is $this->balance";
        }else{
            return "Invalid deposit amount";
        }
    }

    public function withdraw($amount){
        if($amount <= $this->balance){
            $this->balance -= $amount;
            return "₹$amount withdrawn. New Balance is $this->balance";
        }else{
            return "Insufficient balance. Current balance: ₹$this->balance";
        }

    }
}
class SavingsAccount extends Account{
    public $interestRate;

    public function __construct($accountNumber, $balance, $interestRate)
    {
        parent::__construct($accountNumber, $balance);
        $this->interestRate = $interestRate;
    }

    public function calculateInterest(){
        $interest = $this->balance * ($this->interestRate / 100);
        return "Interest earned at $this->interestRate% is $interest";
    }
}


echo "<h3>4. Account System 🏦</h3>";
$acc = new SavingsAccount('PD123456789',60000,10);
echo $acc->deposit(5000). "<br>";
echo $acc->withdraw(60000);
echo $acc->calculateInterest(). "<br><br>";


class Payment{
    public function pay($amount){
        return "Payment of ₹$amount Recived";
    }
}
class CreditCardPayment extends Payment{
    public function pay($amount){
        return "Paid via Credit Card: ₹$amount";
    }
}
class UPIPayment extends Payment{
    public function pay($amount){
        return "Paid via UPI: ₹$amount";
    }
}

function processPayment(Payment $paymentMethod,$amount){
    echo $paymentMethod->pay($amount) . "<br>";
}

echo "<h3>6. Online Payment Gateway 💳</h3>";
// $pay = new Payment();
$cc = new CreditCardPayment();
$upi = new UPIPayment();

// echo $pay->pay(500) . "<br>";
processPayment($cc, 1000). "<br>";
processPayment($upi, 2000). "<br><br>";


class user{
    public $username, $role;
    public function __construct($username, $role = "User")
    {
        $this->username = $username;
        $this->role = $role;
    }
    public function getPermissions(){
        return "Basic Access";  
    }
    public function getDetails(){
        return "User: $this->username | Role: $this->role | Permission: ". $this->getPermissions();
    }
}

class admin extends user{
    public function __construct($username)
    {
        parent::__construct($username,"Admin");
    }
        public function getPermissions(){
        return "Full Access";  
    }
}

class editor extends user{
    public function __construct($username)
    {
        parent::__construct($username,"Editor");
    }
     public function getPermissions(){
        return "Edit Access";  
    }
}

class viewer extends user{
    public function __construct($username)
    {
        parent::__construct($username,"Viewer");
    }
     public function getPermissions(){
        return "Read-only";  
    }
}
echo "<h3>8. User Roles and Access 🔐</h3>";

$admin = new Admin("Priyanshu");
$editor = new Editor("Dhruvin");
$viewer = new Viewer("Raj");

echo $admin->getDetails() . "<br>";
echo $editor->getDetails() . "<br>";
echo $viewer->getDetails() . "<br>";


abstract class ParentClass{
    public $name;

    abstract public function calc($a, $b);
}

class child extends ParentClass{
    public function calc($a, $b){
        echo $a+$b;
    }
}

echo "<h3>9. Abstract class</h3>";
$child = new child();
echo $child->calc(5,5);
?>