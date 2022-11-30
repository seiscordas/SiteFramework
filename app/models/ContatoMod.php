<?php
class ContatoModel extends CI_Model {

        public function __construct()
        {
                parent::__construct();
				$this->load->helper('email');
        }

        public function envia()
        {
			$de = $this->input->post('email');
			if (valid_email($de))
			{				
				$nome    = $this->input->post('nome');
				$para    = 'site.com.br';
				$assunto = $this->input->post('assunto');
				
				$msg .= "Mensagem do site<br>";
				$msg .= "Nome: " . $nome . "<br>";
				$msg .= "Mensagem:<br>";
				$msg .= $this->input->post('mensagem');
				
				$this->load->library('email');
				
				$this->email->from($de, $nome);
				$this->email->to('someone@example.com');
				//$this->email->cc('another@another-example.com');
				//$this->email->bcc('them@their-example.com');
				
				$this->email->subject($assunto);
				$this->email->message($msg);
				
				$this->email->send();			
			}
			else
			{
				echo 'email inválido!';
			}
			
        }
}
