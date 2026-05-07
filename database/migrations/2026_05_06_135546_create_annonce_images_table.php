<?php

use App\Models\Annonce;
use App\Models\AnnonceImage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('annonce_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('annonce_id')->constrained()->onDelete('cascade');
            $table->string('path');
            $table->unsignedInteger('position')->default(0);
            $table->timestamps();

            $table->index(['annonce_id', 'position']);
        });

        Annonce::whereNotNull('image')->each(function ($annonce) {
            AnnonceImage::create([
                'annonce_id' => $annonce->id,
                'path'       => $annonce->image,
                'position'   => 0,
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('annonce_images');
    }
};
