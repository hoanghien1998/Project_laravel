<?php

use App\Utils\DBUtils;
use Illuminate\Database\Migrations\Migration;

class CreateTable20200914 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $queries = DBUtils::parseMultiSqlFile(__DIR__ . '/basement/db_create_20200914.sql');
        foreach ($queries as $query) {
            DB::statement($query);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        $queries = DBUtils::parseMultiSqlFile(__DIR__ . '/basement/db_drop_20200914.sql');
        foreach ($queries as $query) {
            DB::statement($query);
        }
    }
}
