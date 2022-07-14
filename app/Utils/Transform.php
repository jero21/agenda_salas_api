<?php

namespace App\Utils;

abstract class Transform {

	public function transformCollection(array $items) {
		return array_values(array_map([$this, 'transform'], $items));
	}

	public abstract function transform($item);
}
