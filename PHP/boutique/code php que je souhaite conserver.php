<!--CE QUE J AI FAIT ET QUI FONCTIONNE Mais j'ai fait l'erreur de ne pas utiliser de formulaire. en effet, car on aurait pu recuprer la selection dans l'URL mais c'est risqué--
	  <?php if($produit['stock']>0): ?>
		  <select class="text-center">Quantité souhaitée: 
			<?php if($produit['stock']>5):					//la quantité est > à 5 ?>	
				<?php for($i=1;$i<6;$i++):?>
					<option><?=$i?></option>
				<?php endfor;?>	
		  <?php else:   									//quantité est < ou = à 5?>
				<?php for($i=1;$i<=$produit['stock'];$i++):?>
				<option><?=$i?></option>
				<?php endfor;?>
		  <?php endif?>
		  </select>  
	  <?php else: ?>    ATTENTION: Ne pas oublier les ':' apres le ELSE 
		  <p class="text-center"> Rupture de stock </p>
	  <?php endif ?>
-- FIN DE CE QUE J AI FAIT -->