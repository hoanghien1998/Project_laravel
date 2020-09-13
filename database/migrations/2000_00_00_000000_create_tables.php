<?php

use App\Utils\DBUtils;
use Illuminate\Database\Migrations\Migration;

/**
 * Bulk create tables.
 */
class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $queries = DBUtils::parseMultiSqlFile(__DIR__ . '/basement/db_create.sql');
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
        $queries = DBUtils::parseMultiSqlFile(__DIR__ . '/basement/db_drop.sql');
        foreach ($queries as $query) {
            DB::statement($query);
        }
    }
}
