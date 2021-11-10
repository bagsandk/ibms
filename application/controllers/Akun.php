<?php
class Akun extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function lupapassword()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Username', 'required|trim');
        if ($this->form_validation->run()) {
            $email =  $this->input->post('email');
            $cekakun = $this->db->get_where('tbl_user', ['email' => $email])->row_array();
            if ($cekakun) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'created_at' => time(),
                    'untuk' => 'reset',
                ];
                $this->load->library('Mail');
                if ($this->mail->_sendEmail('reset', $token, $email)) {
                    $this->db->insert('user_token', $user_token);
                    redirect('auth');
                } else {
                    redirect('akun/lupapassword');
                }
            } else {
                redirect('akun/lupapassword');
            }
        } else {
            $data['title'] = 'Lupa Password';
            $data['_view'] = 'lupapassword';
            $this->load->view('layouts/main', $data);
        }
    }
    function reset()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password1', 'Password', 'required|matches[password2]|trim', [
            'matches' => 'Password tidak sama!',
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim');
        if ($this->form_validation->run()) {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $this->db->where('email', $email);
            $u = $this->db->update('tbl_user', ['password' => $password]);
            if ($u) {
                $this->db->where('email', $email);
                $a = $this->db->delete('user_token');
            }
            redirect('auth');
        } else {
            // die;
            $user = $this->db->get_where('tbl_user', ['email' => $email])->row_array();
            if ($user) {
                $user_token = $this->db->get_where('user_token', ['token' => $token, 'untuk' => 'reset'])->row_array();
                if ($user_token) {
                    if (time() - $user_token['created_at'] < (60 * 60 * 60)) {
                        $data['link'] = 'email=' . $email . '&token=' . urlencode($token);
                        $data['title'] = 'Reset Password';
                        $data['_view'] = 'resetpassword';
                        $this->load->view('layouts/main', $data);
                    } else {
                        $this->db->where('token', $token);
                        $this->db->delete('user_token');
                        redirect('auth');
                    }
                } else {
                    redirect('auth');
                }
            } else {
                redirect('auth');
            }
        }
    }
    function verifikasi()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        if (!$email) {
            redirect('auth');
        }
        $user = $this->db->get_where('mahasiswa', ['email' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['created_at'] < (60 * 60 * 60)) {

                    $this->load->library('form_validation');

                    $this->form_validation->set_rules('jenis_kelamin', 'JK', 'required');
                    $this->form_validation->set_rules('tempat_lahir', 'tempat_lahirK', 'required');
                    $this->form_validation->set_rules('tanggal_lahir', 'tanggal_lahirK', 'required');
                    $this->form_validation->set_rules('alamat', 'alamatK', 'required');
                    $this->form_validation->set_rules('dosen', 'dosenK', 'required');
                    $this->form_validation->set_rules('agama', 'agamaaa', 'required');

                    if ($this->form_validation->run()) {
                        $params = array(
                            'tempat_lahir' => $this->input->post('tempat_lahir'),
                            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                            'alamat' => $this->input->post('alamat'),
                            'agama' => $this->input->post('agama'),
                            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                            'id_dosen' => $this->input->post('dosen'),
                        );
                        $this->load->model('Mahasiswa_model');
                        $this->Mahasiswa_model->update_mahasiswa($user['id_mhs'], $params);
                        $this->session->set_flashdata('message', '<div class="alert alert-dismissible bg-success text-white border-0 fade show text-capitalize" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Akun Anda berhasil di buat </div>');
                        $this->db->set('status_akun', '1');
                        $this->db->where('email', $email);
                        $this->db->update('mahasiswa');
                        $this->db->delete('user_token', ['email' => $email]);
                        $data = [
                            'email' => $user['email'],
                            'id_user' => $user['id_mhs'],
                            'foto' => $user['foto'],
                            'no_hp' => $user['no_hp'],
                            'nama' => $user['nama_mhs'],
                            'id_jurusan' => $user['id_jurusan'],
                            'role' => 'mahasiswa'
                        ];
                        $this->session->set_userdata($data);
                        redirect('auth');
                    } else {
                        $data['link'] = 'email=' . $email . '&token=' . urlencode($token);
                        $data['dosen'] = $this->db->get_where('dosen', ['id_jurusan' => $user['id_jurusan']])->result_array();
                        $data['_view'] = 'auth/lengkapidata';
                        $data['title'] = 'Lengkapi Data';
                        $this->load->view('layouts/main_login', $data);
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-dismissible bg-danger text-white border-0 fade show text-capitalize" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Waktu Habis</div>');
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->db->delete('mahasiswa', ['email' => $email]);
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-dismissible bg-danger text-white border-0 fade show text-capitalize" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Tidak ditemukan </div>');
                redirect('auth');
            }
        } else {
            redirect('auth');
        }
    }
    function profil()
    {
        if ($this->session->userdata('role') == 'mahasiswa') {
            $data['konsentrasi'] = $this->db->join('konsentrasi', 'konsentrasi.id_mkk = konsentrasi_pilihan.id_mkk')->get_where('konsentrasi_pilihan', ['id_mhs' => $this->session->userdata('id_user')])->row_array();
            $data['nilai_mhs'] = $this->db->join('matakuliah', 'matakuliah.id_mk = nilai_mk.id_mk')->get_where('nilai_mk', ['nilai_mk.id_mhs' => $this->session->userdata('id_user')])->result_array();
            $data['profil'] = $this->db->get_where('mahasiswa', ['email' => $this->session->userdata('email')])->row_array();
            $data['_view'] = 'profil';
            $data['matkul'] = $this->db->get_where('nilai_mk', ['id_mhs' => $data['profil']['id_mhs']])->row_array();
            $data['dosen'] = $this->db->join('dosen', 'dosen.id_dosen = mahasiswa.id_dosen')->get_where('mahasiswa', ['mahasiswa.email' => $this->session->userdata('email')])->row_array();
        } else if ($this->session->userdata('role') == 'admin') {
            $data['profil'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
            $data['_view'] = 'profila';
        } else if ($this->session->userdata('role') == 'dosen') {
            $data['mhs'] = $this->db->get_where('mahasiswa', ['id_dosen' => $this->session->userdata('id_user')])->result_array();
            $data['profil'] = $this->db->get_where('dosen', ['email' => $this->session->userdata('email')])->row_array();
            $data['_view'] = 'profilb';
        }
        $data['title'] = 'Profil';
        $this->load->view('layouts/main', $data);
    }
    function update()
    {
        $id = $this->session->userdata('id_user');
        if ($this->session->userdata('role') == 'mahasiswa') {
            $params = array(
                'nama_mhs' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'no_hp' => $this->input->post('hp'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'alamat' => $this->input->post('alamat'),
                'agama' => $this->input->post('agama'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            );
            $this->db->where('id_mhs', $id)->update('mahasiswa', $params);
        } else if ($this->session->userdata('role') == 'admin') {
            $params = array(
                'nama_admin' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'no_hp' => $this->input->post('hp'),
            );
            $this->db->where('id', $id)->update('admin', $params);
        } else if ($this->session->userdata('role') == 'dosen') {
            $params = array(
                'nama_dosen' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'no_hp' => $this->input->post('hp'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'alamat' => $this->input->post('alamat'),
                'agama' => $this->input->post('agama'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            );
            $this->db->where('id_dosen', $id)->update('dosen', $params);
        }
        $this->session->set_userdata('nama', $this->input->post('nama'));
        $this->session->set_userdata('email', $this->input->post('email'));
        $this->session->set_userdata('no_hp', $this->input->post('hp'));

        $this->session->set_flashdata('message', '<div class="alert alert-dismissible bg-success text-white border-0 fade show text-capitalize" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Profil Berhasil di Update </div>');
        redirect('akun/profil');
    }
    function changepass()
    {
        $id = $this->session->userdata('id_user');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('confirmpass', 'CConfirmpass', 'required|min_length[6]');
        $this->form_validation->set_rules('newpass', 'Newpass', 'required|min_length[6]');
        if ($this->form_validation->run()) {
            if ($this->input->post('newpass') != $this->input->post('confirmpass')) {
                $this->session->set_flashdata('message', '<div class="alert alert-dismissible bg-danger text-white border-0 fade show text-capitalize" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Password yang anda masukan tidak sama</div>');
                redirect('akun/profil');
            }
            $newpass =  password_hash($this->input->post('newpass'), PASSWORD_DEFAULT);
            $params = array(
                'password' => $newpass,
            );
            if ($this->session->userdata('role') == 'mahasiswa') {
                $this->db->where('id_mhs', $id)->update('mahasiswa', $params);
            } else if ($this->session->userdata('role') == 'admin') {
                $this->db->where('id', $id)->update('admin', $params);
            } else if ($this->session->userdata('role') == 'dosen') {
                $this->db->where('id_dosen', $id)->update('dosen', $params);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-dismissible bg-success text-white border-0 fade show text-capitalize" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Berhasil Ubah Password </div>');
            redirect('akun/profil');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-dismissible bg-danger text-white border-0 fade show text-capitalize" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Minimal 6 karakter </div>');
            redirect('akun/profil');
        }
    }
    function changephoto()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('photo', 'Photo', 'required');
        $id = $this->session->userdata('id_user');
        if ($this->session->userdata('role') == 'mahasiswa') {
            $user = $this->db->get_where('mahasiswa', ['id_mhs' => $id])->row_array();
        } else if ($this->session->userdata('role') == 'admin') {
            $user = $this->db->get_where('admin', ['id' => $id])->row_array();
        } else if ($this->session->userdata('role') == 'dosen') {
            $user = $this->db->get_where('dosen', ['id_dosen' => $id])->row_array();
        }
        if (isset($_FILES["foto"])) {
            $up_foto = $_FILES["foto"];
            $config['upload_path'] = './assets/images/profil/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '2000';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                $new = $this->upload->data('file_name');
                $foto_lama = $user['foto'];
                if ($foto_lama != 'default.png') {
                    unlink(FCPATH . 'assets/img/profile/' . $foto_lama);
                }
                if ($this->session->userdata('role') == 'mahasiswa') {
                    $this->db->where('id_mhs', $id)->update('mahasiswa', ['foto' => $new]);
                } else if ($this->session->userdata('role') == 'admin') {
                    $this->db->where('id', $id)->update('admin', ['foto' => $new]);
                } else if ($this->session->userdata('role') == 'dosen') {
                    $this->db->where('id_dosen', $id)->update('dosen', ['foto' => $new]);
                }
                $this->session->set_userdata('foto', $new);
                $this->session->set_flashdata('message', '<div class="alert alert-dismissible bg-success text-white border-0 fade show text-capitalize" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Foto berhasil di perbarui </div>');
                redirect('akun/profil');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-dismissible bg-danger text-white border-0 fade show text-capitalize" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' . $this->upload->display_errors() . ' </div>');
                redirect('akun/profil');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-dismissible bg-danger text-white border-0 fade show text-capitalize" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Gagall </div>');
            redirect('akun/profil');
        }
    }
}
