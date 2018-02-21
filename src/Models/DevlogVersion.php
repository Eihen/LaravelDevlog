<?php

namespace Eihen\Devlog\Models;

use Eihen\Devlog\Contracts\DevlogVersionInterface;
use Eihen\Devlog\Traits\DevlogVersionTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class DevlogVersion extends Model implements DevlogVersionInterface
{
    use DevlogVersionTrait;

    protected $table;
    public $timestamps;

    public function __construct($attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('devlog.versions.table');
        $this->timestamps = Config::get('devlog.versions.timestamps?');
    }
}
