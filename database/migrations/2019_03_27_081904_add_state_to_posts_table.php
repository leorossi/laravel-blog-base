<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStateToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('state')->after('body');
        });
        
        //
        $posts = \App\Post::all();
        foreach($posts as $post) {
            if($post->id % 2 === 0) {
                $post->state = 'draft';
            } else {
                $post->state = 'published';
            }
            $post->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('state');
        });
    }
}
