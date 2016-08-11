<?php
namespace MyProject\Sub\Level;

const CONNECT_OK = 1;
class Connection { /* ... */ }
function connect() { /* ... */  }


namespace MyProject {

const CONNECT_OK = 1;
class Connection { /* ... */ }
function connect() { /* ... */  }
}

namespace AnotherProject {

const CONNECT_OK = 1;
class Connection { /* ... */ }
function connect() { /* ... */  }
}


namespace MyProject {

const CONNECT_OK = 1;
class Connection { /* ... */ }
function connect() { /* ... */  }
}

namespace { // global code
session_start();
$a = MyProject\connect();
echo MyProject\Connection::start();
}

//Namespace can be used in this way also
namespace MyProject {

function connect() { echo "ONE";  }
    Sub\Level\connect();
}

namespace MyProject\Sub {
    
function connect() { echo "TWO";  }
    Level\connect();
}

namespace MyProject\Sub\Level {
    
    function connect() { echo "THREE";  }    
    \MyProject\Sub\Level\connect(); // OR we can use this as below
    connect();
}

/*
Unqualified name, or an unprefixed class name like $a = new foo(); or foo::staticmethod();. 
If the current namespace is currentnamespace, this resolves to currentnamespace\foo. 
If the code is global, non-namespaced code, this resolves to foo. 
One caveat: unqualified names for functions and constants will resolve to global functions and constants 
if the namespaced function or constant is not defined. See Using namespaces: fallback to global function/constant for details.
Qualified name, or a prefixed class name like $a = new subnamespace\foo(); or subnamespace\foo::staticmethod();.
 If the current namespace is currentnamespace, this resolves to currentnamespace\subnamespace\foo. 
 If the code is global, non-namespaced code, this resolves to subnamespace\foo.
Fully qualified name, or a prefixed name with global prefix operator like $a = new \currentnamespace\foo(); 
or \currentnamespace\foo::staticmethod();. This always resolves to the literal name specified in the code, currentnamespace\foo.
*/

namespace com\rsumilang\common; 

class Object{ 
   // ... code ... 
} 

?> 

And now lets create a class called String that extends object in String.php: 

<?php 

class String extends com\rsumilang\common\Object{ 
   // ... code ... 
} 

?> 

Now if you class String was defined in the same namespace as Object then you don't have to specify a full namespace path: 

<?php 

namespace com\rsumilang\common; 

class String extends Object 
{ 
   // ... code ... 
} 


namespace MyProject;

function get($classname)
{
    $a = __NAMESPACE__ . '\\' . $classname;
    return new $a;
}

namespace MyProject;

use blah\blah as mine; // see "Using namespaces: Aliasing/Importing"

blah\mine(); // calls function MyProject\blah\mine()
namespace\blah\mine(); // calls function MyProject\blah\mine()

namespace\func(); // calls function MyProject\func()
namespace\sub\func(); // calls function MyProject\sub\func()
namespace\cname::method(); // calls static method "method" of class MyProject\cname
$a = new namespace\sub\cname(); // instantiates object of class MyProject\sub\cname
$b = namespace\CONSTANT; // assigns value of constant MyProject\CONSTANT to $b


namespace foo;
use My\Full\Classname as Another;

// this is the same as use My\Full\NSname as NSname
use My\Full\NSname;

// importing a global class
use ArrayObject;

// importing a function (PHP 5.6+)
use function My\Full\functionName;

// aliasing a function (PHP 5.6+)
use function My\Full\functionName as func;

// importing a constant (PHP 5.6+)
use const My\Full\CONSTANT;

$obj = new namespace\Another; // instantiates object of class foo\Another
$obj = new Another; // instantiates object of class My\Full\Classname
NSname\subns\func(); // calls function My\Full\NSname\subns\func
$a = new ArrayObject(array(1)); // instantiates object of class ArrayObject
// without the "use ArrayObject" we would instantiate an object of class foo\ArrayObject
func(); // calls function My\Full\functionName
echo CONSTANT; // echoes the value of My\Full\CONSTANT

use My\Full\Classname as Another, My\Full\NSname;

$obj = new Another; // instantiates object of class My\Full\Classname
$a = 'Another';
$obj = new $a;      // instantiates object of class Another


use My\Full\Classname as Another, My\Full\NSname;

$obj = new Another; // instantiates object of class My\Full\Classname
$obj = new \Another; // instantiates object of class Another
$obj = new Another\thing; // instantiates object of class My\Full\Classname\thing
$obj = new \Another\thing; // instantiates object of class Another\thing

A\B::foo();   // calls method "foo" of class "B" from namespace "A\A"
              // if class "A\A\B" not found, it tries to autoload class "A\A\B"

\A\B::foo();  // calls method "foo" of class "B" from namespace "A"
              // if class "A\B" not found, it tries to autoload class "A\B"


function helloWorld($ArgA, $ArgB="HelloWorld!") { 
  return func_num_args(); 
} 




__autoload — Attempt to load undefined class
call_user_method_array — Call a user method given with an array of parameters
call_user_method — Call a user method on an specific object
class_alias — Creates an alias for a class
class_exists — Checks if the class has been defined
get_called_class — the "Late Static Binding" class name
get_class_methods — Gets the class methods names
get_class_vars — Get the default properties of the class
get_class — Returns the name of the class of an object
get_declared_classes — Returns an array with the name of the defined classes
get_declared_interfaces — Returns an array of all declared interfaces
get_declared_traits — Returns an array of all declared traits
get_object_vars — Gets the properties of the given object
get_parent_class — Retrieves the parent class name for object or class
interface_exists — Checks if the interface has been defined
is_a — Checks if the object is of this class or has this class as one of its parents
is_subclass_of — Checks if the object has this class as one of its parents or implements it.
method_exists — Checks if the class method exists
property_exists — Checks if the object or class has a property
trait_exists — Checks if the trait exists			


var_dump($obj4 instanceof Child);


print_r(filter_list());
echo "</pre>";
foreach (filter_list() as $key => $value)
{
echo "<br>".$key."=".$value.'='.filter_id($value);
}


// callback validate filter
function foo($value)
{
    // Expected format: Surname, GivenNames
    if (strpos($value, ", ") === false) return false;
    list($surname, $givennames) = explode(", ", $value, 2);
    $empty = (empty($surname) || empty($givennames));
    $notstrings = (!is_string($surname) || !is_string($givennames));
    if ($empty || $notstrings) {
        return false;
    } else {
        return $value;
    }
}
$var = filter_var('Doe, Jane Sue', FILTER_CALLBACK, array('options' => 'foo'));

function checkEmailAndDomain($_email)
{
    $exp = "/^(.*)@(.*)$/";
    preg_match($exp, $_email, $matches);

    if (!empty($matches[1]) and (!filter_var($_email, FILTER_VALIDATE_EMAIL)))
        return (false);

    return (checkdnsrr(idn_to_ascii($matches[2]), 'MX'));
}

var_dump(filter_var('bob@example.com', FILTER_VALIDATE_EMAIL));
var_dump(filter_var('http://example.com', FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED));

function toDash($x){
   return str_replace("_","-",$x);
} 

echo filter_var("asdf_123",FILTER_CALLBACK,array("options"=>"toDash"));
// returns 'asdf-123'


>>> end
FILTER_VALIDATE_BOOLEAN	"boolean"	default	FILTER_NULL_ON_FAILURE	
Returns TRUE for "1", "true", "on" and "yes". Returns FALSE otherwise.

If FILTER_NULL_ON_FAILURE is set, FALSE is returned only for "0", "false", "off", "no", and "", and NULL is returned for all non-boolean values.

FILTER_VALIDATE_EMAIL	"validate_email"	default	 	
Validates whether the value is a valid e-mail address.

In general, this validates e-mail addresses against the syntax in RFC 822, with the exceptions that comments and whitespace folding are not supported.

FILTER_VALIDATE_FLOAT	"float"	default, decimal	FILTER_FLAG_ALLOW_THOUSAND	Validates value as float, and converts to float on success.
FILTER_VALIDATE_INT	"int"	default, min_range, max_range	FILTER_FLAG_ALLOW_OCTAL, FILTER_FLAG_ALLOW_HEX	Validates value as integer, 
                           optionally from the specified range, and converts to int on success.
FILTER_VALIDATE_IP	"validate_ip"	default	FILTER_FLAG_IPV4, FILTER_FLAG_IPV6, FILTER_FLAG_NO_PRIV_RANGE, FILTER_FLAG_NO_RES_RANGE	
Validates value as IP address, optionally only IPv4 or IPv6 or not from private or reserved ranges.
FILTER_VALIDATE_MAC	"validate_mac_address"	default	 	Validates value as MAC address.
FILTER_VALIDATE_REGEXP	"validate_regexp"	default, regexp	 	Validates value against regexp, a Perl-compatible regular expression.
FILTER_VALIDATE_URL	"validate_url"	default	FILTER_FLAG_PATH_REQUIRED, FILTER_FLAG_QUERY_REQUIRED	
Validates value as URL (according to » http://www.faqs.org/rfcs/rfc2396), optionally with required components.
 Beware a valid URL may not specify the HTTP protocol http:// so further validation may be required 
 to determine the URL uses an expected protocol, e.g. ssh:// or mailto:. 
 Note that the function will only find ASCII URLs to be valid; 
 internationalized domain names (containing non-ASCII characters) will fail.
end;


>>> eot 
FILTER_SANITIZE_EMAIL	"email"	 	Remove all characters except letters, digits and !#$%&'*+-=?^_`{|}~@.[].
FILTER_SANITIZE_ENCODED	"encoded"	FILTER_FLAG_STRIP_LOW, FILTER_FLAG_STRIP_HIGH, FILTER_FLAG_ENCODE_LOW, FILTER_FLAG_ENCODE_HIGH	
URL-encode string, optionally strip or encode special characters.
FILTER_SANITIZE_MAGIC_QUOTES	"magic_quotes"	 	Apply addslashes().
FILTER_SANITIZE_NUMBER_FLOAT	"number_float"	FILTER_FLAG_ALLOW_FRACTION, FILTER_FLAG_ALLOW_THOUSAND, FILTER_FLAG_ALLOW_SCIENTIFIC	
Remove all characters except digits, +- and optionally .,eE.
FILTER_SANITIZE_NUMBER_INT	"number_int"	 	Remove all characters except digits, plus and minus sign.
FILTER_SANITIZE_SPECIAL_CHARS	"special_chars"	FILTER_FLAG_STRIP_LOW, FILTER_FLAG_STRIP_HIGH, FILTER_FLAG_ENCODE_HIGH	
HTML-escape '"<>& and characters with ASCII value less than 32, optionally strip or encode other special characters.
FILTER_SANITIZE_FULL_SPECIAL_CHARS	"full_special_chars"	FILTER_FLAG_NO_ENCODE_QUOTES,	
Equivalent to calling htmlspecialchars() with ENT_QUOTES set. 
Encoding quotes can be disabled by setting FILTER_FLAG_NO_ENCODE_QUOTES. 
Like htmlspecialchars(), this filter is aware of the default_charset and if a sequence of bytes is detected 
that makes up an invalid character in the current character set then the entire string is rejected 
resulting in a 0-length string. When using this filter as a default filter, see the warning below 
about setting the default flags to 0.
FILTER_SANITIZE_STRING	"string"	
FILTER_FLAG_NO_ENCODE_QUOTES, FILTER_FLAG_STRIP_LOW, FILTER_FLAG_STRIP_HIGH, FILTER_FLAG_ENCODE_LOW, FILTER_FLAG_ENCODE_HIGH, FILTER_FLAG_ENCODE_AMP	
Strip tags, optionally strip or encode special characters.
FILTER_SANITIZE_STRIPPED	"stripped"	 	Alias of "string" filter.
FILTER_SANITIZE_URL	"url"	 	Remove all characters except letters, digits and $-_.+!*'(),{}|\\^~[]`<>#%";/?:@&=.
FILTER_UNSAFE_RAW	"unsafe_raw"	
FILTER_FLAG_STRIP_LOW, FILTER_FLAG_STRIP_HIGH, FILTER_FLAG_ENCODE_LOW, FILTER_FLAG_ENCODE_HIGH, FILTER_FLAG_ENCODE_AMP	
Do nothing, optionally strip or encode special characters. This filter is also aliased to FILTER_DEFAULT. 


FILTER_FLAG_STRIP_LOW	FILTER_SANITIZE_ENCODED, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_SANITIZE_STRING, FILTER_UNSAFE_RAW	
Strips characters that have a numerical value <32.
FILTER_FLAG_STRIP_HIGH	FILTER_SANITIZE_ENCODED, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_SANITIZE_STRING, FILTER_UNSAFE_RAW	
Strips characters that have a numerical value >127.
FILTER_FLAG_ALLOW_FRACTION	FILTER_SANITIZE_NUMBER_FLOAT	Allows a period (.) as a fractional separator in numbers.
FILTER_FLAG_ALLOW_THOUSAND	FILTER_SANITIZE_NUMBER_FLOAT, FILTER_VALIDATE_FLOAT	Allows a comma (,) as a thousands separator in numbers.
FILTER_FLAG_ALLOW_SCIENTIFIC	FILTER_SANITIZE_NUMBER_FLOAT	Allows an e or E for scientific notation in numbers.
FILTER_FLAG_NO_ENCODE_QUOTES	FILTER_SANITIZE_STRING	If this flag is present, single (') and double (") quotes will not be encoded.
FILTER_FLAG_ENCODE_LOW	FILTER_SANITIZE_ENCODED, FILTER_SANITIZE_STRING, FILTER_SANITIZE_RAW	Encodes all characters with a numerical value <32.
FILTER_FLAG_ENCODE_HIGH	FILTER_SANITIZE_ENCODED, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_SANITIZE_STRING, FILTER_SANITIZE_RAW	
Encodes all characters with a numerical value >127.
FILTER_FLAG_ENCODE_AMP	FILTER_SANITIZE_STRING, FILTER_SANITIZE_RAW	Encodes ampersands (&).
FILTER_NULL_ON_FAILURE	FILTER_VALIDATE_BOOLEAN	Returns NULL for unrecognized boolean values.
FILTER_FLAG_ALLOW_OCTAL	FILTER_VALIDATE_INT	Regards inputs starting with a zero (0) as octal numbers. This only allows the succeeding digits to be 0-7.
FILTER_FLAG_ALLOW_HEX	FILTER_VALIDATE_INT	Regards inputs starting with 0x or 0X as hexadecimal numbers. This only allows succeeding characters to be a-fA-F0-9.
FILTER_FLAG_IPV4	FILTER_VALIDATE_IP	Allows the IP address to be in IPv4 format.
FILTER_FLAG_IPV6	FILTER_VALIDATE_IP	Allows the IP address to be in IPv6 format.
FILTER_FLAG_NO_PRIV_RANGE	FILTER_VALIDATE_IP	
Fails validation for the following private IPv4 ranges: 10.0.0.0/8, 172.16.0.0/12 and 192.168.0.0/16.

Fails validation for the IPv6 addresses starting with FD or FC.

FILTER_FLAG_NO_RES_RANGE	FILTER_VALIDATE_IP	
Fails validation for the following reserved IPv4 ranges: 0.0.0.0/8, 169.254.0.0/16, 192.0.2.0/24 and 224.0.0.0/4. 
This flag does not apply to IPv6 addresses.
FILTER_FLAG_PATH_REQUIRED	FILTER_VALIDATE_URL	Requires the URL to contain a path part.
FILTER_FLAG_QUERY_REQUIRED	FILTER_VALIDATE_URL	Requires the URL to contain a query string.
FILTER_REQUIRE_SCALAR		Requires the value to be scalar.
FILTER_REQUIRE_ARRAY		Requires the value to be an array.
FILTER_FORCE_ARRAY		If the value is a scalar, it is treated as array with the scalar value as only element.

$data = array( 
                '<b>bold</b>', 
                '<script>javascript</script>', 
                'P*}i@893746%%%p*.i.*}}|.dw<?php echo "echo works!!";?>'); 

$myinputs = filter_var_array($data,FILTER_SANITIZE_STRING); 

var_dump($myinputs); 
$search_html = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_SPECIAL_CHARS);
$search_url = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_ENCODED);
echo "You have searched for $search_html.\n";
echo "<a href='?search=$search_url'>Search again.</a>";

var_dump(filter_input(INPUT_POST, 'var', FILTER_DEFAULT , FILTER_REQUIRE_ARRAY));

$myValidator = new myValidator;
$options = array('options' => array($myValidator, 'username'));
$username = filter_input(INPUT_GET, 'username', FILTER_CALLBACK, $options);
var_dump($username);
'

/* Execute a prepared statement using an array of values for an IN clause */
$params = array(1, 21, 63, 171);
/* Create a string for the parameter placeholders filled to the number of params */
$place_holders = implode(',', array_fill(0, count($params), '?'));

/*
    This prepares the statement with enough unnamed placeholders for every value
    in our $params array. The values of the $params array are then bound to the
    placeholders in the prepared statement when the statement is executed.
    This is not the same thing as using PDOStatement::bindParam() since this
    requires a reference to the variable. PDOStatement::execute() only binds
    by value instead.
*/
$sth = $dbh->prepare("SELECT id, name FROM contacts WHERE id IN ($place_holders)");
$sth->execute($params);

function logEvent($message) {
    if ($message != '') {
        // Add a timestamp to the start of the $message
        $message = date("Y/m/d H:i:s").': '.$message;
        $fp = fopen('/path/to/log.txt', 'a');
        fwrite($fp, $message."\n");
        fclose($fp);
    }
}

$file = 'people.txt';
// The new person to add to the file
$person = "John Smith\n";
// Write the contents to the file, 
// using the FILE_APPEND flag to append the content to the end of the file
// and the LOCK_EX flag to prevent anyone else writing to the file at the same time
file_put_contents($file, $person, FILE_APPEND | LOCK_EX);


$filename = 'test.txt';
$somecontent = "Add this to the file\n";

// Let's make sure the file exists and is writable first.
if (is_writable($filename)) {

    // In our example we're opening $filename in append mode.
    // The file pointer is at the bottom of the file hence
    // that's where $somecontent will go when we fwrite() it.
    if (!$handle = fopen($filename, 'a')) {
         echo "Cannot open file ($filename)";
         exit;
    }

    // Write $somecontent to our opened file.
    if (fwrite($handle, $somecontent) === FALSE) {
        echo "Cannot write to file ($filename)";
        exit;
    }

    echo "Success, wrote ($somecontent) to file ($filename)";

    fclose($handle);

} else {
    echo "The file $filename is not writable";
}

$handle = fopen("/home/rasmus/file.gif", "wb");


class ExceptionHandler {   
    public static function printException(Exception $e)
    {
        print 'Uncaught '.get_class($e).', code: ' . $e->getCode() . "<br />Message: " . htmlentities($e->getMessage())."\n";
    }
   
    public static function handleException(Exception $e)
    {
         self::printException($e);
    }
}

set_exception_handler(array("ExceptionHandler", "handleException"));

class NewException extends Exception {}
try {
  throw new NewException("Catch me once", 1);
} catch (Exception $e) {
  ExceptionHandler::handleException($e);
}

throw new Exception("Catch me twice", 2);

function exception_handler($exception) {
  echo '<div class="alert alert-danger">';
  echo '<b>Fatal error</b>:  Uncaught exception \'' . get_class($exception) . '\' with message ';
  echo $exception->getMessage() . '<br>';
  echo 'Stack trace:<pre>' . $exception->getTraceAsString() . '</pre>';
  echo 'thrown in <b>' . $exception->getFile() . '</b> on line <b>' . $exception->getLine() . '</b><br>';
  echo '</div>';
}

set_exception_handler('exception_handler');

class CustomException extends Exception{

    protected $title;

    public function __construct($title, $message, $code = 0, Exception $previous = null) {

        $this->title = $title;

        parent::__construct($message, $code, $previous);

    }

    public function getTitle(){
        return $this->title;
    }

}
try{
    throw new CustomException("My Title", "My error message");
}catch(CustomException $e){
    print $e->getTitle()."<br />".$e->getMessage();
}


/*
Since I feel this is rather vague and non-helpful, I thought I'd make a post detailing the mechanics of the glob regex. 

glob uses two special symbols that act like sort of a blend between a meta-character and a quantifier.  These two characters are the * and ? 

The ? matches 1 of any character except a / 
The * matches 0 or more of any character except a / 

If it helps, think of the * as the pcre equivalent of .* and ? as the pcre equivalent of the dot (.) 

Note: * and ? function independently from the previous character. For instance, if you do glob("a*.php") on the following list of files, all of the files starting with an 'a' will be returned, but * itself would match: 

a.php // * matches nothing 
aa.php // * matches the second 'a' 
ab.php // * matches 'b' 
abc.php // * matches 'bc' 
b.php // * matches nothing, because the starting 'a' fails 
bc.php // * matches nothing, because the starting 'a' fails 
bcd.php // * matches nothing, because the starting 'a' fails 

It does not match just a.php and aa.php as a 'normal' regex would, because it matches 0 or more of any character, not the character/class/group before it. 

Executing glob("a?.php") on the same list of files will only return aa.php and ab.php because as mentioned, the ? is the equivalent of pcre's dot, and is NOT the same as pcre's ?, which would match 0 or 1 of the previous character. 

glob's regex also supports character classes and negative character classes, using the syntax [] and [^]. It will match any one character inside [] or match any one character that is not in [^]. 

With the same list above, executing 

glob("[ab]*.php) will return (all of them): 
a.php  // [ab] matches 'a', * matches nothing 
aa.php // [ab] matches 'a', * matches 2nd 'a' 
ab.php // [ab] matches 'a', * matches 'b' 
abc.php // [ab] matches 'a', * matches 'bc' 
b.php // [ab] matches 'b', * matches nothing 
bc.php // [ab] matches 'b', * matches 'c' 
bcd.php // [ab] matches 'b', * matches 'cd' 

glob("[ab].php") will return a.php and b.php 

glob("[^a]*.php") will return: 
b.php // [^a] matches 'b', * matches nothing 
bc.php // [^a] matches 'b', * matches 'c' 
bcd.php // [^a] matches 'b', * matches 'cd' 

glob("[^ab]*.php") will return nothing because the character class will fail to match on the first character. 

You can also use ranges of characters inside the character class by having a starting and ending character with a hyphen in between.  For example, [a-z] will match any letter between a and z, [0-9] will match any (one) number, etc.. 

glob also supports limited alternation with {n1, n2, etc..}.  You have to specify GLOB_BRACE as the 2nd argument for glob in order for it to work.  So for example, if you executed glob("{a,b,c}.php", GLOB_BRACE) on the following list of files: 

a.php 
b.php 
c.php 

all 3 of them would return.  Note: using alternation with single characters like that is the same thing as just doing glob("[abc].php").  A more interesting example would be glob("te{xt,nse}.php", GLOB_BRACE) on: 

tent.php 
text.php 
test.php 
tense.php 

text.php and tense.php would be returned from that glob. 

glob's regex does not offer any kind of quantification of a specified character or character class or alternation.  For instance, if you have the following files: 

a.php 
aa.php 
aaa.php 
ab.php 
abc.php 
b.php 
bc.php 

with pcre regex you can do ~^a+\.php$~ to return 

a.php 
aa.php 
aaa.php 

This is not possible with glob.  If you are trying to do something like this, you can first narrow it down with glob, and then get exact matches with a full flavored regex engine.  For example, if you wanted all of the php files in the previous list that only have one or more 'a' in it, you can do this: 

<?php 
   $list = glob("a*.php"); 
   foreach ($list as $l) { 
      if (preg_match("~^a+\.php$~",$file)) 
         $files[] = $l; 
   } 
?> 

glob also does not support lookbehinds, lookaheads, atomic groupings, capturing, or any of the 'higher level' regex functions. 

*/

try {
    throw new Exception("Some error message", 30);
} catch(Exception $e) {
    echo "The exception code is: " . $e->getCode();
}

class Exception
{
    protected $message = 'Unknown exception';   // exception message
    private   $string;                          // __toString cache
    protected $code = 0;                        // user defined exception code
    protected $file;                            // source filename of exception
    protected $line;                            // source line of exception
    private   $trace;                           // backtrace
    private   $previous;                        // previous exception if nested exception

    public function __construct($message = null, $code = 0, Exception $previous = null);

    final private function __clone();           // Inhibits cloning of exceptions.

    final public  function getMessage();        // message of exception
    final public  function getCode();           // code of exception
    final public  function getFile();           // source filename
    final public  function getLine();           // source line
    final public  function getTrace();          // an array of the backtrace()
    final public  function getPrevious();       // previous exception
    final public  function getTraceAsString();  // formatted string of trace

    // Overrideable
    public function __toString();               // formatted string for display
}

/**
 * Define a custom exception class
 */
class MyException extends Exception
{
    // Redefine the exception so message isn't optional
    public function __construct($message, $code = 0, Exception $previous = null) {
        // some code
    
        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    public function customFunction() {
        echo "A custom function for this type of exception\n";
    }
}


class ExceptionHandler {   
    public static function printException(Exception $e)
    {
        print 'Uncaught '.get_class($e).', code: ' . $e->getCode() . "<br />Message: " . htmlentities($e->getMessage())."\n";
    }
   
    public static function handleException(Exception $e)
    {
         self::printException($e);
    }
}

set_exception_handler(array("ExceptionHandler", "handleException"));

class NewException extends Exception {}
try {
  throw new NewException("Catch me once", 1);
} catch (Exception $e) {
  ExceptionHandler::handleException($e);
}

throw new Exception("Catch me twice", 2);
?>

Gives:
Uncaught NewException, code: 1<br />Message: Catch me once
Uncaught Exception, code: 2<br />Message: Catch me twice

// There are much more interesting things that can be done like reformating and optionally displaying or emailing them. 
// But this class acts a nice container for those functions.




function error_handler($level, $message, $file, $line, $context) {
    //Handle user errors, warnings, and notices ourself
    if($level === E_USER_ERROR || $level === E_USER_WARNING || $level === E_USER_NOTICE) {
        echo '<strong>Error:</strong> '.$message;
        return(true); //And prevent the PHP error handler from continuing
    }
    return(false); //Otherwise, use PHP's error handler
}

function trigger_my_error($message, $level) {
    //Get the caller of the calling function and details about it
    $callee = next(debug_backtrace());
    //Trigger appropriate error
    trigger_error($message.' in <strong>'.$callee['file'].'</strong> on line <strong>'.$callee['line'].'</strong>', $level);
}

//Use our custom handler
set_error_handler('error_handler');

//-------------------------------
//Demo usage:
//-------------------------------
function abc($str) {
    if(!is_string($str)) {
        trigger_my_error('abc() expects parameter 1 to be a string', E_USER_ERROR);
    }
}

abc('Hello world!'); //Works
abc(18); //Error: abc() expects parameter 1 to be a string in [FILE].php on line 31


function error($message, $level=E_USER_NOTICE) {
$caller = next(debug_backtrace());
trigger_error($message.' in <strong>'.$caller['function'].'</strong> called from <strong>'.$caller['file'].'</strong> on line <strong>'.$caller['line'].'</strong>'."\n<br />error handler", $level);
}
?>

So now in our example:

main.php:
<?php
include('functions.php');
$x = 'test';
doFunction($x);
?>

functions.php:
<?php
function doFunction($var) {
    if(is_numeric($var)) {
         /* do some stuff*/
    } else {
         error('var must be numeric');
    }
}

function error($message, $level=E_USER_NOTICE) {
    $caller = next(debug_backtrace());
    trigger_error($message.' in <strong>'.$caller['function'].'</strong> called from <strong>'.$caller['file'].'</strong> on line <strong>'.$caller['line'].'</strong>'."\n<br />error handler", $level);
}
?>

now outputs:

//"Notice: var must be numeric in doFunction called from main.php on line 4"//


set_error_handler(function ($errno, $errstr, $errfile, $errline ) {
        if (error_reporting()) {
                throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
        }
});


//Exception handling
function ExceptionHandler($exception)
{
	try 
	{
    	//Getting exception information
		$errMsg = $exception->getMessage();
		$errLevel = $exception->getCode();
		$errFile = $exception->getFile();
		$errLine = $exception->getLine();
        
    	//Logging error information to log file or database		
        // TO - DO
	}
	catch (Exception $ex)
	{
		//Do nothing. 
		//Avoiding error from error handling...
	}
	
	//Redirect to Error page
	header("Location: /error.php");
    
	/* Don't execute PHP internal error handler */
    return true;
}
//Setting Exception Handler
set_exception_handler('ExceptionHandler');

 function exception_handler($exception) {
      echo "Uncaught exception: " , $exception->getMessage(), "\n";
   }
	
   set_exception_handler('exception_handler');
   throw new Exception('Uncaught Exception');
   
   echo "Not Executed\n";
   
  function errorHandler($errno, $errstr, $errfile, $errline) {
 
    switch ($errno) {
        case E_NOTICE:
        case E_USER_NOTICE:
        case E_DEPRECATED:
        case E_USER_DEPRECATED:
        case E_STRICT:
            echo("STRICT error $errstr at $errfile:$errline \n");
            break;
 
        case E_WARNING:
        case E_USER_WARNING:
            echo("WARNING error $errstr at $errfile:$errline \n");
            break;
 
        case E_ERROR:
        case E_USER_ERROR:
        case E_RECOVERABLE_ERROR:
            exit("FATAL error $errstr at $errfile:$errline \n");
 
        default:
            exit("Unknown error at $errfile:$errline \n");
    }
}
 
set_error_handler("errorHandler");
 
$foo = false;
 
if (! $foo) {
   trigger_error('Value $foo must be true', E_USER_NOTICE);
}

$file = '/tmp/foo.txt';
 
try {
    // check if the file exists and is writable
    if (! file_exists($file)  || ! is_writable($file) ) {
 
        // if not: throw an exception
        throw new Exception('File ' .$file. ' not found or is not writable.');
 
        echo('will the code get here?'); // not if an exception was thrown before
    }
}
catch(Exception $e) {
    echo 'Error message: ' .$e->getMessage();
    return false;
}

set_error_handler(function ($errno, $errstr, $errfile, $errline ) {
    if (error_reporting()) {
        throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
    }
});
 
try {
    // E_WARNING
    $fh = fopen('none-existing-file', 'r');
}
catch(Exception $e) {
    echo 'Error message: ' .$e->getMessage();
    return false;
}

$data = array('foo'=>'bar',
              'baz'=>'boom',
              'cow'=>'milk',
              'php'=>'hypertext processor');

echo http_build_query($data) . "\n";
echo http_build_query($data, '', '&amp;');
string http_build_query ( mixed $query_data [, string $numeric_prefix [, string $arg_separator [, int $enc_type = PHP_QUERY_RFC1738 ]]] )

filter_var('\0aä\x80', FILTER_SANITIZE_STRING) == '\0aä\x80'
filter_var('\0aä\x80', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW) == 'aä\x80'
filter_var('\0aä\x80', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH) == '\0a'
filter_var('\0aä\x80', FILTER_SANITIZE_STRING,
           FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH) == 'a'
var_dump(filter_var($url,FILTER_SANITIZE_SPECIAL_CHARS));
var_dump(filter_var($var, FILTER_SANITIZE_STRIPPED));
$url = "http://www.w3schools.com";

// Remove all illegal characters from a url
$url = filter_var($url, FILTER_SANITIZE_URL);

filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_QUERY_REQUIRED); 
// Encode characters
$url = filter_var($url, FILTER_SANITIZE_ENCODED);
echo filter_var($int, FILTER_SANITIZE_NUMBER_INT);


$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Foo'); //foo is a class name //
krsort(array,sortingtype);//sortype 1, by int, 2 by string 

class SuperORMException extends PDOException {}

class SuperORM {
    public function connect($dsn, $user, $password) {
        // try connecting to database
        try {
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e) {
            throw new SuperORMException($e->getMessage(), null, $e);
        }        
    }
}

class MysqlException extends Exception { 
 
    // path to the log file 
    private $log_file = 'mysql_errors.txt'; 
 
 
    public function __construct() { 
 
        $code = mysql_errno(); 
        $message = mysql_error(); 
 
        // open the log file for appending 
        if ($fp = fopen($this->log_file,'a')) { 
 
            // construct the log message 
            $log_msg = date("[Y-m-d H:i:s]") . 
                " Code: $code - " . 
                " Message: $message\n"; 
 
            fwrite($fp, $log_msg); 
 
            fclose($fp); 
        } 
 
        // call parent constructor 
        parent::__construct($message, $code); 
    } 
 
}
//(.*)(\?)(\w+=.+)+ //
?>