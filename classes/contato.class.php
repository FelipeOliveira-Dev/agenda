<?php
Class Contato{
	function __construct($pdo){
		$this->pdo = $pdo;
	}
	function inserirContato(){
		try{
			//Receber dados do campo nome
			if (isset($_POST['nomeCont']) AND !empty($_POST['nomeCont'])) {
				$nomeCont = $_POST['nomeCont'];
			} else {
				throw new Exception("Erro ao captar campo nome!", 1);
			}
			//Receber dados do campo email
			if (isset($_POST['emailCont']) AND !empty($_POST['emailCont'])) {
				$emailCont = $_POST['emailCont'];
			} else {
				throw new Exception("Erro ao captar campo email!", 2);
			}
			//Receber dados do campo telefone
			if (isset($_POST['telefoneCont']) AND !empty($_POST['telefoneCont'])) {
				$telefoneCont = $_POST['telefoneCont'];
			} else {
				throw new Exception("Erro ao captar campo telefone!", 3);
			}
			//Receber dados do campo foto
			try{
				$arrayExtensao = array('png', 'jpg', 'jpeg', '');
				$path = $_FILES['fotoCont']['name'];
				$extensao = pathinfo($path, PATHINFO_EXTENSION);
				if(in_array($extensao, $arrayExtensao) === true){
					$renomear = time().".".$extensao;
					$diretorio = 'imagens/imgCont/';
					if(move_uploaded_file($_FILES['fotoCont']['tmp_name'], $diretorio.$renomear)){
						$locImg = $diretorio.$renomear;
					}else{
						$locImg = null;
					}
				}else{
					echo "<div class='alert alert-warning'>Extensão não suportada</div>";
				}
			} catch(Exception $e){
				$locImg = null;
			}
			
			//Inserção no banco de dados
			$inserirContato = $this->pdo->prepare("INSERT INTO contato (nome, email, telefone, foto) VALUES (:nome, :email, :telefone, :foto)");
			$inserirContato->bindValue(':nome', $nomeCont);
			$inserirContato->bindValue(':email', $emailCont);
			$inserirContato->bindValue(':telefone', $telefoneCont);
			$inserirContato->bindValue(':foto', $locImg);

			if ($inserirContato->execute()) {
				echo "<div class='alert alert-success col-md-5' id='aviso-cont'>
				Sucesso ao inserir novo contato!
				</div>";
			} else{
				echo "<div class='alert alert-danger col-md-5' id='aviso-cont'>
				Falha ao inserir novo contato!
				</div>";
			}
		} catch(Exception $erro){
			echo "<div class='alert alert-danger col-md-5' id='aviso-cont'>
			Houve um erro!
			</div>";
		}
	}

	function listarContatos(){
		try{
			$listarContatos = $this->pdo->prepare("SELECT * FROM contato");
			$listarContatos->execute();
			if ($listarContatos->rowCount() > 0) {
				return $listarContatos->fetchAll(PDO::FETCH_OBJ);
			} else{
				return null;
			}
		} catch(Exception $erro){
			echo $erro->getMesssage();
		}
	}

	function apagarContato(){
		try{
			if(isset($_GET['idcontato'])){
				$idcontato = $_GET['idcontato'];
			} else{
				throw new Exception("Não foi possível identificar o registro que você deseja excluir.", 5);
			}
			$excluirContato = $this->pdo->prepare('DELETE FROM contato WHERE idcontato = :idcontato');
			$excluirContato->bindValue(':idcontato', $idcontato);
			$excluirContato->execute();
			if($excluirContato->rowCount()){
				echo "<div class='alert alert-success col-md-5' id='aviso-cont'>
				Sucesso ao excluir contato!
				</div>";
			} else{
				echo "<div class='alert alert-danger col-md-5' id='aviso-cont'>
				Falha ao excluir contato!
				</div>";
			}
		} catch(Exception $erro){
			echo $erro->getMesssage();
		}
	}

	function listarContato($idcontato){
		$listarContato = $this->pdo->prepare('SELECT * FROM contato WHERE idcontato = :idcontato');
		$listarContato->bindValue(':idcontato',$idcontato);
		$listarContato->execute();
		if($listarContato->rowCount() > 0){
			return $listarContato->fetch(PDO::FETCH_OBJ);
		} else{
			return null;
		}
	}

	function atualizarContato(){
		try{
			//Receber ID
			if (isset($_POST['idcontato']) AND !empty($_POST['idcontato'])) {
				$idcontato = $_POST['idcontato'];
			} else {
				throw new Exception("Erro ao captar campo nome!", 1);
			}
			//Receber dados do campo nome
			if (isset($_POST['nomeCont']) AND !empty($_POST['nomeCont'])) {
				$nomeCont = $_POST['nomeCont'];
			} else {
				throw new Exception("Erro ao captar campo nome!", 1);
			}
			//Receber dados do campo email
			if (isset($_POST['emailCont']) AND !empty($_POST['emailCont'])) {
				$emailCont = $_POST['emailCont'];
			} else {
				throw new Exception("Erro ao captar campo email!", 2);
			}
			//Receber dados do campo telefone
			if (isset($_POST['telefoneCont']) AND !empty($_POST['telefoneCont'])) {
				$telefoneCont = $_POST['telefoneCont'];
			} else {
				throw new Exception("Erro ao captar campo telefone!", 3);
			}
			//Receber dados do campo foto(AINDA NÃO IMPLEMENTADO)
			// try{
			// 	$arrayExtensao = array('png', 'jpg', 'jpeg');
			// 	$path = $_FILES['fotoCont']['name'];
			// 	$extensao = pathinfo($path, PATHINFO_EXTENSION);
			// 	if(in_array($extensao, $arrayExtensao) === true){
			// 		$renomear = time().".".$extensao;
			// 		$diretorio = 'imagens/imgCont/';
			// 		if(move_uploaded_file($_FILES['fotoCont']['tmp_name'], $diretorio.$renomear)){
			// 			$locImg = $diretorio.$renomear;
			// 		}else{
			// 			$locImg = null;
			// 		}
			// 	}else{
			// 		echo "<div class='alert alert-warning'>Extensão não suportada</div>";
			// 	}
			// } catch(Exception $e){
			// 	$locImg = null;
			// }
			//Atualização no banco de dados
			$atualizarContato = $this->pdo->prepare("UPDATE contato SET nome=:nome, email = :email, telefone = :telefone WHERE idcontato = :idcontato");
			$atualizarContato->bindValue(':nome', $nomeCont);
			$atualizarContato->bindValue(':email', $emailCont);
			$atualizarContato->bindValue(':telefone', $telefoneCont);
			$atualizarContato->bindValue(':idcontato', $idcontato);
			if($atualizarContato->execute()){
				echo "<div class='alert alert-success col-md-5' id='aviso-cont'>
				Sucesso ao atualizar contato!
				</div>";
			} else{
				echo "<div class='alert alert-danger col-md-5' id='aviso-cont'>
				Falha ao atualizar contato!
				</div>";
			}
		} catch(Exception $erro){
			echo "<div class='alert alert-danger col-md-5' id='aviso-cont'>
			Houve um erro!
			</div>";
		}
	}
}
?>