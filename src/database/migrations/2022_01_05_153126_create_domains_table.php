<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('domains', function (Blueprint $table) {
      $table->id();
      $table->integer('user_id');
      $table->string('name');
      $table->string('key');
      $table->integer('subdomain_id');
      $table->string('subdomain_name');
      $table->integer('ttl')->default(21600);
      $table->string('ip')->default('0.0.0.0');
      $table->string('status')->default('fail');
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
    Schema::dropIfExists('domains');
  }
}
