<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection(config('tenancy.central_connection'))
            ->create('tenants', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('domain')->unique();
                $table->string('logo')->nullable();
                $table->jsonb('data')->nullable();
                $table->timestamps();
            });
    }

    public function down(): void
    {
        Schema::connection(config('tenancy.central_connection'))
            ->dropIfExists('tenants');
    }
};
