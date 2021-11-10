<?php
class Mail
{
    protected function ci()
    {
        return get_instance();
    }
    public function _sendEmail($apa, $token, $email)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'babarianmetal@gmail.com',
            'smtp_pass' => 'Bagagasyn1',
            'smtp_port' => 465,
            'smtp_crypto' => 'ssl',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE,
            'validate' => FALSE,
        ];
        $this->ci()->load->library('email', $config);
        // $this->ci()->load->initialize($config);
        $this->ci()->email->initialize($config);
        $this->ci()->email->set_newline("\r\n");
        $this->ci()->email->from('dhimas.gidan@gmail.com', 'Sistem pakar mata kuliah konsentrasi');
        $this->ci()->email->to($email);
        if ($apa == 'verifikasi') {
            $this->ci()->email->subject('Sistem pakar mata kuliah konsentrasi verifikasi');
            $this->ci()->email->message('Klik link untuk melakukan verifikasi akun : <a href="' . base_url('akun/verifikasi?email=' . $email . '&token=' . urlencode($token)) . '">Verifikasi Akun </a>');
        }else{
            $this->ci()->email->subject('Sistem pakar mata kuliah konsentrasi lupa password');
            $this->ci()->email->message('Klik link untuk melakukan reset password : <a href="' . base_url('akun/reset?email=' . $email . '&token=' . urlencode($token)) . '">Reset password </a>');
        }
        if ($this->ci()->email->send()) {
            return true;
        } else {
            return false;
        }
    }
}
