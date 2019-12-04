<?php
namespace App\Helpers;

//$key picture campo del nombre file
//$path path donde queremos guardar en nuestro caso courses
class Helper {
	public static function uploadFile($key, $path) {
		request()->file($key)->store($path);
		return request()->file($key)->hashName();
	}
}