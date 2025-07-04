<?php

// ✅ 1. Calculator Class
class Calculator {
    public $a, $b;

    public function setValues($a, $b) {
        $this->a = $a;
        $this->b = $b;
    }

    public function multiply() {
        return $this->a * $this->b;
    }

    public function divide() {
        return $this->b != 0 ? $this->a / $this->b : "Division by zero error";
    }

    public function modulus() {
        return $this->a % $this->b;
    }

    public function power() {
        return $this->a ** $this->b;
    }
}

$calc = new Calculator();
$calc->setValues(10, 3);
echo "Multiply: ".$calc->multiply()."\n";
echo "Divide: ".$calc->divide()."\n";
echo "Modulus: ".$calc->modulus()."\n";
echo "Power: ".$calc->power()."\n";


// ✅ 2. Person Class
class Person {
    public $name, $age;

    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }

    public function introduce() {
        return "Hi, I'm $this->name and I'm $this->age years old.";
    }
}

$p = new Person("Priyanshu", 23);
echo $p->introduce()."\n";


// ✅ 3. Rectangle Class
class Rectangle {
    public $length, $width;

    public function __construct($length, $width) {
        $this->length = $length;
        $this->width = $width;
    }

    public function area() {
        return $this->length * $this->width;
    }

    public function perimeter() {
        return 2 * ($this->length + $this->width);
    }
}

$r = new Rectangle(10, 5);
echo "Area: ".$r->area()."\n";
echo "Perimeter: ".$r->perimeter()."\n";


// ✅ 4. Temperature Converter
class TemperatureConverter {
    public function convertToFahrenheit($celsius) {
        return ($celsius * 9/5) + 32;
    }

    public function convertToCelsius($fahrenheit) {
        return ($fahrenheit - 32) * 5/9;
    }
}

$t = new TemperatureConverter();
echo "30°C to F: ".$t->convertToFahrenheit(30)."\n";
echo "86°F to C: ".$t->convertToCelsius(86)."\n";


// ✅ 5. BankAccount with encapsulation
class BankAccount {
    private $accountHolder;
    private $balance;

    public function __construct($name, $initialBalance = 0) {
        $this->accountHolder = $name;
        $this->balance = $initialBalance;
    }

    public function deposit($amount) {
        $this->balance += $amount;
    }

    public function withdraw($amount) {
        if ($amount <= $this->balance) {
            $this->balance -= $amount;
        }
    }

    public function getBalance() {
        return $this->balance;
    }
}

$acc = new BankAccount("Priyanshu", 1000);
$acc->deposit(500);
$acc->withdraw(200);
echo "Balance: ".$acc->getBalance()."\n";


// ✅ 6. Inheritance: Employee/Manager
class Employee {
    public $name, $salary;

    public function __construct($name, $salary) {
        $this->name = $name;
        $this->salary = $salary;
    }

    public function getDetails() {
        return "$this->name earns $this->salary";
    }
}

class Manager extends Employee {
    public $department;

    public function __construct($name, $salary, $department) {
        parent::__construct($name, $salary);
        $this->department = $department;
    }

    public function getDetails() {
        return parent::getDetails()." and manages $this->department department";
    }
}

$m = new Manager("Amit", 80000, "IT");
echo $m->getDetails()."\n";


// ✅ 7. Student Grade
class Student {
    public $name;
    public $marks = [];

    public function __construct($name, $marks) {
        $this->name = $name;
        $this->marks = $marks;
    }

    public function average() {
        return array_sum($this->marks) / count($this->marks);
    }

    public function result() {
        return $this->average() >= 40 ? "Pass" : "Fail";
    }
}

$s = new Student("Priyanshu", [50, 60, 45]);
echo "Average: ".$s->average()."\n";
echo "Result: ".$s->result()."\n";


// ✅ 8. Product Discount System
class Product {
    private $price;

    public function __construct($price) {
        $this->price = $price;
    }

    public function applyDiscount($percent) {
        $this->price -= $this->price * ($percent / 100);
    }

    public function getPrice() {
        return $this->price;
    }
}

$p = new Product(1000);
$p->applyDiscount(10);
echo "Discounted Price: ".$p->getPrice()."\n";


// ✅ 9. Abstract Class Shape
abstract class Shape {
    abstract public function area();
}

class Circle extends Shape {
    public function area() {
        return 3.14 * 5 * 5; // fixed radius = 5
    }
}

$c = new Circle();
echo "Circle Area: ".$c->area()."\n";


// ✅ 10. Interface Logger
interface Logger {
    public function log($message);
}

class FileLogger implements Logger {
    public function log($message) {
        echo "Logging to file: $message\n";
    }
}

class DBLogger implements Logger {
    public function log($message) {
        echo "Logging to DB: $message\n";
    }
}

function runLogger(Logger $logger) {
    $logger->log("System error");
}

runLogger(new FileLogger());
runLogger(new DBLogger());


// ✅ 11. Library Book System
class Book {
    public $title, $author, $available;

    public function __construct($title, $author) {
        $this->title = $title;
        $this->author = $author;
        $this->available = true;
    }
}

class Library {
    public $books = [];

    public function addBook(Book $book) {
        $this->books[] = $book;
    }

    public function borrowBook($title) {
        foreach ($this->books as $book) {
            if ($book->title === $title && $book->available) {
                $book->available = false;
                return "Borrowed: $title";
            }
        }
        return "Book not available";
    }
}

$lib = new Library();
$lib->addBook(new Book("PHP Basics", "John"));
echo $lib->borrowBook("PHP Basics")."\n";


// ✅ 12. Shopping Cart
class CartItem {
    public $name, $price;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }
}

class Cart {
    public $items = [];

    public function addProduct(CartItem $item) {
        $this->items[] = $item;
    }

    public function totalAmount() {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->price;
        }
        return $total;
    }
}

$cart = new Cart();
$cart->addProduct(new CartItem("Laptop", 50000));
$cart->addProduct(new CartItem("Mouse", 500));
echo "Total: ".$cart->totalAmount()."\n";


// ✅ 13. Car Showroom
class Car {
    public $brand, $model, $price;

    public function __construct($brand, $model, $price) {
        $this->brand = $brand;
        $this->model = $model;
        $this->price = $price;
    }
}

class Showroom {
    public $cars = [];

    public function addCar(Car $car) {
        $this->cars[] = $car;
    }

    public function listCars() {
        foreach ($this->cars as $car) {
            echo "$car->brand $car->model - Rs.$car->price\n";
        }
    }

    public function filterByBrand($brand) {
        foreach ($this->cars as $car) {
            if ($car->brand === $brand) {
                echo "$car->brand $car->model - Rs.$car->price\n";
            }
        }
    }
}

$sr = new Showroom();
$sr->addCar(new Car("Toyota", "Innova", 2500000));
$sr->addCar(new Car("Tesla", "Model S", 7500000));
echo "All Cars:\n";
$sr->listCars();
echo "\nFiltered Cars (Tesla):\n";
$sr->filterByBrand("Tesla");


// ✅ 14. Static Practice
class MathUtil {
    public static function factorial($n) {
        $f = 1;
        for ($i = 1; $i <= $n; $i++) $f *= $i;
        return $f;
    }

    public static function isPrime($n) {
        if ($n < 2) return false;
        for ($i = 2; $i <= sqrt($n); $i++)
            if ($n % $i == 0) return false;
        return true;
    }

    public static function fibonacci($n) {
        $a = 0; $b = 1;
        $series = [$a, $b];
        for ($i = 2; $i < $n; $i++) {
            $c = $a + $b;
            $series[] = $c;
            $a = $b;
            $b = $c;
        }
        return $series;
    }
}

echo "Factorial of 5: ".MathUtil::factorial(5)."\n";
echo "Is 7 Prime? ".(MathUtil::isPrime(7) ? "Yes" : "No")."\n";
echo "Fibonacci(7): ".implode(", ", MathUtil::fibonacci(7))."\n";

?>
