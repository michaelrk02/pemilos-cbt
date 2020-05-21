<?php

class Users_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    /* read functions */

    public function get($username) {
        $this->db->select('*')->from('users');
        $this->db->where('username =', $username);

        return fetch($this->db);
    }

    public function get_all() {
        $this->db->select('*')->from('users');

        return fetch($this->db, -1);
    }

    /* update functions */

    public function set($username, $data) {
        $this->db->where('username =', $username);
        $this->db->update('users', $data);
    }

}

?>
