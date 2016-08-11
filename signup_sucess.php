<?php 
//connect to a session //
session_start();



?>


<?php if(isset($_SESSION['success_signup']) && $_SESSION['success_signup'] != "") : 
// includes some functions //
require "includes/functions.php";

// add my header elements i.e. doctype, head, title, stylesheet etc from functions.php: line 72 //
get_header();
//====================================================================================//
?>
<body>
<div class="container container-signup">
<div class="alert alert-success">
<?php echo $_SESSION['success_signup'];?>


</div><!-- alert div closes -->
<div>
<?php get_login_form(); ?>


</div>

</div><!-- container div closes -->
</body>
</html>

<?php else : 
header("Location:signup_form.php");	

endif;?>







</body>
</html>