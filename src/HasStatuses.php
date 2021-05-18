<?php

namespace Alejandrotrevi\LaravelAnkal;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

trait HasStatuses
{
    public function scopeCurrentStatus(Builder $query, ...$names)
    {
        $names = is_array($names) ? Arr::flatten($names) : func_get_args();

        $query->where('status', $names);
    }

    public function scopeExceptStatus(Builder $query, ...$names)
    {
        $names = is_array($names) ? Arr::flatten($names) : func_get_args();

        $query->where('status', '!=', $names);
    }

    /**
     * Set the new model status, if the model has a
     *
     * @param  string       $name
     * @param  string|null  $reason
     * @return bool
     */
    public function setStatus(string $name, ?string $reason = null): bool
    {
//        if (! $this->isValidStatus($name, $reason)) {
//            return false;
//        }

        return $this->forceSetStatus($name, $reason);
    }

//    public function isValidStatus(string $name, ?string $reason = null): bool
//    {
//        return true;
//    }

    public function forceSetStatus(string $name, ?string $reason = null): bool
    {
        $this->status = $name;
        $this->reason = $reason;
        $this->status_updated_at = now();

        return $this->save();
    }
}
