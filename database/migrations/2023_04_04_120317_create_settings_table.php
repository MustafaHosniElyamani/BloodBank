<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('notification_setting_text');
			$table->string('about_app');
			$table->string('phone');
			$table->string('email');
			$table->string('insta_link');
			$table->string('fb_link');
			$table->string('tw_link');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}
