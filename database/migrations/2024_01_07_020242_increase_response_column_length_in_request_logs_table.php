<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */


 public function up()
    {
        Schema::table('request_logs', function (Blueprint $table) {
            $table->text('response')->change();
        });
    }

    public function down()
    {
        Schema::table('request_logs', function (Blueprint $table) {
            $table->string('response', 255)->change(); // Assuming it was VARCHAR(255) before
        });
    }

};
