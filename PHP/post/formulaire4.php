<?php

echo '<pre>'; print_r($_POST); echo '</pre>';

foreach($_POST as $indice => $valeur)
{
	echo $indice. '=>'.$valeur.'<br>';
}

?>