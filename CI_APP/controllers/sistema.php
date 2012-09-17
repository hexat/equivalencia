<?php 
class Sistema extends CI_Controller {


	function __construct()
    {
        parent::__construct();
 
        $this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
 
    }
	
	public function index()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->view('login/tela_login');	
	}
	
	function inicio()
	{
		$this->load->view('inicial/tela_inicial');
	}
	
	function login()
	{
		$this->load->view('login/tela_login');
	}
	 function fazer_login()
	{
		 $login=$_POST['login'];
		 $senha=$_POST['senha'];
		 $op=$_POST['option'];
		 
		 $this->load->model('modelo_ifce');
			if($op == 0)
			{
				$ver = $this->modelo_ifce->Fazer_Login_Admin($login,$senha);
				if($ver)
				{
					$this->load->view('inicial/tela_inicial');
				}
				else
				{
					$this->load->view('login/tela_erro');
				}
			}
			elseif($op == 1)
			{
				$ver = $this->modelo_ifce->Fazer_Login_Coordenador($login,$senha);
				if($ver)
				{
					$this->load->view('inicial/tela_inicial');
				}
				else
				{
					$this->load->view('login/tela_erro');
				}
			}
			elseif($op==2)
			{
				$ver = $this->modelo_ifce->Fazer_Login_Bolsista($login,$senha);
				if($ver)
				{
					$this->load->view('inicial/tela_inicial_bolsista');
				}
				else
				{
					$this->load->view('login/tela_erro');
				}
			}
			else
			{
				$this->load->view('login/tela_erro');
			}
		 
		 
	}
	
	function exibir_disciplinas()
	{
		$crud = new grocery_CRUD();
	
		$crud->set_theme('datatables_2');
		$crud->set_table('disciplinaequivalente')
		->set_subject('Disciplina Externa')
		->columns('codigo','nome','curso','faculdade','ch','creditos');
		$crud->display_as('codigo', 'Código')
		->display_as('ch','Carga Horária')
		->display_as('creditos','Créditos');
	
	
		$crud->add_fields('codigo','nome','ch','creditos','faculdade','curso','arquivo');
	
		$crud->set_relation('faculdade','faculdade','faculdade_nome');
		$crud->set_relation('curso','curso','curso_nome');
	
		$crud->required_fields('codigo');
		$crud->set_field_upload('arquivo','uploads/disciplinas_externas/');
		$crud->add_action( 'Download Arquivo', 'http://localhost/code/assets/grocery_crud/themes/flexigrid/css/images/file.png','','',array($this,'uploadurlexternas'));
	
		$output = $crud->render();
	
		$dd_data = array(
				'dd_state' =>  $crud->getState(),
				'dd_dropdowns' => array('faculdade','curso'),
				'dd_url' => array('', site_url().'/sistema/pegar_curso/'),
				'dd_ajax_loader' => base_url().'ajax-loader.gif'
		);
		$output->dropdown_setup = $dd_data;
			
		$this->load->view('cadastro_disciplina/tela_cadastro_header');
		$this->load->view('cadastro_disciplina/tela_cadastro_topo');
		$this->resultado($output);
	}
	
	function exibir_disciplinasBolsista()
	{
        $crud = new grocery_CRUD();
		
		$crud->set_theme('datatables_2');
        $crud->set_table('disciplinaequivalente')
			->set_subject('Disciplina Equivalente')
			->columns('codigo','nome','curso','faculdade','ch','creditos');
		$crud->display_as('codigo', 'Código')
			 ->display_as('ch','Carga Horária')
			 ->display_as('creditos','Créditos');
		$crud->add_fields('codigo','nome','ch','creditos','faculdade','curso','arquivo');
		$crud->set_relation('faculdade','faculdade','faculdade_nome');
		$crud->set_relation('curso','curso','curso_nome');
		$crud->required_fields('codigo');
		$crud->set_field_upload('arquivo','uploads/');
		$crud->add_action( 'Download Arquivo', 'http://localhost/code/assets/grocery_crud/themes/flexigrid/css/images/file.png','','',array($this,'uploadurlexternas'));
        $crud-> unset_delete();
		$crud->unset_edit();
		 $output = $crud->render();
		 
		 $dd_data = array(
				'dd_state' =>  $crud->getState(),
				'dd_dropdowns' => array('faculdade','curso'),
				'dd_url' => array('', site_url().'/sistema/pegar_curso/'),
				'dd_ajax_loader' => base_url().'ajax-loader.gif'
			);
			$output->dropdown_setup = $dd_data;
			
		 
        $this->resultado_bolsista($output);                
	}
	
	function exibir_disciplinas_ifce()
	{
		$crud = new grocery_CRUD();
	
		$crud->set_theme('datatables_2');
		$crud->set_table('disciplina')
		->set_subject('Disciplina IFCE')
		->columns('codigo','nome','ch','creditospraticos','creditosteoricos');
		$crud->display_as('codigo', 'Código')
		->display_as('ch','Carga Horária')
		->display_as('creditosteoricos','Créditos Teóricos')
		->display_as('creditospraticos','Créditos Práticos');
	
	
		$crud->add_fields('codigo','nome','ch','creditospraticos','creditosteoricos','arquivo');
	
		$crud->required_fields('codigo');
		$crud->set_field_upload('arquivo','uploads/');
		$crud->add_action( 'Download Arquivo', 'http://localhost/code/assets/grocery_crud/themes/flexigrid/css/images/file.png','','',array($this,'uploadurlinternas'));
	
		$output = $crud->render();

		$this->load->view('cadastro_disciplina_ifce/tela_cadastro_header');
		$this->load->view('cadastro_disciplina_ifce/tela_cadastro_topo');
		$this->resultado($output);
	}
	
	function resultado($output = null)
	{
	
		$this->load->view('cadastro_disciplina/our_template',$output);
	}
	function resultado_bolsista($output = null)
	{
		$this->load->view('cadastro_disciplina/tela_cadastro_bolsista');
		$this->load->view('cadastro_disciplina/our_template',$output);
	}
	
	function pegar_curso()
	{
		$faculdade = $this->uri->segment(3);
		$faculdade = rawurldecode($faculdade);
	
	
		$this->db->select('id_faculdade')
		->from('faculdade')
		->like('faculdade_nome',$faculdade);
		$db = $this->db->get();
		foreach($db->result() as $row){
			$faculdade = $row->id_faculdade;
		}
	
		$this->db->select('id_curso,curso_nome')
		->from('curso')
		->where('faculdade_id', $faculdade);
		$db = $this->db->get();
	
		$array = array();
		foreach($db->result() as $row):
		$array[] = array("value" => $row->id_curso, "property" => $row->curso_nome);
		endforeach;
	
		echo json_encode($array);
		exit;
	}
	

	function uploadurlinternas($primary_key , $row)
	{
		return "http://localhost/code/uploads/disciplinas_internas/".$row->arquivo;
	}
	
	function uploadurlexternas($primary_key , $row)
	{
		return "http://localhost/code/uploads/disciplinas_externas/".$row->arquivo;
	}
	
	function equivalencia(){
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables_2');
		$crud->set_table('equivalencia')
		->columns('codigo_equivalencia','disciplinas_ifce','disciplinas_externas');
		$crud->display_as('codigo_equivalencia', 'Código de Equivalência')
			 ->display_as('disciplinas_ifce','Disciplina do IFCE')
			 ->display_as('disciplinas_externas','Disciplinas Externas');
		
		
		$crud->set_relation('disciplinas_ifce', 'disciplina', 'nome');
		$crud->set_relation('disciplinas_externas', 'disciplinaequivalente', '{nome}');
		
		$crud->unset_edit();
		$crud->unset_add();
		 
		$output = $crud->render();
	
		$this->load->view('cadastro_equivalencia/tela_equivalencia_header');
		$this->load->view('cadastro_equivalencia/tela_equivalencia_topo');
		$this->load->view('cadastro_equivalencia/equivalencia');
		$this->resultado($output);
	}
	
	function adcionar_equivalencia()
	{
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->set_table('disciplina')
		->set_subject('Equivalencia')
		->columns('codigo','nome','ch','creditosteoricos','creditospraticos');
		$crud->unset_add();
		$crud->unset_edit();
		$crud->unset_delete();
		$crud->add_action( 'Exibir Arquivo', 'http://localhost/code/assets/grocery_crud/themes/flexigrid/css/images/file.png','','',array($this,'uploadurlinternas'));
	
		$output = $crud->render();
	
		echo "<input id ='botaoDisciplinaIFCE' type='button' value='Selecionar Disciplinas' class='btn btn-success' onclick='delete_selected();'>";
		$this->load->view('cadastro_equivalencia/tela_equivalencia_header');
		$this->load->view('cadastro_equivalencia/tela_equivalencia_topo');
		$this->load->view('cadastro_equivalencia/msg_disciplinas');
		$this->resultado($output);
	}
	
	function delete_selection()
	{
		$selected = $_POST['selection'];
		$data = array('data' => $selected);
		$this->load->view('cadastro_equivalencia/tela_equivalencia_header');
		$this->load->view('cadastro_equivalencia/tela_equivalencia_topo');
		$this->load->view('cadastro_equivalencia/msg_disciplinas_2');
		$this->load->view('cadastro_equivalencia/intermediario_1',$data);
	}
	
	function segunda_parte()
	{
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->set_table('disciplinaequivalente')
		->set_subject('Equivalencia')
		->columns('codigo','nome','faculdade','curso','ch','creditos');
		$crud->set_relation('faculdade','faculdade','faculdade_nome');
		$crud->set_relation('curso','curso','curso_nome');
		
		$crud->unset_add();
		$crud->unset_edit();
		$crud->unset_delete();
		$crud->add_action( 'Exibir Arquivo', 'http://localhost/code/assets/grocery_crud/themes/flexigrid/css/images/file.png','','',array($this,'uploadurlexternas'));
	
		$output = $crud->render();
	
	
		$this->load->view('cadastro_equivalencia/tela_equivalencia_header');
		$this->load->view('cadastro_equivalencia/tela_equivalencia_topo');
		$this->load->view('cadastro_equivalencia/msg_disciplinas_3');
	
	
		$this->resultado($output);
		$disciplinas = $_POST['discilinas'];
	
		echo "<div style='position: absolute; top:27%; left:88%;'>";
		echo "<input type='button' value='Selecionar Disciplinas' onclick='delete_selected_new();' class='btn btn-success' >";
		echo "</div>";
		echo "<input type='hidden' name='disciplinas' value='$disciplinas' id='disciplinas'>";
	
	}
	
	function confirma_equivalencia()
	{
		$this->load->model('modelo_ifce');
		$codigosDExternas = $_POST['selection'];
		$codigosDIfce = $_POST['disciplinas'];
		
		$DExternas = $this->modelo_ifce->Pega_Disciplinas_Externas($codigosDExternas);
		$DIfce = $this->modelo_ifce->Pega_Disciplinas_Ifce($codigosDIfce);
		
		
		$data = array('externas' => $DExternas,'internas'=>$DIfce, 'codExternas' =>$codigosDExternas,'codInternas'=>$codigosDIfce);
		
		
		$this->load->view('cadastro_equivalencia/tela_equivalencia_header');
		$this->load->view('cadastro_equivalencia/tela_equivalencia_topo');
		$this->load->view('cadastro_equivalencia/resultado_equivalencia',$data);
		
		
	}
	
	function faz_equivalencia(){
		$this->load->model('modelo_ifce');
		$DIfce = $_POST['DInternas'];
		$DExternas = $_POST['DExternas'];
		$this->modelo_ifce->fazer_equivalencia(explode("|",$DExternas),explode("|",$DIfce));
		$this->sucesso();
		
	}
	
	function sucesso()
	{
		$this->load->view('cadastro_equivalencia/tela_equivalencia_header');
		$this->load->view('cadastro_equivalencia/tela_equivalencia_topo');
		$this->load->view('cadastro_equivalencia/sucesso');
	}
    
	function exibir_cursos()
	{
		
		$crud = new grocery_CRUD();
		
		$crud->set_theme('datatables_2');
		$crud->set_table('curso')
		->set_subject('Curso')
		->columns('curso_nome','faculdade_id','faculdade_campus','faculdade_contato');
		$crud->display_as('curso_nome', 'Curso')
			 ->display_as('faculdade_id','Faculdade')
			 ->display_as('faculdade_campus','Campus')
			 ->display_as('faculdade_contato','Contato');
		
		$crud->set_relation('faculdade_id', 'faculdade', 'faculdade_nome');
	
		$output = $crud->render();
		
		$this->load->view('cadastro_curso/tela_cadastro_header');
		$this->load->view('cadastro_curso/tela_cadastro_topo');
		$this->resultado($output);
		
		
	}
	
	
	function inicioBolsista()
	{
		$this->load->view('inicial/tela_inicial_bolsista');
	}
	
	}
	
	

?>
