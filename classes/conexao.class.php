<?php
	Class Conexao{
		function conectar(){
			try{
				$pdo = new PDO("mysql:host=localhost; dbname=agenda", 'root', '');
				$pdo->exec('set names utf-8');
				return $pdo;
			}catch(PDOException $erro){
				echo "<div class='alert alert-danger'>Ocorreu um erro ao conectar-se ao banco de dados.</div>"+$erro;
			}
		}
	}
?>