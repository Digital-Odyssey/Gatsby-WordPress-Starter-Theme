<?php 

class My_Customizer_Options_Controller {
    
    //constructor
    public function __construct() {
        $this->namespace = 'wp-api-customizer/v2';
        $this->resource_name = 'customizer';
    }//end __construct

    //register routes
    public function register_routes() {

        register_rest_route( $this->namespace, '/' . $this->resource_name, array(
            //register the readable endpoint for data collections
            array(
                'methods'  => WP_REST_Server::READABLE,
                'callback' => array($this, 'get_customizer_options')
            ),

        ));

    }//end register_routes

    //fetch our data and return it to the rest api
    public function get_customizer_options($request) {

        //Get the customizer options
        $archivePageHeroImage = get_theme_mod('archivePageHeroImage');
        $tagPageHeroImage = get_theme_mod('tagPageHeroImage');
        $blogPageHeroImage = get_theme_mod('blogPageHeroImage');

        $customizer_options = array();
        $customizer_options['archive_hero_image'] = $archivePageHeroImage;
        $customizer_options['tag_hero_image'] = $tagPageHeroImage;
        $customizer_options['blog_hero_image'] = $blogPageHeroImage;

        //throw a wp error if no options are returned
        if(count($customizer_options) == 0) {
            return new WP_Error( 'no_customizer_options', 'No customizer options found.', array( 'status' => 404 ) );
        }

        //else return our customizer options to the browser
        $i = 1;
        $options = array();
        foreach($customizer_options as $key => $value) {
            array_push($options, json_decode('{"id": '. $i .', "name": "'. $key .'", "source_url" : "' . $value . '"}'));
            $i++;
        }
    
        //return response to browser with a status of 200
        return new WP_REST_Response( $options, 200 ); 

    }//end get_customizer_options

}

?>