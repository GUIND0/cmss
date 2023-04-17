<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            
            $table->uuid('profil_id');
            $table->uuid('methode_id');

            $table->foreign('profil_id')->references('id')->on('profils')->onDelete('cascade');
            $table->foreign('methode_id')->references('id')->on('methodes')->onDelete('cascade');

            $table->primary(['profil_id', 'methode_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
