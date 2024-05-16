<?php
	// Incluir classes
include 'classes/conexao.class.php';
include 'classes/contato.class.php';
	// Classe conexão
$conexao = new Conexao();
$pdo = $conexao->conectar();
	// Classe contato
$contato = new Contato($pdo);
	// Ações
$acao = (isset($_REQUEST['acao'])?$_REQUEST['acao']:null);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Agenda de contatos</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<link rel="shortcut icon" href="img/icone.png" />
</head>
<body class="bg-secondary">
	<nav class="nav nav-pills navbar navbar-dark bg-dark">
		<a class="navbar-brand" href="index.php">
			<img src="img/icone.png" width="40" height="40" class="d-inline-block align-top" alt="Agenda">
			<span style="font-size: 140%; font-family: sans-serif;">Agenda</span>
		</a>
		<nav class="nav nav-pills">
			<a class="nav-link active" href="index.php">Início</a>
			<a class="nav-link" href="inserirContato.php">Inserir Contato</a>
		</nav>
	</nav>
	<div class="container col-md-10 mt-3">
		<table class="table table-dark table-hover">
			<?php
			// Deletar Contato
			if ($acao == 'apagarContato') {
				$contato->apagarContato();
			}
			?>
			<thead>
				<tr>
					<th scope="col">Nome</th>
					<th scope="col">Email</th>
					<th scope="col">Telefone</th>
					<th scope="col">Foto</th>
					<th scope="col">Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				if ($contato->listarContatos() != null) {
					foreach ($contato->listarContatos() as $listar){
						echo "<tr>
						<th scope='row'>$listar->nome</th>
						<td scope='row'>$listar->email</td>
						<td scope='row'>$listar->telefone</td>";
						if($listar->foto == null){
							echo "<td scope='row'><img src='img/padrao.png' width='30' height='30'></td>";
						} else{
							echo "<td scope='row'><img src='$listar->foto' class='imgContLista'></td>";
						}
						echo "<td scope='row'>
						<a href='editarContato.php?acao=editarContato&idcontato=$listar->idcontato'><button type='button' class='btn btn-warning'>
						Editar
						</button></a>
						<a href='?acao=apagarContato&idcontato=$listar->idcontato'><button type='button' class='btn btn-danger'>
						Apagar
						</button></a>
						</td>
						</tr>";
					}
				} else{
					echo "<div class='alert alert-danger' scope='row'>Ainda não foram adicionados contatos ou todos os contatos foram excluídos!</div>";
				}				
				?>
			</tbody>
		</table>
	</div>
	<nav class="navbar navbar-dark bg-dark">
		<a class="navbar-brand" href="index.php">
			<img src="img/icone.png" width="40" height="40" class="d-inline-block align-top" alt="Agenda">
		</a>
		<span style="color: white; ">Sistema Agenda © <?php echo date('d/m/Y') ?></span>
		<nav class="nav nav-pills">
			<a class="nav-link" href="#"><img src="img/facebook.icon.png" width="25" height="25"></a>
			<a class="nav-link" href="#"><img src="img/instagram.icon.png" width="25" height="25"></a>
			<a class="nav-link" href="#"><img src="img/youtube.icon.png" width="25" height="25"></a>
		</nav>
	</nav>
</body>
<!-- jQuery -->
<script type="text/javascript" src="js/jquery.3.2.1.min.js"></script>
<!-- Bootstrap JS -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- "Esconder" DIV -->
<script type="text/javascript">
	setTimeout(function() {
		$('#aviso-cont').fadeOut('fast');
	}, 5000); // <-- time in milliseconds
</script>
</html>