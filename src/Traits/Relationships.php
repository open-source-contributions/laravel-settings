<?php

namespace RaggiTech\Laravel\Settings\Traits;

use RaggiTech\Laravel\Settings\Settings;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Relationships
{
    /**
     * Get List OF Settings
     */
    public function settings()
    {
        return $this->morphMany(Settings::class, 'model');
    }
}
