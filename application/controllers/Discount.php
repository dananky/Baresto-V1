<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Discount extends CI_Controller {


    public function __construct() {
        parent::__construct();

        $this->load->model('Authentication_model');
        $this->load->model('Common_model');
        $this->load->model('Discount_model');
        $this->load->library('form_validation');
        $this->Common_model->setDefaultTimezone();
        
        if (!$this->session->has_userdata('user_id')) {
            redirect('Authentication/index');
        }

        // $getAccessURL = $this->uri->segment(1);
        // if (!in_array($getAccessURL, $this->session->userdata('menu_access'))) {
        //     redirect('Authentication/userProfile');
        // }
    }


    public function discount() {

        $user_id = $this->session->userdata('user_id');

        $data = array();
        $data['master_menu'] = 'discount';
        $data['sub_menu'] = '';

        $data['discount'] = $this->Common_model->getAllByTable("tbl_discount");
        $data['main_content'] = $this->load->view('discount/discount', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public function deleteDiscount($id) {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');

        $this->Common_model->deleteStatusChange($id, "tbl_discount");

        $this->session->set_flashdata('exception', lang('delete_success'));
        redirect('discount/discount');
    }



public function addEditDiscount($encrypted_id = "") {
    $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
    if ($this->input->post('submit')) {
        $this->form_validation->set_rules('discount_name',lang('discount_name'), 'required|max_length[50]');
        $this->form_validation->set_rules('amount', lang('amount'), 'max_length[50]');
    if ($this->form_validation->run() == TRUE) {
       
       $igc_info = array();
       $data['master_menu'] = 'discount';
       $data['sub_menu'] = '';
       $igc_info['discount_name'] = htmlspecialchars($this->input->post($this->security->xss_clean('discount_name')));
       $igc_info['amount'] = $this->input->post($this->security->xss_clean('amount'));
       $igc_info['price'] = $this->input->post($this->security->xss_clean('price'));
       $igc_info['status'] = $this->input->post($this->security->xss_clean('status'));
       $igc_info['user_id'] = $this->session->userdata('user_id');
       $igc_info['outlet_id'] = $this->session->userdata('outlet_id');
            
        if ($id == "") {
            $this->Common_model->insertInformation($igc_info, "tbl_discount");
            $this->session->set_flashdata('exception', lang('insertion_success'));
        } else {
            $this->Common_model->updateInformation($igc_info, $id, "tbl_discount");
            $this->session->set_flashdata('exception', lang('update_success'));
        }
            redirect('discount/discount');
        } else {
                if ($id == "") {
                    $data = array();
                    $data['master_menu'] = 'discount';
                    $data['sub_menu'] = '';
                    $data['main_content'] = $this->load->view('discount/addDiscount', $data, TRUE);
                    $this->load->view('userHome', $data);
                } else {
                    $data = array();
                    $data['master_menu'] = 'discount';
                    $data['sub_menu'] = '';
                    $data['encrypted_id'] = $encrypted_id;
                    $data['category_information'] = $this->Common_model->getDataById($id, "tbl_discount");
                    $data['main_content'] = $this->load->view('discount/editDiscount', $data, TRUE);
                    $this->load->view('discount/discount', $data);
                }
            }
        } else {
            if ($id == "") {
                $data = array();
                $data['master_menu'] = 'discount';
                $data['sub_menu'] = 'discount';

                $data['main_content'] = $this->load->view('discount/addDiscount', $data, TRUE);
                $this->load->view('userHome', $data);
            } else {
                $data = array();
                $data['master_menu'] = 'discount';
                $data['sub_menu'] = 'discount';

                $data['encrypted_id'] = $encrypted_id;
                $data['category_information'] = $this->Common_model->getDataById($id, "tbl_discount");
                $data['main_content'] = $this->load->view('discount/editDiscount', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }
    }
}
