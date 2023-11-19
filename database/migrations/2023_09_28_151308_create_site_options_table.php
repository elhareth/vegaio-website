<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('site_options', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index('option_name');
            $table->text('label')->nullable();
            $table->longText('value')->nullable();
            $table->string('group', 20)->nullable();
            $table->boolean('autoload')->default(false);
            $table->unique([
                'name',
                'group',
            ], 'site_option');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_options');
    }
};
