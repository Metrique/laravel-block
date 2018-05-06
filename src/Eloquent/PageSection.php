<?php

namespace Metrique\Building\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Metrique\Building\Eloquent\Page;
use Metrique\Building\Eloquent\Component;
use Metrique\Building\Eloquent\Traits\CommonAttributes;

class PageSection extends Model
{
    use CommonAttributes;

    protected $appends = ['parameters'];

    protected $fillable = [
        'id',
        'title',
        'slug',
        'order',
        'params',
        'pages_id',
        'components_id'
    ];

    public function page()
    {
        return $this->belongsTo(Page::class, 'pages_id');
    }

    public function component()
    {
        return $this->belongsTo(Component::class, 'components_id');
    }

    public function getParametersAttribute()
    {
        $json = json_decode($this->params);

        if (json_last_error() != JSON_ERROR_NONE) {
            return [
                'class' => []
            ];
        }

        return $json;
    }
}
