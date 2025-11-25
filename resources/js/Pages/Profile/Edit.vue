<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
</script>

<template>
  <AuthenticatedLayout>
    <Head title="プロフィール" />

    <div class="study-page">
      <div class="study-container">

        <!-- 基本情報 -->
        <section class="study-section">
          <div class="mi-section-header">
            <div>
              <h1 class="mi-section-title">アカウント情報</h1>
              <p class="mi-section-caption">
                名前やメールアドレスなど、ログインに利用する基本情報を編集できます。
              </p>
            </div>
          </div>

          <article class="mi-card">
            <div class="mi-card__body">
              <UpdateProfileInformationForm />
            </div>
          </article>
        </section>

        <!-- パスワード変更 -->
        <section class="study-section">
          <div class="mi-section-header">
            <h2 class="mi-section-title">パスワードの変更</h2>
            <p class="mi-section-caption">
              セキュリティのため、定期的にパスワードを変更することをおすすめします。
            </p>
          </div>

          <article class="mi-card">
            <div class="mi-card__body">
              <UpdatePasswordForm />
            </div>
          </article>
        </section>

        <!-- アカウント削除 -->
        <section class="study-section">
          <div class="mi-section-header">
            <h2 class="mi-section-title">アカウントの削除</h2>
            <p class="mi-section-caption">
              すべての学習ログとユーザーデータが削除されます。この操作は元に戻せません。
            </p>
          </div>

          <article class="mi-card">
            <div class="mi-card__body">
              <DeleteUserForm />
            </div>
          </article>
        </section>

      </div>
    </div>
  </AuthenticatedLayout>
</template>
