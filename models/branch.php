<?php

namespace models;

use DB;

class Branch {

	public static function add($parent_id = null) {
		$sql = is_numeric($parent_id)
			? "INSERT INTO `branches`(`parent_id`) VALUES (:parent_id)"
			: "INSERT INTO `branches`() VALUES ()";

		$bind = is_numeric($parent_id) ? [
			'parent_id' => $parent_id
		] : [];

		$res = DB::_exc_sql('branches', $sql, $bind, 'end_key', 'id'); // вернет id нововй ветки

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

	public static function getParentID($parent_id){
		$sql = "
			SELECT *
			FROM `branches`
			WHERE
				parent_id = :parent_id
		";
		$bind = [
			'parent_id' => $parent_id
		];

		$res = DB::_exc_sql('branches', $sql, $bind, 'fetch', 'parent_id');

		return $res;
	}

	public static function edit($id, $name, $val){
		$sql = "
			UPDATE `branches`
			SET
				{$name} = :val
			WHERE
				id = :id
		";
		$bind = [
			'val' => $val,
			'id' => $id
		];

		$res = DB::_exc_sql('branches', $sql, $bind);

		return $res;
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