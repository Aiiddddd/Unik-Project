<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $t) {
            $t->id();
            $t->string('title');
            $t->string('slug')->unique();
            $t->string('service', 40)->index();   // slug kategori di What we do
            $t->string('category')->nullable();   // label kecil di kartu
            $t->text('summary')->nullable();      // deskripsi singkat di kartu
            $t->string('cover')->nullable();      // path di disk public
            $t->longText('content')->nullable();  // isi halaman event (HTML)
            $t->json('gallery')->nullable();      // daftar path foto
            $t->string('client')->nullable();
            $t->string('period')->nullable();
            $t->string('location')->nullable();
            $t->boolean('is_published')->default(true);
            $t->unsignedInteger('sort_order')->default(0);
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
