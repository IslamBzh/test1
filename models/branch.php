<?php

namespace models;

use DB;

class Branch {

	public static function new($parent_id, $name, $description){
		$params = [
			'name' => $name,
			'description' => $description
		];
		if($parent_id && $parent_id != 'null')
			$params['parent_id'] = $parent_id;
		$keys = array_keys($params);
		$sql = "
			INSERT INTO `branches`(" . implode(',', $keys) . ")
			VALUES (:" . (implode(',:', $keys)) . ")
		";

		$res = DB::_exc_sql('branches', $sql, $params);

		return $res;
	}

	public static function edit($branch_id, $parent_id, $name, $description){
		$bind = [
			'id' => $branch_id,
			'name' => $name,
			'description' => $description,
			'parent_id' => null
		];

		if($parent_id && $parent_id != 'null')
			$bind['parent_id'] = $parent_id;

		$sql = "
			UPDATE `branches`
			SET
				name = :name,
				description = :description,
				parent_id = :parent_id

			WHERE
				id = :id
		";

		$res = DB::_exc_sql('branches', $sql, $bind);

		return $res;
	}

	public static function getAll() {
		$sql_parents = "
			SELECT *
			FROM `branches`
			WHERE
				parent_id IS NULL
		";
		$sql_childs = "
			SELECT *
			FROM `branches`
			WHERE
				parent_id IS NOT NULL
		";

		$parents = DB::_exc_sql('branches', $sql_parents, [], 'fetch', 'id');
		$childs  = DB::_exc_sql('branches', $sql_childs, [], 'fetch', 'parent_id', true);

		return [
			'parents' => $parents,
			'childs' => $childs
		];
	}

	public static function getID($id){
		$sql = "
			SELECT *
			FROM `branches`
			WHERE
				id = :id
		";
		$bind = [
			'id' => $id
		];

		$res = DB::_exc_sql('branches', $sql, $bind, 'fetch');

		if(isset($res[0]))
			return $res[0];

		return null;
	}

	public static function del($id){
		$sql = "
			DELETE
			FROM `branches`
			WHERE
				id = :id
				OR
				parent_id = :id
		";
		$bind = [
			'id' => $id
		];

		$res = DB::_exc_sql('branches', $sql, $bind);

		return $res;
	}

}