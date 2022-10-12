<?php

// Defines
define('FL_THEME_DIR', get_stylesheet_directory());
define('FL_THEME_URL', get_stylesheet_directory_uri());
define('FL_THEME_VERSION', '1.1.0');

//Classes
if (!class_exists('FL_Filesystem')) {
  require_once 'classes/class-fl-filesystem.php';
}
require_once 'classes/class-fl-color.php';
require_once 'classes/class-fl-css.php';
require_once 'classes/class-fl-customizer.php';
require_once 'classes/class-fl-fonts.php';
require_once 'classes/class-fl-layout.php';
require_once 'classes/class-theme.php';
require_once 'classes/class-fl-theme-update.php';
require_once 'classes/class-fl-compat.php';
require_once 'classes/class-fl-shortcodes.php';
require_once 'classes/class-fl-wp-editor.php';
require_once 'classes/class-fl-customizer-control.php';
require_once 'classes/class-fl-lessc-deprecated.php';

if (defined('WP_CLI')) {
  require 'classes/class-fl-wpcli-command.php';
}

// Theme Actions
add_action('after_switch_theme', 'FLCustomizer::refresh_css');
add_action('after_setup_theme', 'FLTheme::setup');
add_action('init', 'FLTheme::init_woocommerce');
add_action('wp_enqueue_scripts', 'FLTheme::enqueue_scripts', 999);
add_action('widgets_init', 'FLTheme::widgets_init');
add_action('wp_footer', 'FLTheme::go_to_top');
add_action('fl_after_post', 'FLTheme::after_post_widget', 10);
add_action('fl_after_post_content', 'FLTheme::post_author_box', 10);
add_action('fl_before_footer_widgets', 'FLTheme::rodape');

// Header Actions
add_action('wp_head', 'FLTheme::pingback_url');
add_action('fl_head_open', 'FLTheme::title');
add_action('fl_head_open', 'FLTheme::favicon');
add_action('fl_head_open', 'FLTheme::fonts');
add_action('fl_body_open', 'FLTheme::skip_to_link');

if (function_exists('wp_body_open')) {
  add_action('fl_body_open', 'wp_body_open');
}

// Theme Filters
add_filter('body_class', 'FLTheme::body_class');
add_filter('excerpt_more', 'FLTheme::excerpt_more');
add_filter('loop_shop_columns', 'FLTheme::woocommerce_columns');
add_filter('loop_shop_per_page', 'FLTheme::woocommerce_shop_products_per_page');
add_filter('comment_form_default_fields', 'FLTheme::comment_form_default_fields');
add_filter('woocommerce_style_smallscreen_breakpoint', 'FLTheme::woo_mobile_breakpoint');
add_filter('walker_nav_menu_start_el', 'FLTheme::nav_menu_start_el', 10, 4);
add_filter('comments_popup_link_attributes', 'FLTheme::comments_popup_link_attributes');
add_filter('comment_form_defaults', 'FLTheme::comment_form_defaults');

// Theme Updates
add_action('init', 'FLThemeUpdate::init');

// Admin Actions
add_action('admin_head', 'FLTheme::favicon');

// Customizer
add_action('customize_preview_init', 'FLCustomizer::preview_init');
add_action('customize_controls_enqueue_scripts', 'FLCustomizer::controls_enqueue_scripts');
add_action('customize_controls_print_footer_scripts', 'FLCustomizer::controls_print_footer_scripts');
add_action('customize_controls_print_styles', 'FLCustomizer::controls_print_styles');
add_action('customize_register', 'FLCustomizer::register');
add_action('customize_save_after', 'FLCustomizer::save');

function pointcom_carregando_scripts()
{

  wp_enqueue_script('pointcom_maskJS', get_template_directory_uri() . '/assets/js/pointcom_maskJS.js', array('jquery'), null, true);
  wp_enqueue_script('pointcom_mask', get_template_directory_uri() . '/assets/js/pointcom_mask.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'pointcom_carregando_scripts');

//shortcodes
add_action('after_setub_theme', function () {
});

//Paginação
// function pagination_bar($query = null)
// {
//   global $wp_query;
//   $query = $query ? $query : $wp_query;

//   $total_pages = $query->max_num_pages;

//   if ($total_pages > 1) {
//     $current_page = max(1, get_query_var('paged'));

//     $big = 999999999;
//     echo '<div class="custom-paginacao">' . paginate_links(array(
//       'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
//       'format' => '?paged=%#%',
//       'current' => $current_page,
//       'total' => $total_pages,
//       'prev_text' => __('&laquo;'),
//       'next_text' => __('&raquo;'),
//     )) . '</div>';
//   }
// }

//Pagina de opções para utilização do ACF Pro
if (function_exists('acf_add_options_page')) {
  acf_add_options_page(array(
    'page_title' => 'Configurações do Site',
    'menu_title' => 'Configurações do Site',
    'menu_slug'  => 'configuracoes-do-site',
    'position'   => '8',
    'icon_url'   => 'dashicons-admin-generic',
    'capability' => 'edit_posts',
    'redirect'   => true
  ));
  // SubPagina
  // acf_add_options_sub_page(array(
  //   'page_title'     => 'Email',
  //   'menu_title'    => 'Email',
  //   'parent_slug'    => 'configuracoes-do-site',
  // ));
}

// adicionar clesse personalizada no link ativo do menu
add_filter('nav_menu_css_class', 'FLTheme::activeLinkMenu', 10, 2);

// reescrever urls
add_filter('rewrite_rules_array', 'FLTheme::addRewriteRules');

//Init Sessions
add_action('init', 'FLTheme::startSession', -99999999);

// add variaveis personalizadas na busca
add_filter('query_vars', 'FLTheme::addVariaveisPesquisa');

// Altera Query padrão do WordPress
add_action('pre_get_posts', 'FLTheme::customQueryVars');


//Registrando menus
register_nav_menus(
  array(
    'header' => 'Main Menu',
    'footer' => 'Footer Menu'
  )
);
