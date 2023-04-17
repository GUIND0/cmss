<?php

use App\Models\Profil;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('profil_id');
            $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->string('matricule', 20)->nullable();
            $table->enum('genre', ['Homme', 'Femme']);
            $table->string('email', 100)->unique();
            $table->string('telephone', 100)->unique()->nullable();
            $table->string('adresse', 100)->nullable();
            $table->string('fonction', 255)->nullable();
            $table->string('photo', 255)->nullable();
            $table->string('password');
            $table->boolean('active')->nullable();
            $table->datetime('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->integer('count_login')->nullable()->default(0);
            $table->foreign('profil_id')->references('id')->on('profils')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
        // Insert some stuff
        DB::table('users')->insert(array([
            'id' =>(string) Str::uuid(),
            'profil_id' => Profil::first()->id,
            'nom' => 'Admin',
            'prenom' => 'Admin',
            'email'  => 'dev@mdcmali.com',
            'genre' => 'Homme',
            'password' => '$2y$10$jodK1.YfOjx8kPB.yTUmgujRJZwvYCf6gJZXXujVU/U5JXGRQ5/du',
            'last_login_at' => '2019-11-09 23:21:07',
            'last_login_ip' => '127.0.0.1',
            'active' => 1,'count_login' => '0','created_at' => '2020-06-16 11:05:16','updated_at' => '2020-06-16 11:05:16',
            'photo' => json_encode(''),
          ])
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
