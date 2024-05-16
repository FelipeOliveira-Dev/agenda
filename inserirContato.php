<?php
	// Incluir classes
	include 'classes/conexao.class.php';
	include 'classes/contato.class.php';
	// Classe conexão
	$conexao = new Conexao();
	$pdo = $conexao->conectar();
	// Classe contato
	$contato = new Contato($pdo);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Agenda de contatos</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="shortcut icon" href="img/icone.png" />
</head>
<body class="bg-secondary">
	<nav class="navbar navbar-dark bg-dark nav-pills">
		<a class="navbar-brand" href="index.php">
			<img src="img/icone.png" width="40" height="40" class="d-inline-block align-top" alt="Agenda">
			<span style="font-size: 140%; font-family: sans-serif;">Agenda</span>
		</a>
		<nav class="nav nav-pills">
			<a class="nav-link" href="index.php">Início</a>
			<a class="nav-link  active" href="inserirContato.php">Inserir Contato</a>
		</nav>
	</nav>
	<div class="container col-md-8 mt-3 bg-dark rounded" style="color: white;">
		<h1>Inserir novo contato</h1>
		<?php
			if (isset($_POST['inserirContato'])) {
				$contato->inserirContato();
			}
		?>
		<form action="" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="nome">Nome</label>
				<input type="text" class="form-control" id="nomeCont" name="nomeCont" placeholder="Nome">
			</div>
			<div class="form-group">
				<label for="email">E-mail</label>
				<input type="text" class="form-control" id="emailCont" name="emailCont" placeholder="E-mail">
			</div>
			<div class="row">
				<div class="form-group col">
					<label for="telefone">Telefone</label>
					<input type="text" class="form-control" id="telefoneCont" name="telefoneCont" placeholder="Telefone">
				</div>
				<div class="form-group col">
					<label>Foto do contato</label>
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="fotoCont" name="fotoCont">
						<label class="custom-file-label">Enviar Imagem</label>
					</div>
				</div>
			</div>	
			<button type="submit" class="btn btn-primary mb-3" name="inserirContato">Inserir</button>
		</form>
	</div>
	<nav class="navbar navbar-dark bg-dark mt-3 fixed-bottom">
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
<!-- Máscara js para inputs -->
<script type="text/javascript" src="js/jquery.mask.min.js"></script>
<script type="text/javascript" src="js/mascarafunc.js"></script>
<script type="text/javascript">
    mascara();
</script>
<!-- "Esconder" DIV -->
<script type="text/javascript">
	setTimeout(function() {
		$('#aviso-cont').fadeOut('fast');
	}, 5000); // <-- time in milliseconds
</script>
</html>