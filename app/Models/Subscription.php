<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasFactory, HasAdvancedFilter, SoftDeletes, Auditable;

    public $table = 'subscriptions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'ref',
        'customer_id',
        'payment_plan_id',
        'status',
        'product_id',
        'currency',
    ];

    public const STATUS_SELECT = [
        'new'       => 'new',
        'canceled'  => 'canceled',
        'delivered' => 'canceled',
        'pending'   => 'pending',
    ];

    public $orderable = [
        'id',
        'ref',
        'customer.name',
        'customer.email',
        'payment_plan.name',
        'payment_plan.duration',
        'status',
        'product.name',
        'product.description',
        'product.price',
        'currency',
    ];

    public $filterable = [
        'id',
        'ref',
        'customer.name',
        'customer.email',
        'payment_plan.name',
        'payment_plan.duration',
        'status',
        'product.name',
        'product.description',
        'product.price',
        'currency',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentPlan()
    {
        return $this->belongsTo(PaymentPlan::class);
    }

    public function getStatusLabelAttribute($value)
    {
        return static::STATUS_SELECT[$this->status] ?? null;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
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
