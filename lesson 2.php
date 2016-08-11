// learn about strings in php //
http://php.net/manual/en/language.types.string.php#language.types.string.syntax.nowdoc

// learn spl iterating //
http://www.phpro.org/tutorials/Introduction-to-SPL.html 

//learn objects //
http://www.killerphp.com/tutorials/php-objects-page-3/

http://www.hongkiat.com/blog/useful-calendar-date-picker-scripts-for-web-developers/


<?php
//using heredoc syntaxes //
// note this is used to escape texts from php codes //

$string = "Hello"; 
echo <<< EOD
Hello and welcome $string or {$string}
EOD;

// using tenary operator ? //
$username = (isset($_POST["username"])) ? "username" : "default"; 

// to check if a particular function exists //
function_exists(string function_name);

//escaping text in double quotes //
$bar = "my name";
echo "bar variable is {$bar} barname"; 

// if its a static object //
class mysample {
	public static $mybar = "bar"; 
}
echo "The value of my var is {${mysample::$mybar}}"; 
//escaping a php coe in a double quote // 

// checks if the argument is an array //
is_array(string )

// searching for a text or character in a text //
//strpos(), the first parameter is the string to search //
//second parameter is what to search for //
// third parameter is to decide where to start from or ignore search before  //
$findme = ".com";
$search_text = "ayodele.com"; 
strpos($search_text, $findme); 
//strpos return false if the text is not found //

//check if a particular value is in an array //
in_array("text", $array)//
//returns true if text is found //

//using str_replace() //
//this function takes a search string/array, a pattern and what to replace with //
// example //
// Provides: You should eat pizza, beer, and ice cream every day
// the first parameter is an array of what to look for // 
// the second parameter is an array of what to replace with //
$phrase  = "You should eat fruits, vegetables, and fiber every day.";
$healthy = array("fruits", "vegetables", "fiber");
$yummy   = array("pizza", "beer", "ice cream");
$newphrase = str_replace($healthy, $yummy, $phrase);

//removing characters from a string //
//using chop() //
//first parameter is search string //
//second parameter is what to remove //
$search = "Hello world <br/>";
//this remove line break, "" to remove whitespace, "\r" or "\t" //
//remember this will only remove from the right hand side //
chop($search, "\n");


//replacing part of a string with another string //
//using strstr() //
//the 1st parameter can be a text containing the original text //
// the second parameter can be a string or array containing strings to replace //
//example //
$arr = array("Hello" => "Hi", "world" => "earth");
echo strtr("Hello world",$arr);
// the array arr contains the text to look for and what to replace with//
//the array must be an associative array //

//searching for a particular string in a string //
//strpos()//
//this will only look for the first occurence of the string //
strpos("I love php, I love php too!","php");
//the 1st parameter is the original text, 2nd parameter is what to search for // 
//it always returns a number containing the occurence of the string //
//if not found, it returns false //

//changing cases //
//ucwords(string) - Hello World A Boy 
//strtoupper(string) - HELLO WORLD A BOY 
//strtolower(string) - hello world a boy 
//ucfirst(string) - Hello world a boy 


//to validate a date //
//checkdate($date) - date has to be d/m/y format
//returns true or false //

//create a date from PHP date object //
//date_create(string) - this creates a date object //
$date=date_create("2013-03-15 23:40:00",timezone_open("Europe/Oslo"));
echo date_format($date,"Y/m/d H:iP");
// the third parameter is optional (timezone) //
//date_format format the date created //

//setting date timezone in PHP //
date_default_timezone_set("Asia/Bangkok");
echo date_default_timezone_get();
//date_default_timezone_get and date_default_timezone_set //

//adding to a date //
//use the date_create to convert to date object //
$date=date_create("2013-03-15");
date_add($date,date_interval_create_from_date_string("40 days"));
echo date_format($date,"Y-m-d");


//calculating dates and days //
$date1=date_create("2013-01-01");
$date2=date_create("2013-02-10");

// the date_diff finds the difference between the 2 days //
$diff=date_diff($date1,$date2);

// %a outputs the total number of days, which can be other formats //
echo $diff->format("Total number of days: %a.");
//for full list of format http://www.w3schools.com/php/func_date_interval_format.asp //

//setting the time through date_create object //
//first param is date object, second param is hour, minute and seconds //
date_time_set($date,13,24);
echo date_format($date,"Y-m-d H:i:s") . "<br>";

date_time_set($date,12,20,55);
echo date_format($date,"Y-m-d H:i:s");
//

//date_create_from_format() //
//accepts two param//
//param 1 is the format i.e."d/m/y or j/m/y"//
//second param is the text to convert i.e. "12/2/1999"
$date=date_create_from_format("j-M-Y","15-Mar-2013");

//methods that work with date_create //
date_format(); 
date_add();
date_sub();
date_diff();
date_time_set();


//using the date function //
// Prints the day, date, month, year, time, AM or PM //
//alias of long date format //
//i.e. Monday 15th of February 2016 12:38:17 PM //
echo date("l jS \of F Y h:i:s A") . "<br>";

// Prints October 3, 1975 was on a Friday//
//the mktime function creates a date or time from a param //
//mktime param starts from milliseconds , 6 params in total //
echo "Oct 3,1975 was on a ".date("l", mktime(0,0,0,10,3,1975)) . "<br>";

//strtotime() - this returns a no of seconds //
//the param can be a string, but must be used inside a date() or date object to convert the sec to a readable format //
strtotime("now") or strtotime("+1 week") or strtotime("next Monday");

file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND); //logging errors in a file log //

class Blar_DateTime extends DateTime {

    /**
     * Return Date in ISO8601 format
     *
     * @return String
     */
    public function __toString() {
        return $this->format('Y-m-d H:i');
    }

    /**
     * Return difference between $this and $now
     *
     * @param Datetime|String $now
     * @return DateInterval
     */
    public function diff($now = 'NOW') {
        if(!($now instanceOf DateTime)) {
            $now = new DateTime($now);
        }
        return parent::diff($now);
    }

    /**
     * Return Age in Years
     *
     * @param Datetime|String $now
     * @return Integer
     */
    public function getAge($now = 'NOW') {
        return $this->diff($now)->format('%y');
    }

}

$result = mysql_query("SELECT `datetime` FROM `table`");
$row = mysql_fetch_row($result);
$date = date_create($row[0]);

echo date_format($date, 'Y-m-d H:i:s');
#output: 2012-03-24 17:45:12

echo date_format($date, 'd/m/Y H:i:s');
#output: 24/03/2012 17:45:12

echo date_format($date, 'd/m/y');
#output: 24/03/12

echo date_format($date, 'g:i A');
#output: 5:45 PM

echo date_format($date, 'G:ia');
#output: 05:45pm

echo date_format($date, 'g:ia \o\n l jS F Y');
#output: 5:45pm on Saturday 24th March 2012

$date1 = new DateTime("now");
$date2 = new DateTime("tomorrow");

var_dump($date1 == $date2);
var_dump($date1 < $date2);
var_dump($date1 > $date2);



// Example

   $strStart = '2013-06-19 18:25';
   $strEnd   = '06/19/13 21:47';

?>

2. Next convert the string to a date variable
~~~
<?php

   $dteStart = new DateTime($strStart);
   $dteEnd   = new DateTime($strEnd);

?>
~~~

3. Calculate the difference
~~~
<?php

   $dteDiff  = $dteStart->diff($dteEnd);

?>
~~~

4. Format the output
~~~
<?php

   print $dteDiff->format("%H:%I:%S");

/*
    Outputs
   
    03:22:00
*/ 

 $date1 = new DateTime('2011-04-01');
    $date2 = new DateTime("now");
    $interval = $date1->diff($date2);
    $years = $interval->format('%y');
    $months = $interval->format('%m');
    $days = $interval->format('%d');
    if($years!=0){
        $ago = $years.' year(s) ago';
    }else{
        $ago = ($months == 0 ? $days.' day(s) ago' : $months.' month(s) ago');
    }
    echo $ago;
$d = new DateTime('2011-01-01T15:03:01.012345Z');

// Output the microseconds.
echo $d->format('u'); // 012345

// Output the date with microseconds.
echo $d->format('Y-m-d\TH:i:s.u'); // 2011-01-01T15:03:01.012345

function IsDate( $Str )
{
  $Stamp = strtotime( $Str );
  $Month = date( 'm', $Stamp );
  $Day   = date( 'd', $Stamp );
  $Year  = date( 'Y', $Stamp );

  return checkdate( $Month, $Day, $Year );
}

$result = $pdo->query("SELECT id, name, salary FROM employees");
while (list($id, $name, $salary) = $result->fetch(PDO::FETCH_NUM)) {
    echo " <tr>\n" .
          "  <td><a href=\"info.php?id=$id\">$name</a></td>\n" .
          "  <td>$salary</td>\n" .
          " </tr>\n";
}

list($a, list($b, $c)) = array(1, array(2, 3));

var_dump($a, $b, $c);

function array_change_key_case_recursive($arr)
{
    return array_map(function($item){
        if(is_array($item))
            $item = array_change_key_case_recursive($item);
        return $item;
    },array_change_key_case($arr));
}

print_r(array_chunk($input_array, 2));

function count_recursive ($array, $limit) { 
    $count = 0; 
    foreach ($array as $id => $_array) { 
        if (is_array ($_array) && $limit > 0) { 
            $count += count_recursive ($_array, $limit - 1); 
        } else { 
            $count += 1; 
        } 
    } 
    return $count; 
} 

$email = test_input($_POST["email"]);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $emailErr = "Invalid email format"; 
}

$name = test_input($_POST["name"]);
if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
  $nameErr = "Only letters and white space allowed"; 
}

php email regex = ^([a-z_])+([a-z_.\-0-9])+@([a-z]){3,8}+\.([a-z]){2,4}(\.([a-z]){2,4})?$
[a-zA-Z_]+\W*\d+\w*\W*

<?php
// create a copy of $start and add one month and 6 days
$end = clone $start;
$end->add(new DateInterval('P1M6D'));

$diff = $end->diff($start);
echo 'Difference: ' . $diff->format('%m month, %d days (total: %a days)') . "\n";
// Difference: 1 month, 6 days (total: 37 days) //


//regex for whiteline //
/(.)(\n)/gm
// /<\s*\/*\s*([A-Z][A-Z0-9]*)\b[^>]*\/*\s*>/ //hmtl tags //

preg_replace($pattern, $replacement, $string); //pattern and replacement can be an array //

$link = new PDO(
    'mysql:host=your-hostname;dbname=your-db;charset=utf8mb4',
    'your-username',
    'your-password',
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_PERSISTENT => false
    )
);
header('Content-Type: text/html; charset=UTF-8');


$db = new PDO('mysql:host=localhost;dbname=testdb;charset=utf8', 'username', 'password');

// Make your model available
include 'models/FooModel.php';

// Create an instance
$fooModel = new FooModel($db);
// Get the list of Foos
$fooList = $fooModel->getAllFoos();

// Show the view
include 'views/foo-list.php';

class FooModel
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllFoos() {
        return $this->db->query('SELECT * FROM table');
    }
}


//simple mvc //
class Model
{
    public $string;

    public function __construct(){
        $this->string = “MVC + PHP = Awesome, click here!”;
    }

}

class View
{
    private $model;
    private $controller;

    public function __construct($controller,$model) {
        $this->controller = $controller;
        $this->model = $model;
    }

    public function output() {
        return '<p><a href="mvc.php?action=clicked"' . $this->model->string . "</a></p>";
    }
}

class Controller
{
    private $model;

    public function __construct($model){
        $this->model = $model;
    }

    public function clicked() {
        $this->model->string = “Updated Data, thanks to MVC and PHP!”
    }
}

$model = new Model();
$controller = new Controller($model);
$view = new View($controller, $model);

if (isset($_GET['action']) && !empty($_GET['action'])) {
    $controller->{$_GET['action']}();
}

echo $view->output();

ksort() & krsort();
?>