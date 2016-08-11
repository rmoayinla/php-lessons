<?php
http://php.net/manual/en/language.constants.predefined.php 

https://borntolearn.mslearn.net/goodstuff/p/students?WT.mc_id=WWLeX_AcademicMCP_DG_GD_banner_S3b&gclid=CLbKvOb1hssCFUKeGwodtNYBpw

//detect mobile or phone with php 
http://stackoverflow.com/questions/4117555/simplest-way-to-detect-a-mobile-device
http://mobiledetect.net/
http://wurfl.sourceforge.net/php_index.php

//dealing with files //
//we can loop through files using  //
//directoryiterator //
//fileiterator //
//example //

$dir = new DirectoryIterator(dirname(__FILE__));
foreach ($dir as $fileinfo) {
    echo $fileinfo;
}

//using recursiveiteratoriterator //
//with recursivedirectoryiterator //
//example //
$directory = "/tmp/";
$fileSPLObjects =  new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($directory),
                RecursiveIteratorIterator::CHILD_FIRST
            );
try {
    foreach( $fileSPLObjects as $fullFileName => $fileSPLObject ) {
        print $fullFileName . " " . $fileSPLObject->getFilename() . "\n";
    }
}
catch (UnexpectedValueException $e) {
    printf("Directory [%s] contained a directory we can not recurse into", $directory);
}

//using recursivearrayiterator //
$iterator = new RecursiveArrayIterator($myArray);
iterator_apply($iterator, 'traverseStructure', array($iterator));

function traverseStructure($iterator) {
   // check if the array or value is valid //
    while ( $iterator -> valid() ) {
        //if the current value is an array //
        if ( $iterator -> hasChildren() ) {
       
            traverseStructure($iterator -> getChildren());
           
        }
        else {
			// the current method shows the current value //
            echo $iterator -> key() . ' : ' . $iterator -> current() .PHP_EOL;   
        }
        // moves the array cursor //
        $iterator -> next();
    }
} 




//if it is a single file //
//we can use pathinfo() //
// you can add an additional parameter //
// PATHINFO_DIRNAME | PATHINFO_BASENAME | PATHINFO_EXTENSION | PATHINFO_FILENAME ]
//example //
$path_parts = pathinfo('/www/htdocs/inc/lib.inc.php');
// this will return an array //

echo $path_parts['dirname'], "\n"; // output: /www/htdocs/inc //
echo $path_parts['basename'], "\n"; // output: lib.inc.php //
echo $path_parts['extension'], "\n"; // output: php //
echo $path_parts['filename'], "\n"; // output: lib.inc -   since PHP 5.2.0 //




//working with php cookies //
//cookies can be used to store user specific info or details//
//unlike GET request which display in url, cookies are encoded //
//the set_cookie() is used to set and delete //
//$_COOKIES global variable //
//example //
$cookie_name = "user";
$cookie_value = "John Doe";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day 
//note: this little code must come before the html tag // 
//this code create a cookie with the name : user, value is John Doe, set to expire in a month //
//to retreive this cookie //
if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name];
}

//to check if cookie is enabled in a user browser //
if(count($_COOKIE) > 0) {
    echo "Cookies are enabled.";
} else {
    echo "Cookies are disabled.";
}
//============================================== //



//======= calling a user defined function for each element in an array ==== //
//array_walk(array, function()) //
// you can add additional parameter to the function //
function myfunction($value,$key)
{
echo "The key $key has the value $value<br>";
}
$a=array("a"=>"red","b"=>"green","c"=>"blue");
array_walk($a,"myfunction");
//============================================= //

//replacing elements of an array //
//array_replace//
//this function accepts two parameters both an array //
//array_replace(originalarray(), replacearray())



//note: this will only walk on iterators //
//apply a function to every element of an iterator i.e arrayiterator, recursiveiterator etc //
//iterator_apply(iterator, function(), array(iterator))//
//example//
function print_caps(Iterator $iterator) {
    echo strtoupper($iterator->current()) . "\n";
    return TRUE;//this makes sure the function is applied to all the elements //
}

$it = new ArrayIterator(array("Apples", "Bananas", "Cherries"));
iterator_apply($it, "print_caps", array($it));


//converting an iterator object to an array//
//iterator_to_array(iterator, true)//
//the 2nd parameter ensures the keys are preserved either its a string or int //
//example //
$iterator = new ArrayIterator(array('recipe'=>'pancakes', 'egg', 'milk', 'flour'));
var_dump(iterator_to_array($iterator, true));
var_dump(iterator_to_array($iterator, false));


//using constants in php//
//once defined constants cannot be redefined or undefined //
//example//
define("CONSTANT", "Hello world.");
echo CONSTANT; // outputs "Hello world."
const ANIMALS = array('dog', 'cat', 'bird');
echo ANIMALS[1]; // outputs "cat"


//reserved constants //
//PHP_EOL - to insert end of line for the current platform //


//getting file and folder paths //
__FILE__
__DIR__
realpath(dirname(__FILE__))
//going back to a folder //
./php or ../php or .../php 
//a simple workaround //
function abspath($file)
{
  return realpath(dirname($file));
}
abspath(__FILE__); 



//SPL_AUTOLOAD//
//example //
 // Your custom class dir
    define('CLASS_DIR', 'class/')

    // Add your class dir to include path
    set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);

    // You can use this trick to make autoloader look for commonly used "My.class.php" type filenames
    spl_autoload_extensions('.class.php');

    // Use default autoload implementation
    spl_autoload_register();
	
//example 2 //
function autoload($className) {
    set_include_path('./library/classes/');
    spl_autoload($className); //replaces include/require
}
spl_autoload_extensions('.class.php');
spl_autoload_register('autoload');


//setting default include path //
$path = '/usr/lib/pear';
//note this will add the previously set include path to the specified folder //
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
set_include_path('/usr/lib/pear');

//using PATH_SEPARATOR //
//you can set multiple folders as your include path i.e c:/home;c:/home/includes;c:/home/php/includes//
//the ; or : is the path separator //


//logging events into a log file //
// removes a file from the hard drive that
// the PHP user has access to.
$username = $_SERVER['REMOTE_USER']; // using an authentication mechanism
$userfile = basename($_POST['user_submitted_filename']);
$homedir  = "/home/$username";

$filepath = "$homedir/$userfile";

if (file_exists($filepath) && unlink($filepath)) {
    $logstring = "Deleted $filepath\n";
} else {
    $logstring = "Failed to delete $filepath\n";
}
$fp = fopen("/home/logging/filedelete.log", "a");
fwrite($fp, $logstring);
fclose($fp);



//using var_dump to debug //
function htmldump($variable, $height="9em") {
echo "<pre style=\"border: 1px solid #000; height: {$height}; overflow: auto; margin: 0.5em;\">";
var_dump($variable);
echo "</pre>\n";
}



//checking data types //
is_array — Finds whether a variable is an array
is_bool — Finds out whether a variable is a boolean
is_callable — Verify that the contents of a variable can be called as a function
is_double — Alias of is_float
is_float — Finds whether the type of a variable is float
is_int — Find whether the type of a variable is integer
is_integer — Alias of is_int
is_long — Alias of is_int
is_null — Finds whether a variable is NULL
is_numeric — Finds whether a variable is a number or a numeric string
is_object — Finds whether a variable is an object
is_real — Alias of is_float
is_resource — Finds whether a variable is a resource
is_scalar — Finds whether a variable is a scalar
is_string — Find whether the type of a variable is string
isset — Determine if a variable is set and is not NULL
empty 
unset
var_dump



/*
A php.ini file will not inherit down into subfolders. However, you can create a .htaccess file in the same folder as the php.ini file and place the following code into it:

suPHP_ConfigPath /home/username/public_html/
where "username" is your cPanel username. This will cause the php.ini file to affect all subfolders, unless a php.ini file is in a subfolder, at which point the php.ini in the subfolder takes precedence.
*/


//sample of a dbase class //
abstract class DataRecord {
    private static $db; // MySQLi-Connection, same for all subclasses
    private static $table = array(); // Array of tables for subclasses
    
    public static function init($classname, $table, $db = false) {
        if (!($db === false)) self::$db = $db;
        self::$table[$classname] = $table;
    }
    
    public static function getDB() { return self::$db; }
    public static function getTable($classname) { return self::$table[$classname]; }
}

class UserDataRecord extends DataRecord {
    public static function fetchFromDB() {
        $result = parent::getDB()->query('select * from '.parent::getTable('UserDataRecord').';');
        
        // and so on ...
        return $result; // An array of UserDataRecord objects
    }
}

$db = new MySQLi(...);
UserDataRecord::init('UserDataRecord', 'users', $db);
$users = UserDataRecord::fetchFromDB();






//using traits//
//the visibility of a property or method can be changed when inserting a trait //
//example //
trait HelloWorld {
    public function sayHello() {
        echo 'Hello World!';
    }
}

// Change visibility of sayHello
class MyClass1 {
    use HelloWorld { sayHello as protected; }
}

// Alias method with changed visibility
// sayHello visibility not changed
//or even create a new alias //
class MyClass2 {
    use HelloWorld { sayHello as private myPrivateHello; }
}

$a = htmlentities($orig);

$b = html_entity_decode($a);

html_entity_decode($str, ENT_COMPAT, 'UTF-8');

array_map(function($n) { return $n * 2; }, $results);

function output_element(&$a) {
   $a = $a*2;
   print("Element value: $a\
"); 
}

array_walk($results, "output_element");

print_r ($results);

$os = array("Mac", "NT", "Irix", "Linux");
if (in_array("Irix", $os)) 
	
//using pdo with a class//
/* create instance automatically */
$sth->setFetchMode( PDO::FETCH_CLASS, 'user');
$sth->execute();
$user = $sth->fetch( PDO::FETCH_CLASS );
$sth->closeCursor();
print ($user->id);

/* or create an instance yourself and use it */
$user= new user();
$sth->setFetchMode( PDO::FETCH_INTO, $user);
$sth->execute();
$user= $sth->fetch( PDO::FETCH_INTO );
$sth->closeCursor();
print ($user->id);


class User
{
    //Predefine Here
    public $id;
    public $username;
    public $password;
    public $email;
    public $hash;

    public function profileLink()
    {
         return sprintf('<a href="/profile/%s">%s</a>',$this->id,$this->username);
    }
}

$result = $sth->fetchAll(PDO::FETCH_CLASS, "User");
foreach($result as $user)
{
    echo $user->profileLink();
}



switch (n) {
    case label1:
        code to be executed if n=label1;
        break;
    case label2:
        code to be executed if n=label2;
        break;
    case label3:
        code to be executed if n=label3;
        break;
    ...
    default:
        code to be executed if n is different from all labels;
}

unset ($_SESSION['varname']);. 
session_start();
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(),'',0,'/');
    session_regenerate_id(true);
	
// set the cookies
setcookie("cookie[three]", "cookiethree");
setcookie("cookie[two]", "cookietwo");
setcookie("cookie[one]", "cookieone");

// after the page reloads, print them out
if (isset($_COOKIE['cookie'])) {
    foreach ($_COOKIE['cookie'] as $name => $value) {
        $name = htmlspecialchars($name);
        $value = htmlspecialchars($value);
        echo "$name : $value <br />\n";
    }
}



down vote
You can set a cookie like this:

setcookie("cookiename", "value1;value2;value3;value4");
and then use explode like so:

$a = explode(';', $_COOKIE['cookiename']);

 setcookie("test", "PHP-Hypertext-Preprocessor", time()+60, "/location", 1);
 $array = explode("-", $_COOKIE['test']); //retrieve contents of cookie  
 print("PHP stands for " . $array[0] . $array[1] . $array[2]); //display the content
 
 $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
setcookie('cookiename', 'data', time()+60*60*24*365, '/', $domain, false);

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past


/* Redirect to a different page in the current directory that was requested */
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'mypage.php';
header("Location: http://$host$uri/$extra");
exit;

echo basename($path,".php");

rename("/tmp/tmp_file.txt", "/home/user/login/docs/my_file.txt");

mkdir("video/".$userId,0777);
chmod("video/".$userId,0777);

@-webkit-keyframes scaleDown {
  0% { transform: scale(10,10); opacity: 0; }
  100% { transform: scale(1,1); opacity: 1; }
}

@keyframes fadeInScale {
  0% { transform: scale(0.6); opacity: 0; }
  100% { transform: scale(1); opacity: 1; }
  
  .lightbox {
    /** Hide the lightbox */
    opacity: 0;
    /** Apply basic lightbox styling */
    position: fixed;
    z-index: 9999;
    width: 100%;
    height: 100%;
    top: -100%;
    left: 0;
    color:#333333;
    -webkit-transition: opacity .5s ease-in-out;
    -moz-transition: opacity .5s ease-in-out;
    -o-transition: opacity .5s ease-in-out;
    transition: opacity .5s ease-in-out;
    }
.lightbox:target {
    /** Show lightbox when it is target */
    opacity: 1;
    outline: none;
    top: 0;
}

// array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12)
foreach (range(0, 12) as $number) {
    echo $number;
}

// The step parameter
// array(0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100)
foreach (range(0, 100, 10) as $number) {
    echo $number;
}

// Usage of character sequences
// array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i');
foreach (range('a', 'i') as $letter) {
    echo $letter;
}

$prepend = array('00','01','02','03','04','05','06','07','08','09'); 
$hours     = array_merge($prepend,range(10, 23)); 
$minutes     = array_merge($prepend,range(10, 59)); 
$seconds     = $minutes; 



$a = array('green', 'red', 'yellow');
$b = array('avocado', 'apple', 'banana');
$c = array_combine($a, $b);

print_r($c);
Array
(
    [green]  => avocado
    [red]    => apple
    [yellow] => banana
)
// Read and write for owner, nothing for everybody else
chmod("/somedir/somefile", 0600);

// Read and write for owner, read for everybody else
chmod("/somedir/somefile", 0644);

// Everything for owner, read and execute for others
chmod("/somedir/somefile", 0755);

// Everything for owner, read and execute for owner's group
chmod("/somedir/somefile", 0750);

//converting time //
$to_time = strtotime("2008-12-13 10:42:00");
$from_time = strtotime("2008-12-13 10:21:00");
echo round(abs($to_time - $from_time) / 60,2). " minute";


$start_date = new DateTime('2007-09-01 04:10:58');
$since_start = $start_date->diff(new DateTime('2012-09-11 10:25:00'));
echo $since_start->days.' days total<br>';
echo $since_start->y.' years<br>';
echo $since_start->m.' months<br>';
echo $since_start->d.' days<br>';
echo $since_start->h.' hours<br>';
echo $since_start->i.' minutes<br>';
echo $since_start->s.' seconds<br>';

$dateFrom = new DateTime('2007-09-01 04:10:58'); // 
$dateTo = new DateTime('2012-09-11 10:25:00'); 
echo round(($dateTo->getTimestamp()-$dateFrom->getTimestamp())/60 // or ($dateTo->format("u") - $dateFrom->format("u"))/60

echo strtotime("now"), "\n";
echo strtotime("10 September 2000"), "\n";
echo strtotime("+1 day"), "\n";
echo strtotime("+1 week"), "\n";
echo strtotime("+1 week 2 days 4 hours 2 seconds"), "\n";
echo strtotime("next Thursday"), "\n";
echo strtotime("last Monday"), "\n";


function test()
{
    static $count = 0;

    $count++;
    echo $count;
    if ($count < 10) {
        test();
    }
    $count--;
}

$first_names = array_column($records, 'first_name');

return $this->query("SELECT FOUND_ROWS()")->fetchColumn();

// Get a specific user by a query
$sql = 'SELECT * FROM Users WHERE UserName = ?';
$stmt = $dbh->prepare($sql);
$stmt->execute(array('admin'));
$admin_user = $stmt->fetchObject('User');

$err = $dbh->prepare('SELECT skull FROM bones');
$err->execute();

echo "\nPDOStatement::errorCode(): ";
print $err->errorCode();

/* Provoke an error -- the BONES table does not exist */
$sth = $dbh->prepare('SELECT skull FROM bones');
$sth->execute();

echo "\nPDOStatement::errorInfo():\n";
$arr = $sth->errorInfo();
print_r($arr);
PDOStatement::errorInfo():
Array
(
    [0] => 42S02 // sql errr //
    [1] => -204 // driver specific error code //
    [2] => [IBM][CLI Driver][DB2/LINUX] SQL0204N  "DANIELS.BONES" is an undefined name.  SQLSTATE=42704
)


accepted
That's because that's an SQL function, not PHP. You can use PDO::lastInsertId().

Like:

$stmt = $db->prepare("...");
$stmt->execute();
$id = $db->lastInsertId();
?>