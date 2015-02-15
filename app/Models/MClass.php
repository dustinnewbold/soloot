<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Cache;

class MClass extends Model {

	protected $table = 'classes';
	protected $fillable = ['name'];

	public static function asArray() {
		return Cache::remember('classes', 60, function() {
			$classes = [];
			$dbclasses = MClass::all();

			foreach ( $dbclasses as $class ) {
				$classes[$class->id] = $class;
			}

			return $classes;
		});
	}
}
