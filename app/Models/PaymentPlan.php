<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentPlan extends Model
{
    use HasFactory, HasAdvancedFilter, SoftDeletes;

    public $table = 'payment_plans';

    protected $fillable = [
        'name',
        'duration',
    ];

    public $orderable = [
        'id',
        'name',
        'duration',
    ];

    public $filterable = [
        'id',
        'name',
        'duration',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const DURATION_SELECT = [
        'weekly'    => 'weekly',
        'biweekly'  => 'biweekly',
        'monthly'   => 'monthly',
        'quarterly' => 'quarterly',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getDurationLabelAttribute($value)
    {
        return static::DURATION_SELECT[$this->duration] ?? null;
    }

    public function getCreatedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function getUpdatedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function getDeletedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }
}
