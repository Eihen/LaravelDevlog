<?php

namespace Eihen\Devlog\Traits;

use Illuminate\Support\Facades\Config;

trait DevlogChangeTrait
{
    /**
     * Many-to-One relationship with the version model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function version()
    {
        return $this->belongsTo(
            Config::get('devlog.versions.model'),
            Config::get('devlog.changes.version_id'),
            Config::get('devlog.versions.id')
        );
    }
}
