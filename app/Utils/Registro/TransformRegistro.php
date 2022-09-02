<?php
namespace App\Utils\Registro;

use App\Utils\Transform;

class TransformRegistro extends Transform {
	public function transform($item) {
		$reporte = [
			'id' 			=> $item['id'],
			'start' 		=> $item['start'],
			'detail' 		=> $item['detail'],
			'color' 		=> $item['color'],
			'name' 			=> $item['name'] .  ' - ' . $item['sala'],
			'fiscal' 		=> $item['name'],
			'sala' 			=> $item['sala'],
		];

		return $reporte;
	}
}