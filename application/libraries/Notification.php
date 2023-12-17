<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification {

    public function show_notification($message, $type = 'info') {
        $CI =& get_instance();
        $CI->load->library('session');

        $notifications = $CI->session->userdata('notifications') ?: [];
        $notifications[] = ['message' => $message, 'type' => $type];
        $CI->session->set_userdata('notifications', $notifications);
    }

    public function get_notifications() {
        $CI =& get_instance();
        $CI->load->library('session');
        return $CI->session->flashdata('notifications') ?: [];
    }
}
