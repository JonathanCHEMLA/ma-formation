<?php

class Vehicule
{
	private $litre;
	private $reservoir;
	private $numero;
	
	
	public function setLitre($litre){
		$this->litre=$litre;
	}
	public function getLitre(){
		return $this->litre;
	}	
	
	
	public function setReservoir($res){
		$this->reservoir=$res;
	}
	public function getReservoir(){
		return $this->reservoir;
	}
	
	
	public function setNumero($num){
		$this->numero=$num;
	}
	public function getNumero(){
		return $this->numero;
	}

}
//------------
class Pompe
{
	private $litre;
	
	public function setLitre($litre){
		$this->litre=$litre;
	}
	public function getLitre(){
		return $this->litre;
	}	
	
	public function donneEssence(Vehicule $v){
		
		$pris_a_la_pompe= $v->getReservoir() - $v->getLitre();
		$plein = $v->getReservoir();
		$v->setLitre($plein);
		
		echo '<h3>Après ravitaillement du véhicule '. $v->getNumero() .'</h3>';
		//45 Litres pris à la pompe.
		echo $pris_a_la_pompe. ' Litres pris à la pompe.<br>';
		//50 Litres à présent dans le véhicule
		echo $plein.' Litres à présent dans le véhicule '. $v->getNumero() .'<br>';		
		$restant= $this->getLitre() - $pris_a_la_pompe;
		$this->litre=$restant;
		//755 Litres restant à la pompe.
		echo $restant . ' Litres restant à la pompe.<br><br>';
		
	}
}
//------------



$vehicule1 = new Vehicule();
$vehicule2 = new Vehicule();

$vehicule1->setNumero(1);
$vehicule2->setNumero(2);

$vehicule1->setReservoir(50);
echo 'Capacité max du véhicule: '. $vehicule1->getReservoir() . ' Litres. <br>';
$vehicule2->setReservoir(250);
echo 'Capacité max du véhicule: '. $vehicule2->getReservoir() . ' Litres. <br><br>';

$vehicule1->setLitre(5);
echo 'Nombre de litres dans le véhicule   '. $vehicule1->getNumero() .':   '. $vehicule1->getLitre() . ' Litres. <br>';
$vehicule2->setLitre(12);
echo 'Nombre de litres dans le véhicule   '. $vehicule2->getNumero() .':   '. $vehicule2->getLitre() . ' Litres. <br><br>';



$pompe = new Pompe();
$pompe->setLitre(800);
echo $pompe->getLitre() . ' Litres présents dans la pompe <br><br>';


echo $pompe->donneEssence($vehicule1);
echo $pompe->donneEssence($vehicule2);

// le '.' en jquery devient '->' en phpobjet
