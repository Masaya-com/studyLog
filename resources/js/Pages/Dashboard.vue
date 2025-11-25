<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import BarChart from '@/Components/Charts/BarChart.vue';
import PieChart from '@/Components/Charts/PieChart.vue';

/* props を必ず先に宣言する！！ */
const props = defineProps({
  daily: Array,
  byCategory: Array,
  totalMinutes: Number,
  period: Object,
});

/* ↓ props を受け取ってから map を使う */
const dailyLabels = props.daily.map(d => d.date);
const dailyValues = props.daily.map(d => d.minutes);

const categoryLabels = props.byCategory.map(c => c.category);
const categoryValues = props.byCategory.map(c => c.minutes);

/* 合計時間（時間換算） */
const totalHours = computed(() =>
  props.totalMinutes ? (props.totalMinutes / 60).toFixed(1) : '0.0'
);
</script>

<template>
  <AuthenticatedLayout>
    <Head title="学習ダッシュボード" />

    <div class="study-page">
      <div class="study-container">

        <!-- ヘッダー -->
        <header class="study-header">
          <div class="study-header__texts">
            <h1 class="study-header__title">学習ダッシュボード</h1>
            <p class="study-header__subtitle">
              今週の学習時間と、どの分野に時間を使っているかを確認できます。
            </p>
            <p class="study-header__period">
              期間: {{ props.period.from }} 〜 {{ props.period.to }}
            </p>
          </div>
          <div class="study-header__summary">
            <div class="study-summary-card">
              <span class="study-summary-card__label">期間合計</span>
              <span class="study-summary-card__value">
                {{ totalHours }}<span class="study-summary-card__unit">時間</span>
              </span>
              <span class="study-summary-card__sub">（{{ props.totalMinutes }} 分）</span>
            </div>
          </div>
        </header>

        <!-- グラフ -->
        <section class="study-section">
          <div class="mi-section-header">
            <h2 class="mi-section-title">学習グラフ</h2>
            <p class="mi-section-caption">
              日別とカテゴリ別の2つのグラフで、学習の偏りやペースをチェックできます。
            </p>
          </div>

          <div class="study-charts">
            <!-- 日別グラフ -->
            <article class="mi-card study-chart-card">
              <header class="mi-card__header">
                <h3 class="mi-card__title">日別学習時間</h3>
                <p class="mi-card__subtitle">1日あたりの学習時間（分）</p>
              </header>
              <div class="mi-card__body">
                <BarChart :labels="dailyLabels" :values="dailyValues" />
              </div>
            </article>

            <!-- カテゴリ別グラフ -->
            <article class="mi-card study-chart-card">
              <header class="mi-card__header">
                <h3 class="mi-card__title">カテゴリ別学習時間</h3>
                <p class="mi-card__subtitle">どの分野に時間を使っているか</p>
              </header>
              <div class="mi-card__body">
                <PieChart :labels="categoryLabels" :values="categoryValues" />

                <ul class="study-legend">
                  <li
                    v-for="item in props.byCategory"
                    :key="item.category"
                    class="study-legend__item"
                  >
                    <span class="study-legend__color-dot"></span>
                    <span class="study-legend__label">{{ item.category }}</span>
                    <span class="study-legend__value">{{ item.minutes }} 分</span>
                  </li>
                </ul>
              </div>
            </article>
          </div>
        </section>

      </div>
    </div>
  </AuthenticatedLayout>
</template>
