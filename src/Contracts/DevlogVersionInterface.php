<?php

namespace Eihen\Devlog\Contracts;

interface DevlogVersionInterface
{
    /**
     * One-to-Many relationship with change model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function changes();
}
