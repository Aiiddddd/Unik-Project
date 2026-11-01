<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $guarded = [];

    protected $casts = [
        'gallery' => 'array',
        'is_published' => 'boolean',
    ];

    protected static function booted(): void
    {
        // slug dibuat otomatis dari judul dan dijamin unik
        static::saving(function (Project $p) {
            $base = Str::slug($p->slug ?: $p->title) ?: 'event';
            $slug = $base;
            $i = 2;
            while (static::where('slug', $slug)->where('id', '!=', $p->id ?? 0)->exists()) {
                $slug = $base.'-'.$i++;
            }
            $p->slug = $slug;
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished(Builder $q): Builder
    {
        return $q->where('is_published', true);
    }

    public function getCoverUrlAttribute(): string
    {
        return $this->cover ? asset('storage/'.$this->cover) : asset('images/about.jpg');
    }

    public function getGalleryUrlsAttribute(): array
    {
        return collect($this->gallery ?? [])->map(fn ($p) => asset('storage/'.$p))->values()->all();
    }

    /** Ambil field sesuai bahasa aktif; kalau terjemahan kosong, pakai versi Inggris. */
    public function tr(string $field): ?string
    {
        if (app()->getLocale() === 'id') {
            $map = ['title' => 'title_id', 'summary' => 'summary_id', 'category' => 'label_id', 'content' => 'content_id'];
            $v = isset($map[$field]) ? $this->{$map[$field]} : null;
            if (filled($v)) {
                return $v;
            }
        }

        return $this->{$field};
    }
}
