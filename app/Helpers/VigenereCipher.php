<?php
namespace App\Helpers;

class VigenereCipher {

	private $key = 'budiluhur';

	// function to encrypt the text given
	public function encrypt($text)
	{
		// change key to lowercase for simplicity
		$this->key = strtolower($this->key);

		// intialize variables
		$code = "";
		$ki = 0;
		$kl = strlen($this->key);
		$length = strlen($text);

		// iterate over each line in text
		for ($i = 0; $i < $length; $i++)
		{
			// if the letter is alpha, encrypt it
			if (ctype_alpha($text[$i]))
			{
				// uppercase
				if (ctype_upper($text[$i]))
				{
					$text[$i] = chr(((ord($this->key[$ki]) - ord("a") + ord($text[$i]) - ord("A")) % 26) + ord("A"));
				}

				// lowercase
				else
				{
					$text[$i] = chr(((ord($this->key[$ki]) - ord("a") + ord($text[$i]) - ord("a")) % 26) + ord("a"));
				}

				// update the index of key
				$ki++;
				if ($ki >= $kl)
				{
					$ki = 0;
				}
			}
		}

		// return the encrypted code
		return $text;
	}

	// function to decrypt the text given
	public function decrypt($text)
	{
		// change key to lowercase for simplicity
		$this->key = strtolower($this->key);

		// intialize variables
		$code = "";
		$ki = 0;
		$kl = strlen($this->key);
		$length = strlen($text);

		// iterate over each line in text
		for ($i = 0; $i < $length; $i++)
		{
			// if the letter is alpha, decrypt it
			if (ctype_alpha($text[$i]))
			{
				// uppercase
				if (ctype_upper($text[$i]))
				{
					$x = (ord($text[$i]) - ord("A")) - (ord($this->key[$ki]) - ord("a"));

					if ($x < 0)
					{
						$x += 26;
					}

					$x = $x + ord("A");

					$text[$i] = chr($x);
				}

				// lowercase
				else
				{
					$x = (ord($text[$i]) - ord("a")) - (ord($this->key[$ki]) - ord("a"));

					if ($x < 0)
					{
						$x += 26;
					}

					$x = $x + ord("a");

					$text[$i] = chr($x);
				}

				// update the index of key
				$ki++;
				if ($ki >= $kl)
				{
					$ki = 0;
				}
			}
		}

		// return the decrypted text
		return $text;
	}
}
