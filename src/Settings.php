<?php

namespace RaggiTech\Laravel\Settings;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'model_type', 'model_id', 'name', 'value'];

    /**
     * Get Settings Value
     */
    public static function get(?string ...$name)
    {
        if (empty($name)) return self::where('model_type', null)->where('model_id')->get()->keyBy('name');

        $data = self::whereIn('name', $name)->where('model_type', null)->where('model_id');
        return count($name) == 1 ? $data->first() : $data->get()->keyBy('name');
    }

    /**
     * Set Settings Values
     */
    public static function set($name, ?string $value = null)
    {
        if (is_array($name)) {
            foreach ($name as $n => $v) {
                self::set($n, $v);
            }

            return true;
        } else {
            $model  = self::where('name', $name)->where('model_type', null)->where('model_id')->first();

            if (!$model) {
                $obj = new Settings();
                $obj->user_id       = auth()->check() ? auth()->user()->id : null;
                $obj->model_type    = null;
                $obj->model_id      = null;
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
     * Deleting Setting
     */
    public static function remove(string $name)
    {
        $model  = self::where('name', $name)->where('model_type', null)->where('model_id')->first();
        return $model->delete();
    }

    /**
     * Clearing Settings
     */
    public static function clear()
    {
        return self::where('model_type', null)->where('model_id', null)->delete();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function model()
    {
        return $this->morphTo();
    }
}
