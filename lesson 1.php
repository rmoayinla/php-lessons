<?php
// this function must be used inside a class, to get the class name //
get_class($this);
class myclass {
	get_class(); 
}

// class instatiation //
$ade = new myclass(); // or new myclass //

// instance is assigned the value of assigned //
$assigned   =  $instance;

// a sample of reference, any change to instance will also affect reference //
$reference  = & $instance;


class sampleclass {
	
	// public, private or protected // 
	public $name ; 
	// name is a property //
	
	// name function is a method //
	// private means it can only be accessed in this class, not in a sub class //
	private function name () {
		
		
	}
	
	// this defines the object/class constructor, i.e how it will be constructed //
	//default values can be set here //
	
	public function __construct ($default_name = "User") {
		// set the name property during class instantiation //
		$this->name = $default_name;
		
	}
}
// end of class // 

// example of a parent and child class //
class realclass extends sampleclass {
	// this is the name version of the parent class //
	parent::name;
	
	//get classname //
	::class; 
	
	//using self and this //
	// self should be used on constants and static properties or methods  // 
	const name = "constant"; 
	static $stat = "static"; 
	public $variable = "public var"; 
	
	//to access the constant //
	self::name; 
	self::$stat;
	
	//getting classname - workaround //
	static $_classname = __CLASS__; 
	
	static function getclassname(){
		return self::$_classname; 
	}
	// this can be called without instantiation -i.e myclass::getclassname() //
	
	// access the constructor funcion of the parent//
	//note: this will only work if its not set to private //
	parent::__construct()
}

// checking if a particular object support a method //
$directory = new Directory('.');

// method_exists(object, method_name) //
var_dump(method_exists($directory,'read'));


//making a constructor private //
// this will prevent instantiating the class - creating an object directly //
class privateclass {
	static $instance; 
	
	private __construct(){
		
	}
	static public get_instance(){
		$c = (!isset(self::$instance)) ? __CLASS__ : return self::$instance; 
		self::$instance = new $c(); 
	}
	// a public method //
	public function sayHi (){
		echo "Say Hello";
	}
}
// to instantiate the private class //
$bar = privateclass::get_instance(); 
// same as $bar = new privateclass() ; since the constructor is private //

// a protected method or property can be accessed by a class and sub classess// 
// a private can only be accessed in the current class //
class sampleclass_2 {
	// this is available for this class and all subclass but not outside //
	protected $myname; 
	protected function get_my_name(){}
	
	// but a public method can display their info //
	public function showprotected () {
		echo $this->myname; 
	}
}


// using the abstract keyword //
// this makes sure a class/object can only be inheritable i.e extended by other classes but cannot be instatiated i.e called //
//example //
abstract class baseclass {
	// the difference between a static and constant - only in typo 
	static public $var = 1; 
	const myVar = 1; 
	
}

class subbaseclass extends baseclass {
	// to access parent static object //
	parent::$var; 
	
	// to access parent constant //
	parent::myVar; 
}
// in the example above, baseclass cannot be instantiated through new baseclass() //

//using abstract keyword //
//this make sure a class cannot be instatiated but can be inherited //
//abastract class provides methods and properties for  child classess //

abstract class AbstractClass
{
    // Our abstract method only needs to define the required arguments
    abstract protected function prefixName($name);

}
// this is a childclass of an abstract class //
class ConcreteClass extends AbstractClass
{

    // Our child class may define optional arguments not in the parent's signature
    public function prefixName($name, $separator = ".") {
        if ($name == "Pacman") {
            $prefix = "Mr";
        } elseif ($name == "Pacwoman") {
            $prefix = "Mrs";
        } else {
            $prefix = "";
        }
        return "{$prefix}{$separator} {$name}";
    }
}


//using traits //
//traits cannot be instatiated on their own //\
//you can easily store a code to be use in a class method in a trait //
//create a trait using the trait keyword //
//insert a trait using use keyword //
trait Hello {
    public function sayHello() {
        echo 'Hello ';
    }
}
//create a trait //
trait World {
    public function sayWorld() {
        echo 'World';
    }
}

class MyHelloWorld {
    //insert traits //
	//note, these trait methods just include methods here //
	use Hello, World;
    public function sayExclamationMark() {
        echo '!';
    }
}

// more on traits //
//incase two traits have the same methods, you can set which method of which trait to use //
//using the instead of keyword //
//create a trait //
trait A {
    public function smallTalk() {
        echo 'a';
    }
    public function bigTalk() {
        echo 'A';
    }
}
//another trait//
//both traits have the same methods i.e. names //
trait B {
    public function smallTalk() {
        echo 'b';
    }
    public function bigTalk() {
        echo 'B';
    }
}

class Talker {
	//insert the traits but  . . //
	//set which exact method to use from each trait //
    use A, B {
		//use the smalltalk method of trait b instead of a //
        B::smallTalk insteadof A;
		
        A::bigTalk insteadof B;
    }
}

class Aliased_Talker {
    use A, B {
        B::smallTalk insteadof A;
        A::bigTalk insteadof B;
        B::bigTalk as talk;
    }
}

//when a class extends another and extends another //
//for example //
public function call()
  {
    echo self::something(); // self
    echo parent::something(); // parent
    echo foo::something(); // grandparent or a class that is linked in someway //
  }
  
  
  
 //using class interfaces //
 //why? interface is used when you have a code you are likely going to reuse or remodify into a different format or version  //
 //with the interface, you can create the fundamental basic which will be separated from the main object or class which you will keep updating //
 //example //
 //create a code that can access a db in different languages //
 //my db class can be an interface //
 interface Database {
function listOrders();
function addOrder();
function removeOrder();
...
}
// with the interface above, all class implementing my db must have the listed methods //
// they will all list orders, add orders and remove orders regardless of the language I'm using // 
//so i can have a mysql class implementing this class //
class MySqlDatabase implements Database {
function listOrders() {...
}
function addOrder(){}
function removeOrder(){}
}
//so i can have another version, lets say in oracle implemeting my database class with another version but still contain this same methods //
//to create an interface, you have to decide the general function, what you want your code to really, so that will be in the methods //
//while the implementing classes will be having different versions of the basic functions you want //

// a class can extend another class and implement an interface at the sametime //
// for example i can have an interface class containing methods for a PDO access //
// then have implementing classess extending and implementing the interface //
// an implementing class to update, another to delete, another to insert //
// all having a general method of bindparam, execute, prepare and then fetch //


//still on interfaces //
//example of a typical interface //
// the base is transversible //
// this interface has no methods and cannot be instatiated //
 Traversable {
}
// then we have a class that extends the interface //
//adding abstract public functions //
//remember traversible is an interface //
 
 Iterator extends Traversable {
/* Methods */
abstract public mixed current ( void )
abstract public scalar key ( void )
abstract public void next ( void )
abstract public void rewind ( void )
abstract public boolean valid ( void )
}

// a sample class that implements iterator interface //
class tIterator_array implements Iterator {
  private $myArray;
  
  
  public function __construct( $givenArray ) {
    $this->myArray = $givenArray;
  }
  function rewind() {
    return reset($this->myArray);
  }
  function current() {
    return current($this->myArray);
  }
  function key() {
    return key($this->myArray);
  }
  function next() {
    return next($this->myArray);
  }
  //check if its valid //
  function valid() {
    return key($this->myArray) !== null;
  }
}
// NOTe: the above class has all the methods specified in the iterator interface //

// another class extends the iterator //
//note: the iterator class extends transversible //
 SeekableIterator extends Iterator {
/* Methods */
abstract public void seek ( int $position )
/* Inherited methods */
abstract public mixed Iterator::current ( void )
abstract public scalar Iterator::key ( void )
abstract public void Iterator::next ( void )
abstract public void Iterator::rewind ( void )
abstract public boolean Iterator::valid ( void )
}
// this seekable class only adds an additional abstract function //
//the inherited methods are from iterator class //

// a sample class implementing the seekable class //
class MySeekableIterator implements SeekableIterator {

    private $position;

    private $array = array(
        "first element",
        "second element",
        "third element",
        "fourth element"
    );

    /* Method required for SeekableIterator interface */
    // the main method added by seekable //
    public function seek($position) {
		// this function will accept a parameter when instatiated //
		// if the position is not set or does not exist //
      if (!isset($this->array[$position])) {
          throw new OutOfBoundsException("invalid seek position ($position)");
      }
	  //if it exist, set position variable to the seeking position //
// referring to the position variable //
      $this->position = $position;
    }

    /* Methods required for Iterator interface */
    
    public function rewind() {
		//sets the position to 0 //
        $this->position = 0;
    }

    public function current() {
		// display the array value of the current position //
		//i.e array[0]; //
        return $this->array[$this->position];
    }

    public function key() {
		//display the current position i.e 0//
        return $this->position;
    }

    public function next() {
		//increment the value of position  //
		//i.e. 0 before now 1 //
        ++$this->position;
    }
    // check if an array exist for this position //
	//example position is 5, check if array[5] exist //
    public function valid() {
        return isset($this->array[$this->position]);
    }
}


// another class extending the iterator class //
//note: each class here is adding additional methods, which in turn is functionality //

 RecursiveIterator extends Iterator {
/* Methods */
public RecursiveIterator getChildren ( void )
public bool hasChildren ( void )
/* Inherited methods */
abstract public mixed Iterator::current ( void )
abstract public scalar Iterator::key ( void )
abstract public void Iterator::next ( void )
abstract public void Iterator::rewind ( void )
abstract public boolean Iterator::valid ( void )
}

//a sample class implementing this interface //

class MyRecursiveIterator implements RecursiveIterator
{
    private $_data;
    private $_position = 0;
   
    public function __construct(array $data) {
        //set the variable above to the user set array from the parameter //
		$this->_data = $data;
    }
   
    public function valid() {
		// check if the current data value exist i.e. data[0] //
        return isset($this->_data[$this->_position]);
    }
   
    public function hasChildren() {
		//check if the current value is an array // 
        return is_array($this->_data[$this->_position]);
    }
   
    public function next() {
		//increment position value //
        $this->_position++;
    }
   
    public function current() {
		// display value of current position i.e. data[2]; 
        return $this->_data[$this->_position];
    }
   
    public function getChildren() {
		// you can do anything you like to the children //
		//you can extend this and loop over them //
        echo '<pre>';
        print_r($this->_data[$this->_position]);
        echo '</pre>';
    }
   
    public function rewind() {
		//set position back to 0 //
        $this->_position = 0;
    }
   
    public function key() {
		// display the current position //
        return $this->_position;
    }

}	
//another interface class //
//this class provides methods to access datas in an array //
 ArrayAccess {
/* Methods */
abstract public boolean offsetExists ( mixed $offset )
abstract public mixed offsetGet ( mixed $offset )
abstract public void offsetSet ( mixed $offset , mixed $value )
abstract public void offsetUnset ( mixed $offset )
}
// a sample class implementing this interface //
class obj implements ArrayAccess {
    
	private $container = array();

    public function __construct() {
		// during instatiation, the array sent to this class should be set to the container variable //
        $this->container = array(
            "one"   => 1,
            "two"   => 2,
            "three" => 3,
        );
    }

    public function offsetSet($offset, $value) {
		//if the offset value is not set //
        if (is_null($offset)) {
			//just add the value to the array //
            $this->container[] = $value;
        } else {
			//if the offset is set, add it to the position //
			//e.g. offeset is 1, container[1] = "value" //
			//it will overrride if it existed //
            $this->container[$offset] = $value;
        }
    }
   
    public function offsetExists($offset) {
		//check if the particular value exist in the array //
		//container[0]//
        return isset($this->container[$offset]);
    }

    public function offsetUnset($offset) {
		//delete the value in that position //
		//unset(container[0])//
        unset($this->container[$offset]);
    }

    public function offsetGet($offset) {
		//if the offest exist in my array i.e. container[2] exist//
		//return the value i.e container[2]// 
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }
}


// another class extends transversible //
//note: each class extending this interface is adding a method an an additional functionality //
 IteratorAggregate extends Traversable {
/* Methods */
abstract public Traversable getIterator ( void )
}
// a sample class implementing this interface //

class myData implements IteratorAggregate {
    public $property1 = "Public property one";
    public $property2 = "Public property two";
    public $property3 = "Public property three";
	// or better still //
	public $property = [];

    public function __construct($d) {
		//during instantiation, the param will create a new variable //
        $this->property4 = "last property";
		$this->property[] = $d;
    }

    public function getIterator() {
		//this method will turn all variables in this to an array, which i can further loop //
        return new ArrayIterator($this);
		return new ArrayIterator($this->property);
    }
}

// better programming //
//this class also implement iteratoraggregate //
class myData implements IteratorAggregate {

    private $array = [];
	// this two constants determine how this class handles the array //
    const TYPE_INDEXED = 1;
    const TYPE_ASSOCIATIVE = 2;

    public function __construct( array $data, $type = self::TYPE_INDEXED ) {
		//during instatiation //
		//the data must be an array //
		//the type specify if is associative or single //
        // rewind to the first value //
		reset($data);
		//so loop through the data received which is an array //
        foreach($data as $k=>$v){
			//if the type specified is single 
            $type == self::TYPE_INDEXED ?
			//pick thier values to the array i created in my class //
            $this->array[] = $v :
			//else, pick the key and value //
            $this->array[$k] = $v;
        }
    }

    public function getIterator() {
		// now create an array object from my array variable //
        return new ArrayIterator($this->array);
    }

}


//the iteratoriterator class //
//this class does nothing special, just convert an object or data to a transversible element which iterator can apply //
//this is the class //
 IteratorIterator implements OuterIterator {
/* Methods */
public __construct ( Traversable $iterator )
public mixed current ( void )
public Traversable getInnerIterator ( void )
public scalar key ( void )
public void next ( void )
public void rewind ( void )
public bool valid ( void )
}

//which surely can be extended or implemented //
//example of extending //
class TrimIterator extends IteratorIterator
{
    public function current() {
		//remember, the method here can be a new one or modify that of the parent //
		// so here we are triming every value of the current element being returned by this method//
        return trim(parent::current());
    }
}

//a sample iterator class with a default counter //
class Enumerator extends IteratorIterator
{   
    /**
    * Initial value for enumerator
    * @param int , the protected ensure it can be accessed publicly but can be use in a extending class
    */
    protected $start = 0;

    /**
    * @param int
    */
    protected $key = 0;

    /**
    * @param Traversable $iterator
    * @param scalar $start
    */
    public function __construct(Traversable $iterator, $start = 0)
    {
		// when instatating this class //
		//the iterator is the array //
		// the start specifies where the key to start from //
		//ex: if this class is instantiated with the second param 700 //
		//the key will start from 700 //
		
        parent::__construct($iterator);
        // so set the start variable to the int in the param value //
        $this->start = $start;
        // set the key variable to match the start //
        $this->key = $this->start;
    }

    public function key()
    {
        return $this->key;
    }

    public function next()
    {
		//during each next, increment the key variable //
        ++$this->key;
        // use the initial parent next method //
        parent::next();
    }

    public function rewind()
    { 
	 // set key back to the initial start value //
        $this->key = $this->start;

        parent::rewind();
    }

}


// a readymade php file object //
//note: this class can be extended //
 SplFileInfo {
/* Methods */
public __construct ( string $file_name )
public int getATime ( void )
public string getBasename ([ string $suffix ] )
public int getCTime ( void )
public string getExtension ( void )
public SplFileInfo getFileInfo ([ string $class_name ] )
public string getFilename ( void )
public int getGroup ( void )
public int getInode ( void )
public string getLinkTarget ( void )
public int getMTime ( void )
public int getOwner ( void )
public string getPath ( void )
public SplFileInfo getPathInfo ([ string $class_name ] )
public string getPathname ( void )
public int getPerms ( void )
public string getRealPath ( void )
public int getSize ( void )
public string getType ( void )
public bool isDir ( void )
public bool isExecutable ( void )
public bool isFile ( void )
public bool isLink ( void )
public bool isReadable ( void )
public bool isWritable ( void )
public SplFileObject openFile ([ string $open_mode = "r" [, bool $use_include_path = false [, resource $context = NULL ]]] )
public void setFileClass ([ string $class_name = "SplFileObject" ] )
public void setInfoClass ([ string $class_name = "SplFileInfo" ] )
public void __toString ( void )
}

//using references //
//in PHP if $x = 1, and $x = $y, $x and $y are not the same, x is a copy of y and vise versa //
//


//using constants in a php class //
abstract class dbObject
{    
    const TABLE_NAME='undefined';
    
    public static function GetAll()
    {
        $c = get_called_class();
        return "SELECT * FROM `".$c::TABLE_NAME."`";
    }    
}

class dbPerson extends dbObject
{
    const TABLE_NAME='persons';
}

class dbAdmin extends dbPerson
{
    const TABLE_NAME='admins';
}
//constants can e overriden in extending classess //


//setting exception handler for your class //
Class SafePDO extends PDO {

        public static function exception_handler($exception) {
            // Output the exception details
            die('Uncaught exception: ', $exception->getMessage());
        }

        public function __construct($dsn, $username='', $password='', $driver_options=array()) {

            // Temporarily change the PHP exception handler while we . . .
            set_exception_handler(array(__CLASS__, 'exception_handler'));

            // . . . create a PDO object
            parent::__construct($dsn, $username, $password, $driver_options);

            // Change the exception handler back to whatever it was before
            restore_exception_handler();
        }

}


format character 	Description 	Example returned values
Day 	--- 	---
d 	Day of the month, 2 digits with leading zeros 	01 to 31
D 	A textual representation of a day, three letters 	Mon through Sun
j 	Day of the month without leading zeros 	1 to 31
l (lowercase 'L') 	A full textual representation of the day of the week 	Sunday through Saturday
N 	ISO-8601 numeric representation of the day of the week (added in PHP 5.1.0) 	1 (for Monday) through 7 (for Sunday)
S 	English ordinal suffix for the day of the month, 2 characters 	st, nd, rd or th. Works well with j
w 	Numeric representation of the day of the week 	0 (for Sunday) through 6 (for Saturday)
z 	The day of the year (starting from 0) 	0 through 365
Week 	--- 	---
W 	ISO-8601 week number of year, weeks starting on Monday (added in PHP 4.1.0) 	Example: 42 (the 42nd week in the year)
Month 	--- 	---
F 	A full textual representation of a month, such as January or March 	January through December
m 	Numeric representation of a month, with leading zeros 	01 through 12
M 	A short textual representation of a month, three letters 	Jan through Dec
n 	Numeric representation of a month, without leading zeros 	1 through 12
t 	Number of days in the given month 	28 through 31
Year 	--- 	---
L 	Whether it's a leap year 	1 if it is a leap year, 0 otherwise.
o 	ISO-8601 year number. This has the same value as Y, except that if the ISO week number (W) belongs to the previous or next year, that year is used instead. (added in PHP 5.1.0) 	Examples: 1999 or 2003
Y 	A full numeric representation of a year, 4 digits 	Examples: 1999 or 2003
y 	A two digit representation of a year 	Examples: 99 or 03
Time 	--- 	---
a 	Lowercase Ante meridiem and Post meridiem 	am or pm
A 	Uppercase Ante meridiem and Post meridiem 	AM or PM
B 	Swatch Internet time 	000 through 999
g 	12-hour format of an hour without leading zeros 	1 through 12
G 	24-hour format of an hour without leading zeros 	0 through 23
h 	12-hour format of an hour with leading zeros 	01 through 12
H 	24-hour format of an hour with leading zeros 	00 through 23
i 	Minutes with leading zeros 	00 to 59
s 	Seconds, with leading zeros 	00 through 59
u 	Microseconds (added in PHP 5.2.2). Note that date() will always generate 000000 since it takes an integer parameter, whereas DateTime::format() does support microseconds if DateTime was created with microseconds. 	Example: 654321
Timezone 	--- 	---
e 	Timezone identifier (added in PHP 5.1.0) 	Examples: UTC, GMT, Atlantic/Azores
I (capital i) 	Whether or not the date is in daylight saving time 	1 if Daylight Saving Time, 0 otherwise.
O 	Difference to Greenwich time (GMT) in hours 	Example: +0200
P 	Difference to Greenwich time (GMT) with colon between hours and minutes (added in PHP 5.1.3) 	Example: +02:00
T 	Timezone abbreviation 	Examples: EST, MDT ...
Z 	Timezone offset in seconds. The offset for timezones west of UTC is always negative, and for those east of UTC is always positive. 	-43200 through 50400
Full Date/Time 	--- 	---
c 	ISO 8601 date (added in PHP 5) 	2004-02-12T15:19:21+00:00
r 	» RFC 2822 formatted date 	Example: Thu, 21 Dec 2000 16:01:07 +0200
U 	Seconds since the Unix Epoch (January 1 1970 00:00:00 GMT) 	See also time()
--- '
// Prints something like: Monday 8th of August 2005 03:12:46 PM
echo date('l jS \of F Y h:i:s A');

// set the default timezone to use. Available since PHP 5.1
date_default_timezone_set('UTC');

// Prints: July 1, 2000 is on a Saturday
echo "July 1, 2000 is on a " . date("l", mktime(0, 0, 0, 7, 1, 2000));

$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
$lastmonth = mktime(0, 0, 0, date("m")-1, date("d"),   date("Y"));
$nextyear  = mktime(0, 0, 0, date("m"),   date("d"),   date("Y")+1);
?>

//connnection strings for pdo //
$cnx = new PDO("odbc:Driver={SQL Native Client};Server=250.156.0.1;Database=myDataBase; Uid=userName;Pwd=thePassword;"); 

//for connection strings //
http://www.connectionstrings.com/sql-server-native-client-10-0-odbc-driver/

/* Provoke an error -- the BONES table does not exist */
$sth = $dbh->prepare('SELECT skull FROM bones');
$sth->execute();

echo "\nPDOStatement::errorInfo():\n";
$arr = $sth->errorInfo();
print_r($arr);

PDOStatement::errorInfo():
Array
(
    [0] => 42S02
    [1] => -204
    [2] => [IBM][CLI Driver][DB2/LINUX] SQL0204N  "DANIELS.BONES" is an undefined name.  SQLSTATE=42704
)


//preg replace//

<?php
$html = $_POST['html'];

// uppercase headings
$html = preg_replace_callback(
    '(<h([1-6])>(.*?)</h\1>)',
    function ($m) {
        return "<h$m[1]>" . strtoupper($m[2]) . "</h$m[1]>";
    },
    $html
);

$string = 'April 15, 2003';
$pattern = '/(\w+) (\d+), (\d+)/i';
$replacement = '${1}1,$3';
echo preg_replace($pattern, $replacement, $string); // result April1,2003 //

// the callback function
function next_year($matches)
{
  // as usual: $matches[0] is the complete match
  // $matches[1] the match for the first subpattern
  // enclosed in '(...)' and so on
  return $matches[1].($matches[2]+1);
}
echo preg_replace_callback(
            "|(\d{2}/\d{2}/)(\d{4})|",
            "next_year",
            $text);
echo preg_replace_callback(
'|(?:\.)(?:\s*)(\w{1})|Ui',
create_function('$matches', 'return ". ".strtoupper($matches[1]);'), ucfirst($string)
); 


function replaceAnchorsWithText($data) {
    /**
     * Had to modify $regex so it could post to the site... so I broke it into 6 parts.
     */
    $regex  = '/(<a\s*'; // Start of anchor tag
    $regex .= '(.*?)\s*'; // Any attributes or spaces that may or may not exist
    $regex .= 'href=[\'"]+?\s*(?P<link>\S+)\s*[\'"]+?'; // Grab the link
    $regex .= '\s*(.*?)\s*>\s*'; // Any attributes or spaces that may or may not exist before closing tag
    $regex .= '(?P<name>\S+)'; // Grab the name
    $regex .= '\s*<\/a>)/i'; // Any number of spaces between the closing anchor tag (case insensitive)
   
    if (is_array($data)) {
        // This is what will replace the link (modify to you liking)
        $data = "{$data['name']}({$data['link']})";
    }
    return preg_replace_callback($regex, 'replaceAnchorsWithText', $data);
}

(?:\.\s?)(\w)+ or (?:\.([\s\n]?))(\w)+ // check for . follow by a space and a character 

$dice = new \Dice\Dice;

$a = $dice->create('A');

print_r($a);

// autoload classes based on a 1:1 mapping from namespace to directory structure.
spl_autoload_register(function ($className) {

    # Usually I would just concatenate directly to $file variable below
    # this is just for easy viewing on Stack Overflow)
        $ds = DIRECTORY_SEPARATOR;
        $dir = __DIR__;

    // replace namespace separator with directory separator (prolly not required)
        $className = str_replace('\\', $ds, $className);

    // get full name of file containing the required class
        $file = "{$dir}{$ds}{$classname}.php";

    // get file if it is readable
        if (is_readable($file)) require_once $file;
});
namespace application\controllers;
class Base {...}
application/
controllers/
Base.php
Factory.php
models/
Page.php
Parent.php


// Your custom class dir
    define('CLASS_DIR', 'class/')

    // Add your class dir to include path
    set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);

    // You can use this trick to make autoloader look for commonly used "My.class.php" type filenames
    spl_autoload_extensions('.class.php');

    // Use default autoload implementation
    spl_autoload_register // or spl_autoload_register(function($class) { return spl_autoload(str_replace('_', '/', $class));});

	class User {
    protected $table = 'users';

    public function getAll() {
        return DB::getAll($this->table);
    }

    public function get($id) {
        return DB::get($this->table, $id);
    }

    public function add($data) {
        return DB::add($this->table, $data);
    }

    public function update($id) {
        return DB::update($this->table, $id);
    }

    public function remove($id) {
        return DB::remove($this->table, $id);
    }
}

class Message {
    protected $table = 'messages';

    public function getAll() {
        return DB::getAll($this->table);
    }

    public function get($id) {
        return DB::get($this->table, $id);
    }

    public function add($data) {
        return DB::add($this->table, $data);
    }

    public function update($id) {
        return DB::update($this->table, $id);
    }

    public function remove($id) {
        return DB::remove($this->table, $id);
    }
}
abstract class Model {     
    public function getAll() {
        return DB::getAll($this->table);
    }

    public function get($id) {
        return DB::get($this->table, $id);
    }

    public function add($data) {
        return DB::add($this->table, $data);
    }

    public function update($id) {
        return DB::update($this->table, $id);
    }

    public function remove($id) {
        return DB::remove($this->table, $id);
    }
}
class User extends Model {
    protected $table = 'users';
}

class Message extends Model {
    protected $table = 'messages';
}

trait Encoder {
    public static function encrypt($text, $key) {
        // code to encrypt text
    }

    public static function decrypt($text, $key) {
        // code to decrypt text
    } 
}
class User extends Model {
    use Encoder;
    protected $table = 'users';
}

class Message extends Model {
    use Encoder;
    protected $table = 'messages';
}

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function actionListAllUsers()
    {          
       // fetch all users from database
        $users = $this->user->findAll();

       // show them on screen
        print_r($users);          
    }
}

class User
{
    private $database = null;

    public function __construct(Mysql $database)
    {
        $this->database = $database;
    }

    public function getUsers()
    {
        $users = $this->database->query('SELECT * FROM users ORDER BY id DESC');
        print_r($users);
    }
}

$database = new Mysql();
$database->connect('mysql:host=localhost;dbname=test', 'root', '');
$user = new User($database);
$user->getUsers();

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function actionListAllUsers()
    {          
       // fetch all users from database
        $users = $this->user->findAll();

       // show them on screen
        print_r($users);          
    }
}

class Test extends PHPUnit_Framework_TestCase {
 
    function testItCanReadAPDFBook() {
        $b = new PDFBook();
        $r = new EBookReader($b);
 
        $this->assertRegExp('/pdf book/', $r->read());
    }
 
}
 
interface EBook {
    function read();
}
 
class EBookReader {
 
    private $book;
 
    function __construct(EBook $book) {
        $this->book = $book;
    }
 s
    function read() {
        return $this->book->read();
    }
 
}
 
class PDFBook implements EBook{
 
    function read() {
        return "reading a pdf book.";
    }
}

private function getData( $dataToGet = '' , $useCache = true )
{
   //am I allowed to use cache?
   if ( $useCache === true )
   { 
       //does the appropriate data exist in cache?
       if ( isset($this->userCache[ $dataToGet ]) )
       {
           return $this->userCache[ $dataToGet ];//return the cached data, and forget about the DB queries
       }

   }

   //if we get here, caching was disabled or the required data has not yet been cached :(
   //all of my db querying would happen here

   //store the data that's just been fetched by the queries in the cache property

}

