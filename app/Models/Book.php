<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function scopeWithReviewsCount(Builder $query, $from = null, $to = null): Builder | QueryBuilder{
        return $query->withCount(
            [
                'reviews' => fn (Builder $q) => $this->dateRangeFilter($q, $from, $to)
            ]);
    }

    public function scopeWithAvgRating(Builder $query, $from = null, $to = null): Builder | QueryBuilder{
        return  $query->withAvg([
            'reviews' => fn (Builder $q) => $this->dateRangeFilter($q, $from, $to)
        ],'rating');
    }

    public function scopeTitle(Builder $query, String $title): Builder{
        return $query->where('title','like','%'. $title .'%');
    }

    public function scopePopular(Builder $query, $from = null, $to = null): Builder{
        return $query->withReviewsCount()
            ->orderBy('reviews_count','DESC');
    }

    public function scopeHighestRated(Builder $query, $from = null, $to = null): Builder{
        return  $query->withAvgRating()
            ->orderBy('reviews_avg_rating','DESC');
    }

    public function scopeMinReviews(Builder $query, int $minReviews): Builder | QueryBuilder{
        return $query->having('reviews_count','>',$minReviews);
    }
    private function dateRangeFilter(Builder $query, $from = null, $to = null){
        if($from && !$to){
            $query->where('created_at', '>', $from);
        } elseif(!$from && $to){
            $query->where('created_at','<=', $to);
        }elseif( $from && $to){
            $query->whereBetween('created_at', [$from, $to]);
        }
    }

    public function scopePopularLastMonth(Builder $query): Builder | QueryBuilder{
        return $query->popular(now()->subMonth(), now())
        ->HighestRated(now()->subMonth(), now())
        ->minReviews(2);
    }

    public function scopePopularLast6Months(Builder $query): Builder | QueryBuilder{
        return $query->popular(now()->subMonths(6), now())
        ->HighestRated(now()->subMonths(6), now())
        ->minReviews(5);
    }

    public function scopeHighestRatedPopularLastMonth(Builder $query): Builder | QueryBuilder{
        return $query->popular(now()->subMonth(), now())
        ->HighestRated(now()->subMonth(), now())
        ->minReviews(2);
    }

    public function scopeHighestRatedPopularLast6Month(Builder $query): Builder | QueryBuilder{
        return $query->popular(now()->subMonths(6), now())
        ->HighestRated(now()->subMonths(6), now())
        ->minReviews(2);
    }
}
