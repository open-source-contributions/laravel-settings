<?php

namespace RaggiTech\Laravel\Settings;

use RaggiTech\Laravel\Settings\Settings;
use RaggiTech\Laravel\Settings\Traits\{Info, Relationships, Scopes};

trait hasSettings
{
    use Relationships, Scopes;

    public function __construct()
    {
        parent::__construct();
    }

    private function getSetting(string $name)
    {
        $setting = $this->settings->where('name', $name)->first();
        if (!$setting) return null;

        return $setting;
    }

    /**
     * Get Setting
     */
    public function setting(string ...$name)
    {
        $data = self::whereIn('name', $name);
        if (count($name) == 1) {
            $data = $data->first();
            if (!$data) return null;

            return $data->value;
        } else {
            return $data->get()->keyBy('name');
        }
    }

    /**
     * Create/Update Setting
     */
    public function setSetting($name, ?string $value = null)
    {
        if (is_array($name)) {
            foreach ($name as $n => $v) {
                $this->setSetting($n, $v);
            }

            return true;
        } else {
            $model  = $this->getSetting($name);

            if (!$model) {
                $obj = new Settings();
                $obj->user_id       = auth()->check() ? auth()->user()->id : null;
                $obj->model_type    = get_class($this);
                $obj->model_id      = $this->{$this->primaryKey};
                $obj->name          = $name;
                $obj->value         = $value;

                return $obj->save();
            } else {
                // Update
                return $model->update(['value' => $value]);
            }
        }
    }

    /**
     * Create/Update Settings
     */
    public function setSettings(array $settings)
    {
        foreach ($settings as $name => $value) {
            $this->setSetting($name, $value);
        }

        return true;
    }

    /**
     * Delete Setting
     */
    public function removeSetting(string $name)
    {
        $model  = $this->getSetting($name);
        if (!$model) return null;

        return $model->delete();
    }

    /**
     * Clear Settings
     */
    public function clearSettings()
    {
        return $this->settings()->delete();
    }
}
