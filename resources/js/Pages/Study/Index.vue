<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { reactive } from 'vue';   // ★これが絶対必要！

const props = defineProps({
  logs: Object,
  filters: Object,
});

// フォーム
const form = reactive({
  from: props.filters.from || '',
  to: props.filters.to || '',
  category: props.filters.category || '',
});

// フィルタ実行
const applyFilter = () => {
  router.get(route('study.index'), form, {
    preserveState: true,
    preserveScroll: true,
  });
};

// フィルタ解除
const resetFilter = () => {
  form.from = '';
  form.to = '';
  form.category = '';

  router.get(route('study.index'), {}, {
    preserveState: true,
    preserveScroll: true,
  });
};
</script>



<template>
  <AuthenticatedLayout>

    <Head title="学習ログ一覧" />

    

    <div class="study-page">
      <div class="study-container">

        <section class="study-section">
          <!-- フィルタフォーム -->
          <article class="mi-card" style="margin-bottom: 1.2rem;">
            <div class="mi-card__body">
              <form @submit.prevent="applyFilter" class="study-filter-form">
                <div class="study-filter-form__row">

                  <div class="mi-field">
                    <label class="mi-label">開始日</label>
                    <input type="date" class="mi-input" v-model="form.from">
                  </div>

                  <div class="mi-field">
                    <label class="mi-label">終了日</label>
                    <input type="date" class="mi-input" v-model="form.to">
                  </div>

                  <div class="mi-field">
                    <label class="mi-label">カテゴリ</label>
                    <input type="text" class="mi-input" placeholder="例：Laravel" v-model="form.category">
                  </div>

                  <div class="mi-field mi-field--buttons">
                    <button type="submit" class="mi-button mi-button--primary">
                      フィルタ適用
                    </button>
                    <button type="button" class="mi-button mi-button--ghost" @click="resetFilter">
                      クリア
                    </button>
                  </div>

                </div>
              </form>
            </div>
          </article>

          <div class="mi-section-header">
            <div>
              <h1 class="mi-section-title">学習ログ一覧</h1>
              <p class="mi-section-caption">
                直近の学習ログを日付順に表示します。
              </p>
            </div>
            <div>
              <Link :href="route('study.create')" class="mi-button mi-button--primary">
              学習ログを追加
              </Link>
            </div>
          </div>

          <article class="mi-card">
            <div class="mi-card__body">
              <div class="study-table-wrapper">
                <table class="study-table">
                  <thead>
                    <tr>
                      <th>日付</th>
                      <th>カテゴリ</th>
                      <th class="study-table__th--right">時間（分）</th>
                      <th>メモ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="log in props.logs.data" :key="log.id">
                      <td>{{ log.date }}</td>
                      <td>
                        <span class="study-badge">{{ log.category }}</span>
                      </td>
                      <td class="study-table__cell--right">
                        {{ log.minutes }}
                      </td>
                      <td>{{ log.memo }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <!-- ページネーション（簡易） -->
              <div class="study-pagination" v-if="props.logs.links && props.logs.links.length">
                <Link v-for="link in props.logs.links" :key="link.label" :href="link.url || '#'" v-html="link.label"
                  class="study-pagination__link"
                  :class="{ 'study-pagination__link--active': link.active, 'study-pagination__link--disabled': !link.url }" />
              </div>
            </div>
          </article>
        </section>

      </div>
    </div>
  </AuthenticatedLayout>
</template>
