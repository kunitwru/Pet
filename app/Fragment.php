<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Fragment extends Model
{
    use HasTranslations;

    protected $translatable = ['text'];

    public static function getGroup(string $group, string $locale): array
    {
        return static::query()->where('key', 'LIKE', "{$group}.%")->get()
            ->map(function (Fragment $fragment) use ($locale, $group) {

                $key = preg_replace("/{$group}\\./", '', $fragment->key, 1);
                $text = $fragment->translate('text', $locale);

                return compact('key', 'text');

            })
            ->pluck('text', 'key')
            ->toArray();
    }
}
