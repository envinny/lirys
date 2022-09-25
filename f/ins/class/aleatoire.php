<?php 

#la classe pour générer un nombre aleatoire
class aleatoire
{
	
	public function alea()
	{
		function make_seed() {
			list($usec, $sec) = explode(' ', microtime());
			return (float) $sec + ((float) $usec * 1000000);
			}
			srand(make_seed());
			$randval = rand();
			return $randval;
	}

	public function alea_2()
	{
		$characts = 'azertyuiopmlkjhgfdsqwxcvbn';
		$characts .= 'AZERTYUIOPMLKJHGFDSQWXCVBN'.
		$characts .= '1234567890';
		$code = '';

		for ($i=0; $i < 10; $i++) { 
			#10 est le nombre de caractères
			$code .= substr($characts, rand()%(strlen($characts)),1);
		}

		return $code;
	}
}

?>