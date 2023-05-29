<?php

namespace controllers\user;

\System::useModel('branch');

use models\Branch;

class index {

	public function main(){

		$branchs = Branch::getAll();

		return [
			'branchs' => $branchs
		];
	}
}