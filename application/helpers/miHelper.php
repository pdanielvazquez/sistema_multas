<?php

function menu_principal($tipo_usuario, $pagina){
	?>
		<!-- Nav Item - Pages Collapse Menu -->
	      <li class="nav-item">
	        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
	          <i class="fas fa-fw fa-cog"></i>
	          <span>Multas</span>
	        </a>
	        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
	          <div class="bg-white py-2 collapse-inner rounded">
	            <h6 class="collapse-header">Custom Components:</h6>
	            <a class="collapse-item" href="buttons.html">Buttons</a>
	            <a class="collapse-item" href="cards.html">Cards</a>
	          </div>
	        </div>
	      </li>
	<?
}


?>