<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $t) {
            $t->string('title_id')->nullable()->after('title');
            $t->text('summary_id')->nullable()->after('summary');
            $t->string('label_id')->nullable()->after('category');   // label kecil di kartu (versi Indonesia)
            $t->longText('content_id')->nullable()->after('content');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $t) {
            $t->dropColumn(['title_id', 'summary_id', 'label_id', 'content_id']);
        });
    }
};
