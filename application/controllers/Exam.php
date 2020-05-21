<?php

class Exam extends CI_Controller {

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
        redirect(site_url('exam/question'));
    }

    public function login() {
        if (isset($this->session->pemilos_cbt_login)) {
            redirect(site_url('exam/question'));
        }

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === TRUE) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->users_model->get($username);
            if (isset($user)) {
                if ($password === $user->password) {
                    $this->session->pemilos_cbt_login = $username;

                    if ($user->answers === '') {
                        $initial_answers = array();
                        $question_count = $this->questions_model->get_count();

                        for ($i = 0; $i < $question_count; $i++) {
                            $initial_answers[$i] = -1;
                        }

                        $initial_answers_str = implode(';', $initial_answers);
                        $this->users_model->set($username, array('answers' => $initial_answers_str));
                    }

                    redirect(site_url('exam/question'));
                } else {
                    $this->data['status'] = status_failure('Incorrect password');
                }
            } else {
                $this->data['status'] = status_failure('Username does not exist');
            }
        } else {
            if (validation_errors() !== '') {
                $this->data['status'] = status_failure(validation_errors());
            }
        }

        $this->render('templates/header');
        $this->render('exam/login');
        $this->render('templates/footer');
    }

    public function question($id = 0, $answer = NULL) {
        $this->login_check();

        $question = $this->questions_model->get($id);

        $user = $this->users_model->get($this->session->pemilos_cbt_login);
        if ($user->done == 1) {
            redirect(site_url('exam/finish'));
        }

        if (isset($question)) {
            if (isset($answer)) {
                $user = $this->users_model->get($this->session->pemilos_cbt_login);
                $answers = explode(';', $user->answers);
                $answers[$id] = $answer;
                $this->users_model->set($this->session->pemilos_cbt_login, array('answers' => implode(';', $answers)));
            }
        } else {
            die('Invalid question ID');
        }

        $user = $this->users_model->get($this->session->pemilos_cbt_login);
        $answers = explode(';', $user->answers);

        $this->data['question'] = $question;
        $this->data['choices'] = array('A', 'B', 'C', 'D', 'E');
        $this->data['question_count'] = $this->questions_model->get_count();
        $this->data['all_answers'] = $answers;

        $this->data['answered_count'] = 0;
        for ($i = 0; $i < $this->data['question_count']; $i++) {
            if ($answers[$i] != -1) {
                $this->data['answered_count']++;
            }
        }

        $this->render('templates/header');
        $this->render('exam/question');
        $this->render('templates/footer');
    }

    public function finish() {
        $this->login_check();

        $user = $this->users_model->get($this->session->pemilos_cbt_login);
        if ($user->done == 0) {
            $this->users_model->set($this->session->pemilos_cbt_login, array('done' => 1));
        }

        $this->render('templates/header');
        $this->render('exam/finish');
        $this->render('templates/footer');
    }

    public function logout() {
        if (isset($this->session->pemilos_cbt_login)) {
            unset($_SESSION['pemilos_cbt_login']);
            redirect(site_url('exam'));
        }
    }

    private function login_check() {
        if (!isset($this->session->pemilos_cbt_login)) {
            redirect(site_url('exam/login'));
        }
    }

    private function render($page) {
        $this->load->view($page, $this->data);
    }

}

?>
