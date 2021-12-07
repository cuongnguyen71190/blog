<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $params)
    {
        $date_from         = $params['date_from'];
        $date_to           = $params['date_to'];
        $status            = $params['status'];
        $only_date         = $params['only_date'];
        $baseDate          = '1970-01-01';

        if (isset($status)) {
            $query->where('status', '=', $status);
        }

        if (empty($only_date)) {
            if (($date_from == $baseDate && $date_to == $baseDate) || empty($date_from) && empty($date_to)) {
                return $query;
            } elseif ($date_from == $baseDate) {
                $query->whereDate('created_at', '<=', $date_to);
            } elseif ($date_to == $baseDate) {
                $query->whereDate('created_at', '>=', $date_from);
            } elseif ($date_to == $date_from) {
                $query->whereDate('created_at', $date_from);
            } else {
                $query->whereDate('created_at', '>=', $date_from)
                    ->whereDate('created_at', '<= ', $date_to);
            }

            return $query;
        }

        $query->whereDate('created_at', '=', $only_date);

        return $query;
    }
}
