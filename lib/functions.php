<?php
/**
 * Created by IntelliJ IDEA.
 * User: timomo
 * Date: 14/12/30
 * Time: 20:22
 */

/**
 * @param string $config_name
 * @return mixed
 */
function read_config_option( $config_name ) {
    global $config;
    if ( array_key_exists( $config_name, $config ) == false ) {
        return null;
    }
    return $config[ $config_name ];
}

/**
 * @param int $time
 * @return string
 */
function get_time( $time = null ) {
    $dt = new DateTime();
    if ( is_null( $time ) == false ) {
        $dt->setTimestamp( $time );
    }
    $tz = new DateTimeZone( 'Asia/Tokyo' );
    $dt->setTimezone( $tz );
    $gettime = $dt->format( 'Y-m-d H:i' );
    return $gettime;
}

function file_lock() {

}

function file_unlock() {

}

function error_page( $error ) {
    
    
}

/**
 * @param mixed $tmp
 */
function forward( $tmp ) {
    if ( array_key_exists( 'FFADV_COMMAND_MAP', $GLOBALS ) == false ) {
        set_command_map();
    }
    
    $mode = '';
    $func = $GLOBALS['FFADV_COMMAND_MAP'][ $mode ];

    if ( function_exists( $func ) ) {
        call_user_func( $func, $tmp );
    } else {
        error_page( '指定されたページはありません' );
    }
}

/**
 * グローバル変数にフォワード用の連想配列を定義する
 *
 * @return void
 */
function set_command_map() {
    $GLOBALS['FFADV_COMMAND_MAP'] = array(
        '' => 'html_top',
        'log_in' => 'log_in',
        'chara_make' => 'chara_make',
        'make_end' => 'make_end',
        'regist' => 'regist',
        'battle' => 'battle',
        'tensyoku' => 'tensyoku',
        'monster' => 'monster',
        'ranking' => 'ranking',
        'yado' => 'yado',
        'message' => 'message',
        'item_shop' => 'item_shop',
        'item_buy' => 'item_buy'
    );
}

/**
 * @param string $path
 * @return array
 */
function read_file( $path ) {
    if ( file_exists( $path ) == false ) {
        return array();
    }
    $contents = file( $path, FILE_USE_INCLUDE_PATH | FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
    return $contents;
}