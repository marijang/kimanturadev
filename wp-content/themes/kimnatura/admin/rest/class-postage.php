<?php
/**
 * The Menu specific functionality.
 *
 * http://kimnatura.test/wp-admin/admin-ajax.php?action=search
 * @since   2.0.0
 * @package Kimnatura\Admin\Menu
 */

namespace Kimnatura\Admin\Rest;
use Kimnatura\Admin\WP_AJAX as WP_AJAX;
use Kimnatura\Admin\Woo as Woo;

Class Postage extends WP_AJAX
{
    protected $action = 'free-postage';

    protected function run()
    {
        
        Woo::shipping_method_notice();
       // Woo->shipping_method_notice();
    }

}