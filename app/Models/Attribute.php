<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Attribute extends Model
{
    protected $guarded = [''];

    protected $type = [
        1 =>[
            'name'  => 'Thương Hiệu',
            'class' => 'label label-primary'
        ],
        2 =>[
            'name'  => 'Dành Cho',
            'class' => 'label label-default'
        ],
        3 =>[
            'name'  => 'Chất Liệu',
            'class' => 'label label-danger'
        ],
        4 =>[
            'name'  => 'Loại Mặt',
            'class' => 'label label-success'
        ],
    ];

    public function getType()
    {
        return Arr::get($this->type, $this->atb_type, "[N\A]");
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'atb_category_id');
    }
}
