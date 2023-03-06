<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('votes', function( Blueprint $table) {
            $table->dropForeign('post_id');
            $table->dropForeign('user_id');
        });
        // DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('votes');
        // DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
