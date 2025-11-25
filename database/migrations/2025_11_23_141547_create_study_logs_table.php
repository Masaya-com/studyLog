<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('study_logs', function (Blueprint $table) {
            $table->id();
            // Breezeのusersテーブルと紐づけ（ユーザーが消えたらログも削除）
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->date('date');                  // 学習した日
            $table->string('category', 100);       // カテゴリ（Laravel / Vue など）
            $table->unsignedInteger('minutes');    // 学習時間（分）
            $table->text('memo')->nullable();      // メモ（任意）

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_logs');
    }
};
