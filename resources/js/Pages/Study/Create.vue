<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
  date: '',
  category: '',
  minutes: '',
  memo: '',
});

const submit = () => {
  form.post(route('study.store'));
};
</script>

<template>
  <AuthenticatedLayout>
    <Head title="学習ログ登録" />

    <div class="study-page">
      <div class="study-container">

        <section class="study-section">
          <div class="mi-section-header">
            <h1 class="mi-section-title">学習ログを追加</h1>
            <p class="mi-section-caption">
              その日の勉強をさっとメモしておくだけで、あとから振り返りやすくなります。
            </p>
          </div>

          <article class="mi-card">
            <div class="mi-card__body">
              <form class="study-form" @submit.prevent="submit">
                <div class="study-form__grid">
                  <div class="mi-field">
                    <label class="mi-label">
                      日付 <span class="mi-label__required">必須</span>
                    </label>
                    <input type="date" class="mi-input" v-model="form.date" />
                    <p v-if="form.errors.date" class="mi-error-message">
                      {{ form.errors.date }}
                    </p>
                  </div>

                  <div class="mi-field">
                    <label class="mi-label">
                      カテゴリ <span class="mi-label__required">必須</span>
                    </label>
                    <input
                      type="text"
                      class="mi-input"
                      v-model="form.category"
                      placeholder="例：Laravel / Vue / Spring / ブログ執筆 など"
                    />
                    <p v-if="form.errors.category" class="mi-error-message">
                      {{ form.errors.category }}
                    </p>
                  </div>

                  <div class="mi-field">
                    <label class="mi-label">
                      学習時間（分） <span class="mi-label__required">必須</span>
                    </label>
                    <input
                      type="number"
                      min="1"
                      class="mi-input mi-input--short"
                      v-model="form.minutes"
                      placeholder="例：60"
                    />
                    <p v-if="form.errors.minutes" class="mi-error-message">
                      {{ form.errors.minutes }}
                    </p>
                  </div>

                  <div class="mi-field mi-field--full">
                    <label class="mi-label">メモ（任意）</label>
                    <textarea
                      rows="3"
                      class="mi-textarea"
                      v-model="form.memo"
                      placeholder="今日はLaravelのバリデーション周りを重点的に復習した など"
                    ></textarea>
                    <p v-if="form.errors.memo" class="mi-error-message">
                      {{ form.errors.memo }}
                    </p>
                  </div>
                </div>

                <div class="study-form__actions">
                  <button
                    type="submit"
                    class="mi-button mi-button--primary"
                    :disabled="form.processing"
                  >
                    学習ログを登録する
                  </button>
                </div>
              </form>
            </div>
          </article>
        </section>

      </div>
    </div>
  </AuthenticatedLayout>
</template>
