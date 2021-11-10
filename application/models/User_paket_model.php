<?php
class User_paket_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Get user_paket by id_user_paket
     */
    function get_user_paket($id_user_paket)
    {
        return $this->db->get_where('user_paket', array('id_user_paket' => $id_user_paket))->row_array();
    }
    function get_user_paket_by_user($id_user)
    {
        return $this->db->join('paket','paket.id_paket = user_paket.id_paket')->get_where('user_paket', array('id_user' => $id_user))->result_array();
    }

    /*
     * Get all user_paket
     */
    function get_all_user_paket()
    {
        $this->db->order_by('id_user_paket', 'desc');
        return $this->db->get('user_paket')->result_array();
    }

    /*
     * function to add new user_paket
     */
    function add_user_paket($params)
    {
        $this->db->insert('user_paket', $params);
        return $this->db->insert_id();
    }

    /*
     * function to update user_paket
     */
    function update_user_paket($id_user_paket, $params)
    {
        $this->db->where('id_user_paket', $id_user_paket);
        return $this->db->update('user_paket', $params);
    }

    /*
     * function to delete user_paket
     */
    function delete_user_paket($id_user_paket)
    {
        return $this->db->delete('user_paket', array('id_user_paket' => $id_user_paket));
    }
}
