<?php 
  class Api extends CI_Controller{
      public function __construct()
      {
          parent:: __construct();
          $this->load->model('api_model');
          $this->load->library('form_validation');
      }
      public function index()
      {
          $data = $this->api_model->fetch_all();
          echo json_encode($data->result_array());
      }

      public function insert()
      {
            $this->form_validation->set_rules('first_name', 'First Name', required);
            $this->form_validation->set_rules('last_name', 'Last Name', required);
            $this->form_validation->set_rules('email_name', 'Email ID', required);
            $this->form_validation->set_rules('password_name', 'Password', required);

            if($this->form_validation->run())
            {
               $data = array(
                'name' =>  $this->input->post('first_name'),
                'lastname' => $this->input->post('last_name'),
                'email' => $this->input->post('email_name'),
                'password' => $this->input->post('password_name'),
               );
               $this->api_model->insert_api($data);
               $array = array(
                   'success' =>true
               );  
            }
            else{
                 $array = array(
                     'error' => true,
                     'first_name_error' => form_error('first_name'),
                     'last_name_error' => form_error('last_name'),
                     'email_error' => form_error('email_name'),
                     'password_error' => form_error('password_name'),
                 );
            } 
            echo json_encode($array);

      }

  }
?>