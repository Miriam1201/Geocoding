<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubCategory extends Model
{
    /** @use HasFactory<\Database\Factories\SubCategoryFactory> */
    use HasFactory;

    protected $fillable = ['name', 'order', 'category_id', 'color', 'background', 'icon'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
