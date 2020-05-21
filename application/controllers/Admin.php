<?php

class Admin extends CI_Controller {

    private $data;

    public function __construct() {
        parent::__construct();

        $this->load->helper('form');
        $this->load->helper('url');

        $this->load->library('form_validation');
        $this->load->library('session');

        $this->load->model('questions_model');
        $this->load->model('users_model');
    }

    public function index() {
        $this->results();
    }

    public function auth() {
        if (isset($this->session->pemilos_cbt_admin)) {
            redirect(site_url('admin/results'));
        }

        if (!empty(ADMIN_PASSWORD)) {
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() === TRUE) {
                $password = $this->input->post('password');

                if (md5($password) === ADMIN_PASSWORD) {
                    $this->session->pemilos_cbt_admin = TRUE;
                    redirect(site_url('admin/results'));
                } else {
                    $this->data['status'] = status_failure('Password e salah cuk');
                }
            } else {
                if (validation_errors() !== '') {
                    $this->data['status'] = status_failure(validation_errors());
                }
            }
        } else {
            $this->data['status'] = 'Password e rung diganti karo admin e lur. Ngomongo admin e sek';
        }

        $this->render('templates/header');
        $this->render('admin/auth');
        $this->render('templates/footer');
    }

    public function results() {
        $this->auth_check();

        $users = $this->users_model->get_all();
        $questions = $this->questions_model->get_all();

        $results = array();
        foreach ($users as $user) {
            if (strlen($user->answers) > 0) {
                $answers = explode(';', $user->answers);

                $result_data = array();
                $result_data['username'] = $user->username;
                $result_data['full_name'] = $user->full_name;
                $result_data['num_corrects'] = 0;
                $result_data['num_incorrects'] = 0;
                $result_data['num_unanswered'] = 0;

                for ($i = 0; $i < count($questions); $i++) {
                    if ($answers[$i] == -1) {
                        $result_data['num_unanswered']++;
                    } else {
                        if ($answers[$i] == $questions[$i]->correct_answer) {
                            $result_data['num_corrects']++;
                        } else {
                            $result_data['num_incorrects']++;
                        }
                    }
                }

                $result_data['score'] = $result_data['num_corrects'] * 2;

                array_push($results, $result_data);
            }
        }

        $this->data['results'] = $results;

        $this->render('templates/header');
        $this->render('admin/results');
        $this->render('templates/footer');
    }

    public function logout() {
        unset($_SESSION['pemilos_cbt_admin']);
        redirect(site_url('admin'));
    }

    private function auth_check() {
        if (!isset($this->session->pemilos_cbt_admin)) {
            redirect(site_url('admin/auth'));
        }
    }

    private function render($page) {
        $this->load->view($page, $this->data);
    }

}

?>
