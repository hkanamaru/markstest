<?php
/**
 * Marks House Theme functions
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// ===== テーマサポート =====
function marks_house_setup() {
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'custom-logo', [
        'height'      => 59,
        'width'       => 71,
        'flex-height' => true,
        'flex-width'  => true,
    ] );

    register_nav_menus( [
        'header-secondary' => __( 'ヘッダー（サブ）', 'marks-house' ),
        'header-primary'   => __( 'ヘッダー（メイン）', 'marks-house' ),
        'footer-nav'       => __( 'フッターナビ', 'marks-house' ),
    ] );

    load_theme_textdomain( 'marks-house', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'marks_house_setup' );

// ===== スタイル読み込み =====
// FSEテーマでは wp_enqueue_scripts が <head> に出力されない場合があるため
// wp_head に直接 <link> タグを出力する
function marks_house_output_styles() {
    $dir = get_template_directory_uri();
    $ver = wp_get_theme()->get( 'Version' );
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
    echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap">' . "\n";
    echo '<link rel="stylesheet" href="' . esc_url( $dir . '/style.css' ) . '?ver=' . esc_attr( $ver ) . '">' . "\n";
    echo '<link rel="stylesheet" href="' . esc_url( $dir . '/nav-studio.css' ) . '?ver=' . esc_attr( $ver ) . '">' . "\n";
    echo '<link rel="stylesheet" href="' . esc_url( $dir . '/common.css' ) . '?ver=' . esc_attr( $ver ) . '">' . "\n";
}
add_action( 'wp_head', 'marks_house_output_styles', 1 );

// ===== エディタースタイル =====
function marks_house_editor_styles() {
    add_editor_style( 'style.css' );
    add_editor_style( 'nav-studio.css' );
    add_editor_style( 'common.css' );
    add_editor_style( 'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap' );
}
add_action( 'after_setup_theme', 'marks_house_editor_styles' );

// サイトエディター内でも適用
function marks_house_enqueue_editor() {
    $ver = wp_get_theme()->get( 'Version' );
    wp_enqueue_style( 'marks-house-nav-studio', get_template_directory_uri() . '/nav-studio.css', [], $ver );
    wp_enqueue_style( 'marks-house-common', get_template_directory_uri() . '/common.css', [ 'marks-house-nav-studio' ], $ver );
}
add_action( 'enqueue_block_editor_assets', 'marks_house_enqueue_editor' );

// ===== ブロックパターンカテゴリ =====
function marks_house_register_pattern_categories() {
    register_block_pattern_category(
        'marks-house',
        [ 'label' => __( 'Marks House', 'marks-house' ) ]
    );
    register_block_pattern_category(
        'marks-house-cta',
        [ 'label' => __( 'CTA・問い合わせ', 'marks-house' ) ]
    );
    register_block_pattern_category(
        'marks-house-sections',
        [ 'label' => __( 'セクション', 'marks-house' ) ]
    );
}
add_action( 'init', 'marks_house_register_pattern_categories' );

// ===== ヒーロー背景画像 カスタマイザー =====
function marks_house_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'marks_house_hero', [
        'title'    => 'ヒーロー背景画像',
        'priority' => 30,
    ] );
    $wp_customize->add_setting( 'hero_bg_image', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_bg_image', [
        'label'    => '背景画像',
        'section'  => 'marks_house_hero',
        'settings' => 'hero_bg_image',
    ] ) );
}
add_action( 'customize_register', 'marks_house_customize_register' );

function marks_house_hero_bg_style() {
    $img = get_theme_mod( 'hero_bg_image', '' );
    if ( $img ) {
        echo '<style>.hero-section { background-image: url(' . esc_url( $img ) . ') !important; }</style>' . "\n";
    }
}
add_action( 'wp_head', 'marks_house_hero_bg_style' );

// ===== Contact Form 7 ショートコード有効化 =====
// wp:html ブロック内でもショートコードを展開する
function marks_house_do_shortcode( $content ) {
    return do_shortcode( $content );
}
add_filter( 'render_block_core/html', 'marks_house_do_shortcode' );

// ===== FSEテンプレートの自動リセット（WordPress.com対応）=====
function marks_house_reset_templates() {
    $theme_version  = wp_get_theme()->get( 'Version' );
    $stored_version = get_option( 'marks_house_template_version', '' );

    if ( $stored_version === $theme_version ) {
        return;
    }

    // wp_template と wp_template_part をWordPress APIで削除
    foreach ( [ 'wp_template', 'wp_template_part' ] as $post_type ) {
        $posts = get_posts( [
            'post_type'      => $post_type,
            'post_status'    => 'any',
            'posts_per_page' => -1,
            'fields'         => 'ids',
        ] );
        foreach ( $posts as $post_id ) {
            wp_delete_post( $post_id, true );
        }
    }

    // トランジェントキャッシュを削除
    delete_transient( 'wp_block_patterns' );
    delete_transient( 'wp_theme_files_patterns' );
    delete_transient( 'get_block_templates' );

    // オブジェクトキャッシュをクリア
    wp_cache_flush();

    update_option( 'marks_house_template_version', $theme_version );
}
add_action( 'after_setup_theme', 'marks_house_reset_templates' );
add_action( 'after_switch_theme', 'marks_house_reset_templates' );
add_action( 'upgrader_process_complete', 'marks_house_reset_templates' );
