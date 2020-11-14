<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelationAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('user_profiles', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kelas_jurusan_id')->references('id')->on('kelas_jurusans')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('kelas_jurusans', function (Blueprint $table) {
            $table->foreign('kelas_id')->references('id')->on('kelas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('jurusan_id')->references('id')->on('jurusans')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
        });

        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropForeign(['kelas_id']);
            $table->dropForeign(['kelas_jurusan_id']);
        });

        Schema::table('kelas_jurusans', function (Blueprint $table) {
            $table->dropForeign(['kelas_id']);
            $table->dropForeign(['jurusan_id']);
        });
    }
}
