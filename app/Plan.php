<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
      //
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'plans';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['code', 'description', 'type', 'airtime_duration', 'nominations', 'plan_duration'];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var arrayID
	 */
	protected $primaryKey = 'plan_id';

}
