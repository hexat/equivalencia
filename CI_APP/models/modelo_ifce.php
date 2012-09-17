<?php
	class Modelo_ifce extends CI_Model 
	{
	  function Fazer_Login_Admin($login,$senha){
		 $this->load->database();
		
		 $this->db->select('senhaadministrador');
		 $this->db->where('loginadministrador',$login);
		 $this->db->where('senhaadministrador',$senha);
		 $query = $this->db->get('administrador');
		 

		 if(!$query->result()){
			return false;
		 }
		 else
		 {
			return true;
		 }
	  }
	  
	  function Fazer_Login_Coordenador($login,$senha){
		 $this->load->database();
		
		 $this->db->select('senhacoordenador');
		 $this->db->where('logincoordenador',$login);
		 $this->db->where('senhacoordenador',$senha);
		 $query = $this->db->get('coordenador');
		 
		 
		 if(!$query->result()){
			return false;
		 }
		 else
		 {
			return true;
		 }
	  }
	  
	  function Fazer_Login_Bolsista($login,$senha){
		 $this->load->database();
		
		 $this->db->select('senhabolsista');
		 $this->db->where('loginbolsista',$login);
		 $this->db->where('senhabolsista',$senha);
		 $query = $this->db->get('bolsista');
		 
		if(!$query->result()){
			return false;
		 }
		 else
		 {
			return true;
		 } 
	   }
	   
	   function Pega_Disciplinas_Externas($codigos){
	   
	   $codigos = explode("|", $codigos);
		$i=0;
	   
	   foreach ($codigos as $valor)
	   {
	   		$this->db->select('nome');
	   		$this->db->where('codigo',$valor);
	   		$query = $this->db->get('disciplinaequivalente');
	   
	   				foreach($query->result() as $row)
	   				{
							$resultado[$i] = $row->nome;
	   				}
	   				$i++;
	   }
	   		return $resultado;
	   }
	   
	   function Pega_Disciplinas_Ifce($codigos){
	   
	   	$codigos = explode("|", $codigos);
	   	$i=0;
	   
	   	foreach ($codigos as $valor)
	   	{
	   		$this->db->select('nome');
	   		$this->db->where('codigo',$valor);
	   		$query = $this->db->get('disciplina');
	   
	   		foreach($query->result() as $row)
	   		{
	   			$resultado[$i] = $row->nome;
	   		}
	   		$i++;
	   	}
	   	return $resultado;
	   }
	   
	   function fazer_equivalencia($DExternas,$DIfce){
		$numDExternas = count($DExternas);
		$numDInternas = count($DIfce);
		$codigo = rand();
	   	
	   	for($j=0;$j<$numDInternas-1;$j++){
	   		for ($i = 0; $i < $numDExternas-1; $i++) {
	   			$data = array('disciplinas_ifce'=>$DIfce[$j],
	   					'disciplinas_externas'=>$DExternas[$i],
	   					'codigo_equivalencia'=>$codigo);
	   			$this->db->insert('equivalencia',$data);
	   			
	   		}
	   				
	   	}

	   	}
	   	
	   	
	   	
	   }
	   
	
?>
</body>

