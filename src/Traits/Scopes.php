<?php
namespace RaggiTech\Laravel\Settings\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Query\JoinClause;

trait Scopes{

    /**
     * Has no Settings
     */
    public function scopeWithoutSettings(Builder $query)
    {
        return $query->whereDoesntHave('settings');
    }

    /**
     * Has Settings
     */
    public function scopeWithSettings(Builder $query, string $name)
    {
        return $query->whereHas('settings', function (Builder $q) use ($name) {
            $q->where('name', $name);
        });
    }

    /**
     * Has Settings name & value
     */
    public function scopeWithSettingsValue(Builder $query, string $name, ?string $value = null)
    {
        return $query->whereHas('settings', function (Builder $q) use ($name, $value) {
            $q->where('name', $name)->where('value', $value);
        });
    }

    /**
     * Has OneOrMany Setting
     */
    public function scopeWithAnySettings(Builder $query, array $settings)
    {
        return $query->whereHas('settings', function (Builder $q) use ($settings) {
            $q->whereIn('name', $settings);
        });
    }

}