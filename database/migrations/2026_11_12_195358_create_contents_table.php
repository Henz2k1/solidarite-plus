<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();

            // Identifiant unique du contenu
            $table->string('content_key', 150)->unique();

            // Contenu à afficher
            $table->longText('content_value')->nullable();

            // Type : text, html, image, url, number...
            $table->string('type', 30)->default('text');

            // Page concernée : about, home, contact...
            $table->string('page', 50)->nullable()->index();

            // Activation du contenu
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
