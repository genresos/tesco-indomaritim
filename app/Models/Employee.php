<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'emp_id', 
        'emp_name',
        'join_date',
        'gender',
        'age',
        'family_status',
        'finger_id',
        'emp_status',
        'company_id',
        'division_id',
        'departmen_id',
        'branch_id',
        'position_id',
        'contract_from_date',
        'due_date',
        'permanent_date',
        'resign_date',
        'phone_number',
        'email',
        'note',
        'inactive'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}
