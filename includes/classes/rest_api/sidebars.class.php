<?php 

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class My_Sidebars_Controller {

    public function __construct() {
        $this->namespace = 'wp-sidebars/v2';
        $this->resource_name = 'sidebars';
    }//end __construct

    public function register_routes() {

        register_rest_route( $this->namespace, '/' . $this->resource_name, array(
            array(
                'methods'  => WP_REST_Server::READABLE,
                'callback' => array($this, 'get_sidebars')
            ),

        ));

    }//end register_routes

    public function get_sidebars( $request ) {
        
        if ( ! $request instanceof WP_REST_Request ) {
            throw new InvalidArgumentException( __METHOD__ . ' expects an instance of WP_REST_Request' );
        }

        $sidebar = self::get_widgets();

        ob_start();
        dynamic_sidebar();
        ob_get_clean();

        return new WP_REST_Response( $sidebar, 200 );
    }


    function get_widgets() {

        global $wp_registered_widgets, $wp_registered_sidebars;
    
        $widgets = array();
        $sidebars_widgets = (array) wp_get_sidebars_widgets();        
    
        foreach ( $sidebars_widgets as $key => $widget ) {
            
            foreach($widget as $widget_id) {
    
                // safety check
                if ( isset( $wp_registered_widgets[ $widget_id ] ) ) {

                    $widget = $wp_registered_widgets[ $widget_id ];
    
                    // get the widget output
                    if ( is_callable( $widget['callback'] ) ) {

                        //everything up to ob_start is taken from the dynamic_sidebar function in get_sidebars()
                        $widget_parameters = array_merge(
                            [
                                array_merge( $wp_registered_sidebars, [
                                    'widget_id' => $widget_id,
                                    'widget_name' => $widget['name'],
                                ] )
                            ],
                            (array) $widget['params']
                        );

                        //insert parent sidebar so we can filter in graphql
                        $widget['parent_sidebar'] = $key;
    
                        $classname = '';
                        foreach ( (array) $widget['classname'] as $cn ) {
                            if ( is_string( $cn ) )
                                $classname .= '_' . $cn;
                            elseif ( is_object( $cn ) )
                                $classname .= '_' . get_class( $cn );
                        }
                        $classname = ltrim( $classname, '_' );
                        $widget_parameters[0]['before_widget'] = sprintf( $widget_parameters[0]['before_widget'], $widget_id, $classname );
    
                        ob_start();
                        call_user_func_array( $widget['callback'], $widget_parameters );
                        $widget['rendered'] = ob_get_clean();
                    }
    
                    unset( $widget['callback'] );
                    unset( $widget['params'] );
    
                    $widgets[] = $widget;
                }
    
            } //end foreach
    
        }//end foreach
    
        return $widgets;
        
    }


}//end class

?>