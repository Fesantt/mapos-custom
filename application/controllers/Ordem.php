<?php if (!defined('BASEPATH')) {

    exit('No direct script access allowed');
}

class Ordem extends CI_Controller
{
    /**
     * author: Ramon Silva
     * email: silva018-mg@yahoo.com.br
     *
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('os_model');
        $this->data['menuOs'] = 'OS';
    }

    //em desenvolvimento ******* SANTT *********** 
    // public function index()
    // {
    //     $this->CI = &get_instance();
    //     $this->CI->load->database();
    //     $this->load->model('mapos_model');
    //     $this->load->model('os_model');
    //     $this->data['pix_key'] = $this->CI->db->get_where('configuracoes', ['config' => 'pix_key'])->row_object()->valor;
    //     $this->data['custom_error'] = '';
    //     $token = $this->input->get('?'); // a url fica ??=token

    //     if ($token && strlen($token) === 8) {
    //         $this->data['result'] = $this->os_model->getByToken($token);
    //         if ($this->data['result']) {
    //             $this->data['produtos'] = $this->data['result']->produtos;
    //             $this->data['servicos'] = $this->os_model->getServicosByToken($token);
    //             $this->data['emitente'] = $this->mapos_model->getEmitente();
    //             $this->data['qrCode'] = $this->os_model->getQrCode(
    //                 $this->data['result']->idOs,
    //                 $this->data['pix_key'],
    //                 $this->data['emitente']
    //             );
    //             $this->load->view('ordem/ordem', $this->data);
    //         } else {
    //             $this->session->set_flashdata('error', 'Ordem de serviço não encontrada');
    //             redirect('mine/index');
    //         }
    //     } else {
    //         $this->session->set_flashdata('error', 'Ordem de Serviço não encontrada');
    //         redirect('mine/index');
    //     }
    // }

    // public function aprovarOs() {
    //     $tokenOs = $this->input->post('tokenOs');
    //     $data = ['status' => 'Aprovado'];
    //     $this->db->where('tokenOs', $tokenOs);
    //     $this->db->update('os', $data);
    //     redirect($_SERVER['HTTP_REFERER']);
    // }
    // em desenvolvimento ******* SANTT *********** 
    
    

    public function index()
    {
        $this->CI = &get_instance();
        $this->CI->load->database();
        $this->load->model('mapos_model');
        $this->load->model('os_model');
        $this->data['pix_key'] = $this->CI->db->get_where('configuracoes', ['config' => 'pix_key'])->row_object()->valor;
        $this->data['custom_error'] = '';
        $token = $this->input->get('os'); // a URL fica ?R=token
    
        if ($token && strlen($token) === 8) {
            $this->data['result'] = $this->os_model->getByToken($token);
            if ($this->data['result']) {
                $this->data['produtos'] = $this->data['result']->produtos;
                $this->data['anexos'] = $this->os_model->getAnexos($this->data['result']->idOs);
                $this->data['anotacoes'] = $this->os_model->getAnotacoes($this->data['result']->idOs);
                $this->data['servicos'] = $this->os_model->getServicosByToken($token);
                $this->data['emitente'] = $this->mapos_model->getEmitente();
                $this->data['qrCode'] = $this->os_model->getQrCode(
                    $this->data['result']->idOs,
                    $this->data['pix_key'],
                    $this->data['emitente']
                );
                $this->load->view('ordem/imprimirOrdem', $this->data);
                $enderecoIP = $_SERVER['REMOTE_ADDR']; 
                $new_annotation_data = [
                    'anotacao' => '[SYS]: Ordem de serviço acessada via token pelo IP:  '. $enderecoIP, 
                    'data_hora' => date('Y-m-d H:i:s'),
                    'os_id' => $this->data['result']->idOs
                     ];
                $this->os_model->addAnotacao($new_annotation_data);
            } else {
                $this->session->set_flashdata('error', 'Ordem de serviço não encontrada');
                redirect('mine/index');
            }
        } else {
            $this->session->set_flashdata('error', 'Ordem de Serviço não encontrada');
            redirect('mine/index');
        }
    }
    
//     public function calcula($id)
// {
//     $data['result'] = $this->os_model->valorTotalOS($id);

//     $this->load->view('ordem/ordem', $data);
// }

}