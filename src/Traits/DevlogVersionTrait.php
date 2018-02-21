<?php

namespace Eihen\Devlog\Traits;

use Illuminate\Support\Facades\Config;

trait DevlogVersionTrait
{
    /**
     * Many-to-One relationship with the version model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function changes()
    {
        return $this->hasMany(
            Config::get('devlog.changes.model'),
            Config::get('devlog.changes.version_id'),
            Config::get('devlog.versions.id')
        );
    }
}
