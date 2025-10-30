<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use MongoDB\Laravel\Schema\Blueprint as MongoBlueprint;

return new class extends Migration {
    public function up(): void
    {
        Schema::connection('mongodb')->create('events', function (MongoBlueprint $collection) {
            $collection->index('_id');
            $collection->string('title');
            $collection->string('description');
            $collection->objectId('category_id');
            $collection->string('location');
            $collection->dateTime('start_at');
            $collection->dateTime('end_at');
            $collection->string('banner_path')->nullable();
            $collection->objectId('created_by');
            $collection->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
