<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminAlertsTable extends Migration
{
    public function up()
    {
        Schema::create('admin_alerts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
             $table->enum('role',['admin','user'])->default('user');
             $table->unsignedBigInteger('group_id')->nullable();
          $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->string('status');
            $table->rememberToken();
            $table->timestamps();


        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_alerts');
    }
}
