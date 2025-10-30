<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use MongoDB\Laravel\Schema\Blueprint as MongoBlueprint;

return new class extends Migration {
    public function up(): void
    {
        Schema::connection('mongodb')->create('categories', function (MongoBlueprint $collection) {
            $collection->index('_id');
            $collection->string('name');
            $collection->string('description')->nullable();
            $collection->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
