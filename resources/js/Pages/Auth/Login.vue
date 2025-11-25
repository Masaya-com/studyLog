<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
  });
};
</script>

<template>
  <div>
    <Head title="ログイン" />

    <div class="auth-page">
      <div class="auth-card">
        <div class="auth-card__header">
          <div class="auth-logo">
            StudyLog
          </div>
          <h1 class="auth-card__title">ログイン</h1>
          <p class="auth-card__subtitle">
            学習ログダッシュボードに入るには、メールアドレスとパスワードを入力してください。
          </p>
        </div>

        <form @submit.prevent="submit">
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
              autocomplete="current-password"
            />
            <p v-if="form.errors.password" class="mi-error-message">
              {{ form.errors.password }}
            </p>
          </div>

          <div class="mi-field" style="flex-direction: row; align-items: center; gap: 0.4rem; margin-bottom: 1rem;">
            <input
              id="remember"
              type="checkbox"
              v-model="form.remember"
              style="width: 14px; height: 14px;"
            />
            <label for="remember" class="mi-label" style="margin-bottom: 0;">
              ログイン状態を保持する
            </label>
          </div>

          <div style="margin-top: 0.5rem; display: flex; justify-content: space-between; align-items: center; gap: .5rem;">
            <button
              type="submit"
              class="mi-button mi-button--primary"
              :disabled="form.processing"
              style="width: 100%; justify-content: center;"
            >
              ログイン
            </button>
          </div>
        </form>

        <div class="auth-card__footer">
          アカウントをお持ちでない方は
          <Link :href="route('register')" class="auth-link">新規登録</Link>
        </div>
      </div>
    </div>
  </div>
</template>
