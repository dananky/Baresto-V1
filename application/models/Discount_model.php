<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Master_model
 *
 * @author user
 */
class Discount_model extends CI_Model {

private $_table = "tbl_discount";

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
}

