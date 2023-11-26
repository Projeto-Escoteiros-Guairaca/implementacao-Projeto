<?php
	if(isset($msgErro) and (trim($msgErro) != "")){
		echo("<div class='alert alert-danger msg'>" . $msgErro . "</div>");
	}

	if(isset($msgSucesso) and (trim($msgSucesso) != "")){
		echo("<div class='alert alert-success msg'>" . $msgSucesso . "</div>");
	}
?>