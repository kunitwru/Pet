<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Videos extends Model
{
    use Sortable;
    protected $fillable = [
        'name', 'yt_str', 'status', 'source', 'video_id', 'view_count'
    ];

    public $sortable = ['id', 'name', 'source', 'status', 'created_at', 'view_count'];

}
