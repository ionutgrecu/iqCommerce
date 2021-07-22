<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel {

    public static function getPossibleEnumValues($name) {
        $instance = new static; // create an instance of the model to be able to get the table name
        $type = DB::select(DB::raw('SHOW COLUMNS FROM ' . $instance->getTable() . ' WHERE Field = "' . $name . '"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach (explode(',', $matches[1]) as $value) {
            $v = trim($value, "'");
            $enum[] = $v;
        }
        return $enum;
    }

    public function fill(array $attributes) {\Log::info($attributes);
        foreach ($attributes as $key => $value)
            if ($value === 'null')
                unset($attributes[$key]);

            parent::fill($attributes);
    }

    public function toArray() {
        $array = parent::toArray();

        foreach ($this->getMutatedAttributes() as $key)
            if (!array_key_exists($key, $array))
                $array[$key] = $this->{$key};

        return $array;
    }

    /**
     * Determine if the model or any of the given attribute(s) have been modified and save to db
     *
     * @param  array|string|null  $attributes
     * @return bool
     */
    public function saveIfDirty($attributes = null) {
        $isDirty = $this->isDirty($attributes);dd($isDirty);
        if ($isDirty)
            $this->save();

        return $isDirty;
    }

}
