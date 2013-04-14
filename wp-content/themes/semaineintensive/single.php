<?php
	if (in_category('2')) {
		include (TEMPLATEPATH . '/single-film.php');
	} elseif (in_category('4')) {
		include (TEMPLATEPATH . '/single-jeunesse.php');
	} elseif (in_category('3')) {
		include (TEMPLATEPATH . '/single-serie.php');
	} else {
		include (TEMPLATEPATH . '/single-common.php');
	}
?>