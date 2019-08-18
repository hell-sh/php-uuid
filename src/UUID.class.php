<?php
namespace hellsh;
use InvalidArgumentException;
class UUID
{
	/**
	 * The 16-byte binary string containing the UUID.
	 * @var string $binary
	 */
	public $binary;

	/**
	 * @param string $uuid A UUID string or 16-byte binary string.
	 * @throws InvalidArgumentException When the given string is not a valid UUID.
	 */
	function __construct(string $uuid)
	{
		if(strlen($uuid) == 16)
		{
			$this->binary = $uuid;
			return;
		}
		if(strlen($uuid) >= 32)
		{
			$uuid = str_replace(["-", "{", "}"], "", $uuid);
			if(strlen($uuid) == 32)
			{
				$this->binary = "";
				for($i = 0; $i < 32; $i += 2)
				{
					$this->binary .= chr(intval(hexdec(substr($uuid, $i, 2))));
				}
				return;
			}
		}
		throw new InvalidArgumentException("Invalid UUID: ".$uuid);
	}

	/**
	 * Generates a UUIDv4.
	 * @return UUID
	 */
	static function v4()
	{
		return new UUID(sprintf("%04x%04x%04x%04x%04x%04x%04x%04x", mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), (mt_rand(0, 0x0fff) | 0x4000), (mt_rand(0, 0x3fff) | 0x8000), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)));
	}

	/**
	 * Generates a UUIDv5.
	 * @param string $str
	 * @param UUID|null $namespace Defaults to NULL UUID.
	 * @return UUID
	 */
	static function v5($str, UUID $namespace = null)
	{
		if(!$namespace)
		{
			$namespace = new UUID(str_repeat(chr(0), 16));
		}
		$hash = sha1($str.$namespace->binary);
		return new UUID(sprintf("%08s%04s%04x%04x%12s", substr($hash, 0, 8), substr($hash, 8, 4), (hexdec(substr($hash, 12, 4)) & 0x0fff) | 0x5000, (hexdec(substr($hash, 16, 4)) & 0x3fff) | 0x8000, substr($hash, 20, 12)));
	}

	/**
	 * Returns the string representation of the UUID.
	 * @param boolean $withDashes
	 * @return string
	 */
	function toString($withDashes = false)
	{
		$str = "";
		for($i = 0; $i < 16; $i++)
		{
			if($withDashes && in_array($i, [4, 6, 8, 10]))
			{
				$str .= "-";
			}
			$sec = dechex(ord(substr($this->binary, $i, 1)));
			if(strlen($sec) != 2)
			{
				$sec = "0".$sec;
			}
			$str .= $sec;
		}
		return $str;
	}

	function __toString()
	{
		return $this->toString(true);
	}
}
