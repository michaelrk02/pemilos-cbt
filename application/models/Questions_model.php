<?php

class Questions_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    /* read functions */

    public function get($id) {
        $this->db->select('*')->from('questions');
        $this->db->where('id =', $id);

        return fetch($this->db);
    }

    public function get_all() {
        $this->db->select('*')->from('questions');

        return fetch($this->db, -1);
    }

    public function get_count() {
        $this->db->select('COUNT(*)')->from('questions');

        return $this->db->get()->row_array(0)['COUNT(*)'];
    }

}

?>
