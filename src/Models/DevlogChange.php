<?php

namespace Eihen\Devlog\Models;

use Eihen\Devlog\Contracts\DevlogChangeInterface;
use Eihen\Devlog\Traits\DevlogChangeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class DevlogChange extends Model implements DevlogChangeInterface
{
    use DevlogChangeTrait;

    protected $table;
    public $timestamps;

    public function __construct($attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('devlog.changes.table');
        $this->timestamps = Config::get('devlog.changes.timestamps?');
    }
}
