<?php

namespace Eihen\Devlog\Contracts;

interface DevlogChangeInterface
{
    /**
     * Many-to-One relationship with change model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function version();
}
