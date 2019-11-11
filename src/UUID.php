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
	 * Returns the NULL UUID, which has all 128 bits set to zero.
	 *
	 * @return UUID
	 * @since 1.2
	 */
	static function getNullUuid(): UUID
	{
		return new UUID(str_repeat("\0", 16));
	}

	/**
	 * Returns the namespace intended for fully-qualified domain names.
	 *
	 * @return UUID
	 * @since 1.2
	 */
	static function getDnsNamespace(): UUID
	{
		return new UUID("6ba7b8109dad11d180b400c04fd430c8");
	}

	/**
	 * Returns the namespace intended for URLs.
	 *
	 * @return UUID
	 * @since 1.2
	 */
	static function getUrlNamespace(): UUID
	{
		return new UUID("6ba7b8119dad11d180b400c04fd430c8");
	}

	/**
	 * Generates a UUIDv3.
	 *
	 * @since 1.2
	 * @param string $str
	 * @param UUID|null $namespace Defaults to NULL UUID.
	 * @return UUID
	 */
	static function v3(string $str, ?UUID $namespace = null): ?UUID
	{
		if($namespace === null)
		{
			$namespace = self::getNullUuid();
		}
		$hash = md5($namespace->binary.$str);
		return new UUID(sprintf("%08s%04s%04x%04x%12s", substr($hash, 0, 8), substr($hash, 8, 4), (hexdec(substr($hash, 12, 4)) & 0x0fff) | 0x3000, (hexdec(substr($hash, 16, 4)) & 0x3fff) | 0x8000, substr($hash, 20, 12)));
	}

	/**
	 * Generates a UUIDv4.
	 *
	 * @return UUID
	 */
	static function v4(): UUID
	{
		return new UUID(sprintf("%04x%04x%04x%04x%04x%04x%04x%04x", mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), (mt_rand(0, 0x0fff) | 0x4000), (mt_rand(0, 0x3fff) | 0x8000), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)));
	}

	/**
	 * Generates a UUIDv5.
	 *
	 * @param string $str
	 * @param UUID|null $namespace Defaults to NULL UUID.
	 * @return UUID
	 */
	static function v5(string $str, ?UUID $namespace = null): ?UUID
	{
		if($namespace === null)
		{
			$namespace = self::getNullUuid();
		}
		$hash = sha1($namespace->binary.$str);
		return new UUID(sprintf("%08s%04s%04x%04x%12s", substr($hash, 0, 8), substr($hash, 8, 4), (hexdec(substr($hash, 12, 4)) & 0x0fff) | 0x5000, (hexdec(substr($hash, 16, 4)) & 0x3fff) | 0x8000, substr($hash, 20, 12)));
	}

	/**
	 * Returns the string representation of the UUID.
	 *
	 * @param boolean $with_dashes
	 * @return string
	 */
	function toString(bool $with_dashes = false): string
	{
		$str = "";
		for($i = 0; $i < 16; $i++)
		{
			if($with_dashes && in_array($i, [4, 6, 8, 10]))
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

	/**
	 * Returns a hash code for this UUID.
	 *
	 * @since 1.1
	 * @return int
	 */
	function hashCode(): int
	{
		$hilo = gmp_xor(gmp_import(substr($this->binary, 0, 8)), gmp_import(substr($this->binary, 8)));
		$hashCode = gmp_xor(gmp_div($hilo, gmp_pow(2, 32)), gmp_mod($hilo, gmp_pow(2, 32)));
		if(gmp_cmp($hashCode, gmp_pow(2, 31)) >= 0)
		{
			$hashCode = gmp_sub($hashCode, gmp_pow(2, 32));
		}
		return gmp_intval($hashCode);
	}
}
