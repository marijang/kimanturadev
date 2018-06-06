<?php
/**
 * The General specific functionality.
 *
 * @since   2.0.0
 * @package Kimnatura\Plugins
 */

namespace Kimnatura\Plugins;

/**
 * Class General
 */
class MultipleFeaturedImages {

  /**
   * Global theme name
   *
   * @var string
   *
   * @since 2.0.0
   */
  protected $theme_name;

  /**
   * Global theme version
   *
   * @var string
   *
   * @since 2.0.0
   */
  protected $theme_version;

  /**
   * Initialize class
   *
   * @param array $theme_info Load global theme info.
   *
   * @since 2.0.0
   */
  public function __construct( $theme_info = null ) {
    $this->theme_name    = $theme_info['theme_name'];
    $this->theme_version = $theme_info['theme_version'];
  }

  /**
   * Enable theme support
   *
   * @since 2.0.0
   */

  public function kdmfi_featured_images( $featured_images ) {
    $args = array(
      'id' => 'featured-image-2',
      'desc' => 'Your description here.',
      'label_name' => 'Featured Image 2',
      'label_set' => 'Set featured image 2',
      'label_remove' => 'Remove featured image 2',
      'label_use' => 'Set featured image 2',
      'post_type' => array( 'post' ),
    );
  
    $featured_images[] = $args;
  
    return $featured_images;
  }


 


}
