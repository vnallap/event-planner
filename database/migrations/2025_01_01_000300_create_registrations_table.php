<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use MongoDB\Laravel\Schema\Blueprint as MongoBlueprint;

return new class extends Migration {
    public function up(): void
    {
        Schema::connection('mongodb')->create('registrations', function (MongoBlueprint $collection) {
            $collection->index('_id');
            $collection->objectId('event_id');
            $collection->objectId('user_id');
            $collection->string('status')->default('pending');
            $collection->dateTime('registration_date');
            $collection->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
