<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package galsUz
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function galsuz_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'galsuz_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function galsuz_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'galsuz_pingback_header' );

add_action('wp_ajax_ofSendMail', 'wpse_sendmail');
add_action('wp_ajax_nopriv_ofSendMail', 'wpse_sendmail');

function wpse_sendmail()
{
  //$_POST = json_decode(file_get_contents('php://input'), true);
  $tarif     = strip_tags($_POST['tarif']);
  $name     = strip_tags($_POST['name']);
  $email     = strip_tags($_POST['email']);
  $phone     = strip_tags($_POST['phone']);
  $address  = strip_tags($_POST['address']);
  $rayon  = strip_tags($_POST['rayon']);
  $massiv  = strip_tags($_POST['massiv']);
  $nomerDoma  = strip_tags($_POST['nomerDoma']);
  $comment     = strip_tags($_POST['comment']);

  $subject = "Заявка на подключение тарифа";
  $to = get_option('admin_email');
  $headers = array('Content-Type: text/html; charset=UTF-8', 'From: ' . get_option('blogname') . ' <info@' . $_SERVER['SERVER_NAME'] . '>');
  $message = "
  Тариф       - $tarif <br />
	Имя         - $name 	<br />
	email       - $email 	<br />
	телефон     - $phone 	<br />
	адрес    - $address<br />
	район    - $rayon<br />
	массив    - $massiv<br />
	номер дома, квартиры    - $nomerDoma<br />
	<br />
  $comment
	";

  $tarif_data = get_option('tarif_data');
  if (!empty($tarif_data)) {
    $tarif_data = unserialize($tarif_data);
  }

  $tarif_data[] = [
    'tarif' => $tarif,
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
    'address' => $address,
    'rayon' => $rayon,
    'massiv' => $massiv,
    'nomerDoma' => $nomerDoma,
    'comment' => $comment,
  ];

  update_option('tarif_data', serialize($tarif_data), false);

  if (wp_mail($to, $subject, $message, $headers)) {
    die('{"data":"ok"}');
  }
}

add_action('wp_ajax_ofSendMailSimple', 'wpse_sendmail_simple');
add_action('wp_ajax_nopriv_ofSendMailSimple', 'wpse_sendmail_simple');

function wpse_sendmail_simple()
{
  //$_POST = json_decode(file_get_contents('php://input'), true);
  $name     = strip_tags($_POST['name']);
  $email     = strip_tags($_POST['email']);
  $phone     = strip_tags($_POST['phone']);
  $comment     = strip_tags($_POST['comment']);
  $postTitle     = strip_tags($_POST['postTitle']);
  $url     = strip_tags($_POST['url']);

  $subject = "Письмо с сайта";
  $to = get_option('admin_email');
  $headers = array('Content-Type: text/html; charset=UTF-8', 'From: ' . get_option('blogname') . ' <info@' . $_SERVER['SERVER_NAME'] . '>');
  $message = "
	Имя         - $name 	<br />
	email       - $email 	<br />
	телефон     - $phone 	<br />
  Отправлено со страницы - $postTitle ($url)
	<br />
  $comment
	";

  $simple_data = get_option('simple_data');
  if (!empty($simple_data)) {
    $simple_data = unserialize($simple_data);
  }

  $simple_data[] = [
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
    'comment' => $comment,
  ];

  update_option('simple_data', serialize($simple_data), false);


  if (wp_mail($to, $subject, $message, $headers)) {
    die('{"data":"ok"}');
  }
}
