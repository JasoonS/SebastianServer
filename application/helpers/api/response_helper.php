<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * This is common helper to respond app with fixed json format
     * created on - 1sh Jul,2015;
     * updated on - 
     * created by - Akshay
     */

header('Content-type:applicatin/json'); 
function response_ok($data = array()) {
    response(true, $data);
}

function response_fail($error = '', $data = array()) {
    response(false, $data, $error);
}

function response($status, $data = array(), $error = '') {
    $response = array();
    $response['status'] = (bool) $status === true ? 1 : 0;
    $response['statusInfo'] = $response['status'] === 1 ? 'success' : 'fail';

    if (strlen($error) > 0) {
        $response['error'] = $error;
    }

    if (count($data) > 0) {
        foreach ($data as $k => $v) {
            if (!isset($response[$k])) {
                $response[$k] = $v;
            } else {
                throw new Exception('Response variable invalid name');
            }
        }
    }

    exit(json_encode($response));
}