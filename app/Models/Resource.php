<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Services\GeocodeService;


class Resource extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'sub_category_id',
        'address',
        'postal_code',
        'state_id',
        'city_id',
        'village',
        'phone_1',
        'phone_2',
        'email',
        'url',
        'latitude',
        'longitude',
        'images'
    ];

    protected $casts = [
        'images' => 'array',
    ];

    protected static function booted(): void
    {
        static::creating(function ($resource): void {
            $state = $resource->state;
            $city = $resource->city;

            if ($state && $city) {
                $geocodeService = app(GeocodeService::class);
                $coordinates = $geocodeService->getCoordinates($state->name, $city->name);

                $resource->latitude = $coordinates['latitude'];
                $resource->longitude = $coordinates['longitude'];
            }
        });

        static::updating(function ($resource): void {
            $state = $resource->state;
            $city = $resource->city;

            if ($state && $city) {
                $geocodeService = app(GeocodeService::class);
                $coordinates = $geocodeService->getCoordinates($state->name, $city->name);

                $resource->latitude = $coordinates['latitude'];
                $resource->longitude = $coordinates['longitude'];
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
