<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('annonce_id');
            $table->index('status');
        });

        Schema::table('avis', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('reservation_id');
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['annonce_id']);
            $table->dropIndex(['status']);
        });

        Schema::table('avis', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['reservation_id']);
        });
    }
};