<?php
class SlSettingsPage
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
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
      $sl_settings_page =  add_options_page(
            'Settings Admin', 
            'Social Lock', 
            'manage_options', 
            'sl-setting-admin', 
            array( $this, 'create_admin_page' )
        );
		
	add_action( "admin_head-{$sl_settings_page}", array($this,'load_sl_wp_style') );
    }

	public function load_sl_wp_style(){
	 
	 //wp_enqueue_style( 'adminp',plugins_url( 'css/admin.css', __FILE__ ) );

     wp_enqueue_script( 'll_shortcode_gen',plugins_url( 'js/social-lock.js', __FILE__ ) );
	}
    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'sl_option_name' );
		
		//echo "<pre>";print_r($this->options);die;
		
		
        ?>
       <div class="wrap columns-2">
            <?php screen_icon(); ?>
            <h2>Social Lock </h2>     
		<div id="poststuff" class="metabox-holder has-right-sidebar">	
 <?php include("sidebar.php"); ?>

			<div id="post-body">
			<div id="post-body-content">
			
				<div class="stuffbox">
					<div class="inside">
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'sl_option_group' );   
                do_settings_sections( 'sl-setting-admin' );
                submit_button(); 
            ?>
            </form>
			</div>
        </div>
        </div>
        </div>
        </div>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'sl_option_group', // Option group
            'sl_option_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            '', // Title
            array( $this, 'print_section_info' ), // Callback
            'sl-setting-admin' // Page
        );  

        add_settings_field(
            'twitter_username', // ID
            'Twitter Username', // Title 
            array( $this, 'tw_user_callback' ), // Callback
            'sl-setting-admin', // Page
            'setting_section_id' // Section           
        );      

        add_settings_field(
            'fb_app_id', 
            'Facebook AppId', 
            array( $this, 'fb_app_id_callback' ), 
            'sl-setting-admin', 
            'setting_section_id'
        );   

		add_settings_field(
            'sl_default_msg', 
            'Lock Message', 
            array( $this, 'sl_default_msg_callback' ), 
            'sl-setting-admin', 
            'setting_section_id'
        );  
		
	   add_settings_field(
				'use_sl_buttons', 
				'Use <em>Social Lock\'s</em> Social Buttons', 
				array( $this, 'use_sl_buttons_callback' ), 
				'sl-setting-admin', 
				'setting_section_id'
			); 	
      
		add_settings_field(
				'plusone_button', 
				'', 
				array( $this, 'plusone_button_callback' ), 
				'sl-setting-admin', 
				'setting_section_id'
			); 
		add_settings_field(
				'tweet_button', 
				'', 
				array( $this, 'tweet_button_callback' ), 
				'sl-setting-admin', 
				'setting_section_id'
			);
		
		add_settings_field(
			'like_button', 
			'', 
			array( $this, 'like_button_callback' ), 
			'sl-setting-admin', 
			'setting_section_id'
		);
			
	
		
	add_settings_field(
			'sl_post_or_fbpage', 
			'', 
			array( $this, 'sl_post_or_fbpage_callback' ), 
			'sl-setting-admin', 
			'setting_section_id'
		);
		
    add_settings_field(
			'fbpage_id', 
			'Facebook Page URL', 
			array( $this, 'fbpage_id_callback' ), 
			'sl-setting-admin', 
			'setting_section_id'
		);		
	  add_settings_field(
            'use_sl_timer', 
            'Use Timer', 
            array( $this, 'use_sl_timer_callback' ), 
            'sl-setting-admin', 
            'setting_section_id'
        ); 

	  add_settings_field(
            'timer_time', 
            'Timer Time', 
            array( $this, 'timer_time_callback' ), 
            'sl-setting-admin', 
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
        if( isset( $input['fb_app_id'] ) )
        $input['fb_app_id'] = absint( $input['fb_app_id'] );
		
		if( isset( $input['timer_time'] ) )
        $input['timer_time'] = absint( $input['timer_time'] ) !=0?absint( $input['timer_time'] ):10;

		if(isset($input['sl_default_msg']))
         $input['sl_default_msg'] =  $input['sl_default_msg'] !='' ?  esc_attr( $input['sl_default_msg']) : 'Like Tweet or +1 to view the locked content or wait for the timer';
        return $input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
      //  print 'Enter your settings below:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function tw_user_callback()
    {
        printf(
            '<input type="text" id="twitter_username" size="40" name="sl_option_name[twitter_username]" value="%s" />',
            isset( $this->options['twitter_username'] ) ? esc_attr( $this->options['twitter_username']) : 'buffernow'
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function fb_app_id_callback()
    {
        printf(
            '<input type="text" id="fb_app_id" size="40" name="sl_option_name[fb_app_id]" value="%s" />',
            isset( $this->options['fb_app_id'] ) ? esc_attr( $this->options['fb_app_id']) : ''
        );
    }
	
	public function sl_default_msg_callback() {
	
	  printf(
            '<textarea type="text" style="width: 355px; height: 109px;" id="sl_default_msg" name="sl_option_name[sl_default_msg]"  />%s</textarea>',
            isset( $this->options['sl_default_msg'] ) ? esc_attr( $this->options['sl_default_msg']) : ''
        );
	}
	
	 public function use_sl_buttons_callback()
	 {
	  if(isset($this->options['use_sl_button']) && $this->options['use_sl_button'] =='on')
	  echo '<input type="checkbox" id="use_sl_button" name="sl_option_name[use_sl_button]" checked="checked" />';
	  else
	  echo '<input type="checkbox" id="use_sl_button" name="sl_option_name[use_sl_button]" />';
	 }
	 
	 public function plusone_button_callback(){
	  if(isset($this->options['plusone_button']) && $this->options['plusone_button'] =='on')
	  echo '<input type="checkbox" id="plusone_button" name="sl_option_name[plusone_button]" checked="checked" />';
	  else
	  echo '<input type="checkbox" id="plusone_button" name="sl_option_name[plusone_button]" />';
	  
	  echo '<label><em>Google +1</em></label>';
	 }
	 
	  public function tweet_button_callback(){
	  if(isset($this->options['tweet_button']) && $this->options['tweet_button'] =='on')
	  echo '<input type="checkbox" id="tweet_button" name="sl_option_name[tweet_button]" checked="checked" />';
	  else
	  echo '<input type="checkbox" id="tweet_button" name="sl_option_name[tweet_button]" />';
	  
	  echo '<label><em>Tweet</em></label>';
	 }
	 
	  public function like_button_callback(){
	 
	 if(isset($this->options['like_button']) && $this->options['like_button'] =='on')
	  echo '<input type="checkbox" id="like_button" name="sl_option_name[like_button]" checked="checked" />';
	  else
	  echo '<input type="checkbox" id="like_button" name="sl_option_name[like_button]" />';
	  
	  echo '<label><em>Facebook </em></label>';
	  
	 
	 }
	 
	 public function sl_post_or_fbpage_callback(){
	   if(isset( $this->options['sl_post_or_fbpage'] ))
	  {
	  if($this->options['sl_post_or_fbpage'] == 1)
		 {
		 echo '<input type="radio" id="like_button_post" name="sl_option_name[sl_post_or_fbpage]" value="1" checked="checked" />
		 <label><em>Post Like</em></label> ';
			  echo '<input type="radio" id="like_button_page" name="sl_option_name[sl_post_or_fbpage]"  value="0"  />
			  <label><em>FB or External Page Like</em></label>';
			
		 }
	  else{
	   echo '<input type="radio" id="like_button_post" name="sl_option_name[sl_post_or_fbpage]" value="1"  />
	   <label><em>Post Like</em></label> ';
	 	  echo '<input type="radio" id="like_button_page" name="sl_option_name[sl_post_or_fbpage]" checked="checked"  value="0"  />
		  <label><em>FB or External Page Like</em></label>';
	 
	  }
    }else{
         echo '<input type="radio" id="like_button_post" name="sl_option_name[sl_post_or_fbpage]" checked="checked" value="1"  />
		 <label><em>Post Like</em></label> ';
	 	  echo '<input type="radio" id="like_button_page" name="sl_option_name[sl_post_or_fbpage]"   value="0"  />
		   <label><em>FB or External Page Like</em></label>';
	 
    }
	 }
	 
	public function fbpage_id_callback(){
	  printf(
            '<input type="text" id="fbpage_id" size="40" name="sl_option_name[fbpage_id]" value="%s" />',
            isset( $this->options['fbpage_id'] ) ? esc_attr( $this->options['fbpage_id']) : ''
        );
	}
	 
	 public function use_sl_timer_callback(){
	  	  if(isset( $this->options['use_sl_timer'] ) && $this->options['use_sl_timer'] =='on' )
	  echo '<input type="checkbox" id="use_sl_timer" name="sl_option_name[use_sl_timer]" checked="checked" />';
	  else
	  echo '<input type="checkbox" id="use_sl_timer" name="sl_option_name[use_sl_timer]" />';
	 }
	 
	  public function timer_time_callback(){
	  	 printf(
            '<input type="text" id="timer_time" size="40" name="sl_option_name[timer_time]" value="%s" />',
            isset( $this->options['timer_time'] ) ? esc_attr( $this->options['timer_time']) : 10
        );
		echo '<label> Seconds.</label>';
	 }
	
}

if( is_admin() )
    $sl_settings_page = new SlSettingsPage();