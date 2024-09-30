<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('id_number', 20)->nullable(false);
            $table->date('date_of_birth')->nullable(false);
            $table->string('first_name', 100)->nullable(false);
            $table->string('last_name', 100)->nullable(false);
            $table->string('email', 191)->unique()->nullable(false);
            $table->string('telephone', 15)->nullable(false);
            $table->tinyInteger('status')->default(1)->nullable(false); // 0 for inactive, 1 for active
            $table->timestamps();
            $table->softDeletes();

            // Index for UUID for performance
            $table->index('uuid');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
