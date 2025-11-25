<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
});
</script>

<template>
  <div>
    <Head title="StudyLog へようこそ" />

    <div class="auth-page">
      <div class="auth-card" style="max-width: 520px;">
        <div class="auth-card__header">
          <div class="auth-logo">
            StudyLog
          </div>
          <h1 class="auth-card__title">学習ログダッシュボード</h1>
          <p class="auth-card__subtitle">
            毎日の学習時間を記録して、ダッシュボードで可視化できる
            シンプルなWebアプリです。Laravel × Vue.js 練習用プロジェクト。
          </p>
        </div>

        <div class="mi-card__body" style="padding: 0;">
          <ul style="font-size: 0.85rem; color: #4b5563; margin-bottom: 1rem; padding-left: 1.1rem;">
            <li>学習ログ（日時 / カテゴリ / 時間 / メモ）の登録</li>
            <li>ダッシュボードで日別・カテゴリ別グラフを表示</li>
            <li>ログインユーザーごとにデータを管理</li>
          </ul>
        </div>

        <div style="display: flex; flex-direction: column; gap: 0.6rem; margin-top: 0.5rem;">
          <div v-if="canLogin" style="display: flex; gap: 0.5rem;">
            <Link
              :href="route('login')"
              class="mi-button mi-button--primary"
              style="flex: 1; justify-content: center;"
            >
              ログイン
            </Link>
            <Link
              v-if="canRegister"
              :href="route('register')"
              class="mi-button mi-button--ghost"
              style="flex: 1; justify-content: center;"
            >
              新規登録
            </Link>
          </div>

          <p class="auth-card__footer">
            Laravel {{ laravelVersion }} / PHP {{ phpVersion }} で動作中
          </p>
        </div>
      </div>
    </div>
  </div>
</template>
