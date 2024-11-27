<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    protected $fillable = [
        'name',
        'status',
        'parent_id'
    ];

    public function parent() : BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    public function child() : HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function hasParent() : bool
    {
        return $this->parent_id != null;
    }

    public function hasChild(): bool
    {
        return $this->child->count() > 0;
    }

    public function hierarchyName()
    {
        $names = [];
        $curernt = $this;
        do {
            $names[] = $curernt->name;
            $curernt = $curernt->parent ?? null;
        } while(!empty($curernt));

        return implode(" > ", array_reverse($names));
    }
}
