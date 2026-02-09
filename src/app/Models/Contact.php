<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // 検索機能
    public function scopeKeywordSearch(Builder $query, ?string $keyword): Builder
    {
        if (empty($keyword)) {
            return $query;
        }

        $keyword = trim($keyword);
        $keywordNoSpace = preg_replace('/\s+/', '', $keyword);

        return $query->where(function ($q) use ($keyword, $keywordNoSpace) {
            $q->where('email', 'like', "%{$keyword}%")
              ->orWhere('last_name', 'like', "%{$keyword}%")
              ->orWhere('first_name', 'like', "%{$keyword}%")
              ->orWhereRaw(
                  "REPLACE(CONCAT(last_name, first_name), ' ', '') LIKE ?",
                  ["%{$keywordNoSpace}%"]
              );
        });
    }

    public function scopeGenderSearch(Builder $query, ?string $gender): Builder
    {
        if (empty($gender) || $gender === 'all') {
            return $query;
        }

        return $query->where('gender', $gender);
    }

    public function scopeCategorySearch(Builder $query, ?string $categoryId): Builder
    {
        if (empty($categoryId)) {
            return $query;
        }

        return $query->where('category_id', $categoryId);
    }

    public function scopeDateSearch(Builder $query, ?string $date): Builder
    {
        if (empty($date)) {
            return $query;
        }

        return $query->whereDate('created_at', $date);
    }
}
