<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const submit = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
};
</script>

<template>
  <div>
    <Head title="新規登録" />

    <div class="auth-page">
      <div class="auth-card">
        <div class="auth-card__header">
          <div class="auth-logo">
            StudyLog
          </div>
          <h1 class="auth-card__title">アカウント作成</h1>
          <p class="auth-card__subtitle">
            学習ログを記録して、ダッシュボードで自分の成長を可視化しましょう。
          </p>
        </div>

        <form @submit.prevent="submit">
          <div class="mi-field">
            <label class="mi-label">名前</label>
            <input
              type="text"
              class="mi-input"
              v-model="form.name"
              autocomplete="name"
            />
            <p v-if="form.errors.name" class="mi-error-message">
              {{ form.errors.name }}
            </p>
          </div>

          <div class="mi-field">
            <label class="mi-label">メールアドレス</label>
            <input
              type="email"
              class="mi-input"
              v-model="form.email"
              autocomplete="email"
            />
            <p v-if="form.errors.email" class="mi-error-message">
              {{ form.errors.email }}
            </p>
          </div>

          <div class="mi-field">
            <label class="mi-label">パスワード</label>
            <input
              type="password"
              class="mi-input"
              v-model="form.password"
              autocomplete="new-password"
            />
            <p v-if="form.errors.password" class="mi-error-message">
              {{ form.errors.password }}
            </p>
          </div>

          <div class="mi-field">
            <label class="mi-label">パスワード（確認）</label>
            <input
              type="password"
              class="mi-input"
              v-model="form.password_confirmation"
              autocomplete="new-password"
            />
          </div>

          <div style="margin-top: 0.5rem;">
            <button
              type="submit"
              class="mi-button mi-button--primary"
              :disabled="form.processing"
              style="width: 100%; justify-content: center;"
            >
              アカウントを作成する
            </button>
          </div>
        </form>

        <div class="auth-card__footer">
          すでにアカウントをお持ちの方は
          <Link :href="route('login')" class="auth-link">ログイン</Link>
        </div>
      </div>
    </div>
  </div>
</template>
