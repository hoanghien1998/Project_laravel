<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReferenceUserListing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->integer('created_by')
                ->unsigned()
                ->index('fk_listing_user_id_idx');

            $table->foreign('created_by', 'fk_listing_user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('NO ACTION')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::table('listings', function (Blueprint $table) {
            $table->dropForeign('fk_listing_user_id');
            $table->dropColumn('created_by');
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
