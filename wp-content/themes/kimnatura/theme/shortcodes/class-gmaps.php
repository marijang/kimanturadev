<?php
/**
 * Google maps shortcode maps 
 *
 * @since   2.0.0
 * @package Kimnatura\Includes
 */

namespace Kimnatura\Theme\Shortcodes;

class Gmap {

    public function __construct() {
       // don't call add_shortcode here
       // actually, I worked with wordpress last year and
       // i think this is a good place to call add_shortcode 
       // (and all other filters) now...
       
    }

    public function wp_enqueue_script($key='AIzaSyCV8YEvsysGHxNf-YljgxfcLDYmH371ppE'){
        wp_enqueue_script( 
            'google-maps', 
            '//maps.googleapis.com/maps/api/js?key='.$key, 
            array(), 
            '1.0'
          );
    }


    public function shortcode($args) {
      $this->wp_enqueue_script();
        $args = shortcode_atts( array(
            'lat'    => '48.856259',
            'lng'    => '2.365043',
            'zoom'   => '8',
            'height' => '700px',
            'key'    => 'AIzaSyCV8YEvsysGHxNf-YljgxfcLDYmH371ppE'
        ), $args, 'map' );
        $id = substr( sha1( "Google Map" . time() ), rand( 2, 10 ), rand( 5, 8 ) );
        ob_start();
        ?>
        <div class='map gmap__map' id="karta" style='position: relative;'></div> 
    
    
        <script type='text/javascript'>
    jQuery(document).ready(function(){
    function initMap() {
      function CustomMarker(latlng,  map) {
        this.latlng_ = latlng;
        this.setMap(map);
      }
    
      CustomMarker.prototype = new google.maps.OverlayView();
      CustomMarker.prototype.draw = function() {
        var me = this;
        var div = this.div_;
        if (!div) {
          div = this.div_ = document.createElement('DIV');
          div.style.border = "none";
          div.style.position = "absolute";
          div.style.paddingLeft = "0px";
          div.style.cursor = 'pointer';
          this.div = div;
          var span = document.createElement('div');
          span.classList.add('pin');
          span.classList.add('bounce');
          span.innerHTML = '';
          div.appendChild(span);
    
          var pulse = document.createElement('div');
          pulse.classList.add('pulse');
          div.appendChild(pulse);
            
          //you could/should do most of the above via styling the class added below
          div.classList.add('pin-ala');
    
          google.maps.event.addDomListener(div, "click", function(event) {
            google.maps.event.trigger(me, "click");
          });
    
          var panes = this.getPanes();
          panes.overlayImage.appendChild(div);
        }
    
        var point = this.getProjection().fromLatLngToDivPixel(this.latlng_);
        if (point) {
          div.style.left = point.x + 'px';
          div.style.top = point.y + 'px';
        }
      };
    
      CustomMarker.prototype.remove = function() {
        if (this.div_) {
          this.div_.parentNode.removeChild(this.div_);
          this.div_ = null;
        }
      };
    
      CustomMarker.prototype.getPosition = function() {
       return this.latlng_;
      };
    
    ;
          map = new google.maps.Map(document.getElementById('karta'), {
            center: {lat: <?php echo $args['lat'] ?>, lng: <?php echo $args['lng'] ?>},
            zoom: <?php echo $args['zoom'] ?>,
            styles: [{"stylers": [{ "saturation": -100 }]}]
          });
          var point= {lat:<?php echo $args['lat'] ?>, lng: <?php echo $args['lng'] ?>};
          var myLatLng = new google.maps.LatLng(point.lat, point.lng)
          var myMarker = new CustomMarker(myLatLng,map);
      }
    
    
      initMap();
      
      });

        </script>
        <?php
        $output = ob_get_clean();
        return $output;
    }



}