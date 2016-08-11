<?php 
class randomstring {
	
private $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
private $random_string_length = 8;
private $string = '';

public function generate(){
 for ($i = 0; $i < $this->random_string_length; $i++) {
      $this->string .= $this->characters[mt_rand(0, strlen($this->characters) - 1)];
 }
 
 return $this->string . "<br/>";
}

}
$random_pass = new randomstring();
echo $random_pass->generate();

echo chr(97). ord('a')."<br/>";

function conv($str){
	$return = "";
	for($i=0; $i < strlen($str); $i++){
		$return.= "#&".ord($str[$i]);
	}
	return $return;
}
$text = "I'm going home";
echo $text ."<br/>";
$conv_text = conv($text);
echo $conv_text . "<br/>";

function deconv($str){
	$str = ltrim($str,"#");
	$str = str_replace("&", "", $str);
	$str = trim($str);
	$str_arr = explode("#", $str);
	
		return $str_arr;
}
print_r(deconv($conv_text));
echo "<br>";
function decode ($val){
		return chr($val);
	}
$my_arr = deconv($conv_text);
echo implode("",array_map('decode', $my_arr));
echo "<br>";

?> 
<div>
<?php 
function AddBB($var) {
        $search = array(
                '/\[b\](.*?)\[\/b\]/is',
                '/\[i\](.*?)\[\/i\]/is',
                '/\[u\](.*?)\[\/u\]/is',
                '/\[img\](.*?)\[\/img\]/is',
                '/\[url\](.*?)\[\/url\]/is',
                '/\[url\=(.*?)\](.*?)\[\/url\]/is'
                );

        $replace = array(/s
                '<strong>$1</strong>',
                '<em>$1</em>',
                '<u>$1</u>',
                '<img src="$1" />',
                '<a href="$1">$1</a>',
                '<a href="$1">$2</a>'
                );

        $var = preg_replace ($search, $replace, $var);
        return $var;
} 

$link = "[b]I'm home [/b][b]i'm still going too [/b] i'm not there [b] but he is [/b]";
echo AddBB($link);
?>

</div>