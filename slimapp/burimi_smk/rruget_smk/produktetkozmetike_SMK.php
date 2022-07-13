<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//require '../vendor/autoload.php';
//require 'db.php';

$app=new \Slim\App();
$app->options('/{routes:.+}', function ($Kerkesa, $Pergjigjja, $args) {
    return $Pergjigjja;
});
$app->add(function ($kerk, $rez, $tjetra) {
    $Pergjigjja = $tjetra($kerk, $rez);
    return $Pergjigjja
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

$app->get('/api/produktetkozmetike_smk', function (Request $Kerkesa, Response $Pergjigjja) {
    $sql = 'SELECT * FROM produktetkozmetike_smk';
	try{
		
		$db = new db();
		//COnnect 
		$db=$db->connect();
		
		$termi = $db->query($sql);
		$produktetkozmetike_smk = $termi->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($produktetkozmetike_smk);
		
	} catch(PDOException $e){
		echo '{"errori":{"mesazhi": '.$e->getMessage().'}';
	}
});
$app->get('/api/produktikozmetik_smk/{Id_SMK}', function (Request $Kerkesa, Response $Pergjigjja) {
	
	$Id_SMK = $Kerkesa->getAttribute('Id_SMK');
	
    $sql = "SELECT * FROM produktetkozmetike_smk WHERE Id_SMK  = '$Id_SMK'";
	try{
		
		$db = new db();
		//COnnect 
		$db=$db->connect();
		
		$termi = $db->query($sql);
		$produktikozmetik_smk = $termi->fetch(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($produktikozmetik_smk);
		
	} catch(PDOException $e){
		echo '{"errori":{"mesazhi": '.$e->getMessage().'}';
	}
});
$app->post('/api/produktikozmetik_smk/shto', function (Request $Kerkesa, Response $Pergjigjja) {
	
	$Klasifikimi_SMK = $Kerkesa->getParam('Klasifikimi_SMK');
	$Marka_SMK = $Kerkesa->getParam('Marka_SMK');
	$Emertimi_SMK = $Kerkesa->getParam('Emertimi_SMK');
	$Perberesit_SMK = $Kerkesa->getParam('Perberesit_SMK');
	$Perdorimi_SMK = $Kerkesa->getParam('Perdorimi_SMK');
	$Kombinimi_SMK = $Kerkesa->getParam('Kombinimi_SMK');
	$Vleresimi_SMK = $Kerkesa->getParam('Vleresimi_SMK');
	
    $sql = "INSERT INTO produktetkozmetike_smk (Klasifikimi_SMK,Marka_SMK, Emertimi_SMK, Perberesit_SMK, Perdorimi_SMK, Kombinimi_SMK,Vleresimi_SMK) 
	VALUES(:Klasifikimi_SMK, :Marka_SMK, :Emertimi_SMK, :Perberesit_SMK, :Perdorimi_SMK, :Kombinimi_SMK, :Vleresimi_SMK)";
	try{
		
		$db = new db();
		
		$db=$db->connect();
		
		$termi = $db->prepare($sql);
		$termi->bindParam(':Klasifikimi_SMK',$Klasifikimi_SMK);
		$termi->bindParam(':Marka_SMK',$Marka_SMK);
		$termi->bindParam(':Emertimi_SMK',$Emertimi_SMK);
		$termi->bindParam(':Perberesit_SMK',$Perberesit_SMK);
		$termi->bindParam(':Perdorimi_SMK',$Perdorimi_SMK);
		$termi->bindParam(':Kombinimi_SMK',$Kombinimi_SMK);
		$termi->bindParam(':Vleresimi_SMK',$Vleresimi_SMK);
		
		$termi->execute();
		echo'{"vrejm":{"mesazhi":"Produkti Kozmetik eshte Shtuar"}';
	} catch(PDOException $e){
		echo '{"errori":{"mesazhi": '.$e->getMessage().'}';
	}
});

$app->put('/api/produktikozmetik_smk/modifiko/{Id_SMK}', function (Request $Kerkesa, Response $Pergjigjja) {
	
	$Id_SMK = $Kerkesa->getAttribute('Id_SMK');
	$Klasifikimi_SMK= $Kerkesa->getParam('Klasifikimi_SMK');
	$Marka_SMK = $Kerkesa->getParam('Marka_SMK');
	$Emertimi_SMK = $Kerkesa->getParam('Emertimi_SMK');
	$Perberesit_SMK = $Kerkesa->getParam('Perberesit_SMK');
	$Perdorimi_SMK = $Kerkesa->getParam('Perdorimi_SMK');
	$Kombinimi_SMK = $Kerkesa->getParam('Kombinimi_SMK');
	$Vleresimi_SMK = $Kerkesa->getParam('Vleresimi_SMK');
    $sql = "UPDATE produktetkozmetike_smk SET
	Klasifikimi_SMK = :Klasifikimi_SMK,
	Marka_SMK = :Marka_SMK,
	Emertimi_SMK = :Emertimi_SMK,
	Perberesit_SMK = :Perberesit_SMK,
	Perdorimi_SMK = :Perdorimi_SMK,
	Kombinimi_SMK= :Kombinimi_SMK,
	Vleresimi_SMK = :Vleresimi_SMK
	WHERE Id_SMK = '$Id_SMK'";
	try{
		//Get db Object
		$db = new db();
		//COnnect 
		$db=$db->connect();
		$termi = $db->prepare($sql);
		$termi->bindParam(':Klasifikimi_SMK',$Klasifikimi_SMK);
		$termi->bindParam(':Marka_SMK',$Marka_SMK);
		$termi->bindParam(':Emertimi_SMK',$Emertimi_SMK);
		$termi->bindParam(':Perberesit_SMK',$Perberesit_SMK);
		$termi->bindParam(':Perdorimi_SMK',$Perdorimi_SMK);
		$termi->bindParam(':Kombinimi_SMK',$Kombinimi_SMK);
		$termi->bindParam(':Vleresimi_SMK',$Vleresimi_SMK);
		$termi->execute();
		echo'{"vrejte":{"mesazhi":"Produkti Kozmetik eshte Modifikuar"}';
	} catch(PDOException $e){
		echo '{"error":{"text": '.$e->getMessage().'}';
	}
});

$app->delete('/api/produktikozmetik_smk/fshi/{Id_SMK}', function (Request $Kerkesa, Response $Pergjigjja) {
	
	$Id_SMK = $Kerkesa->getAttribute('Id_SMK');
	
    $sql = "DELETE FROM produktetkozmetike_smk WHERE Id_SMK = '$Id_SMK'";
	try{
		//Get db Object
		$db = new db();
		//COnnect 
		$db=$db->connect();
		
		$termi = $db->prepare($sql);
		$termi->execute();
		echo'{"vrejte":{"mesazhi":"Produkti Kozmetik eshte fshire"}';
		
	} catch(PDOException $e){
		echo '{"errori":{"mesazhi": '.$e->getMessage().'}';
	}
});
