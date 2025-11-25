<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import { ref, watch, onMounted, onUnmounted } from 'vue';

const page = usePage();
const user = page.props.auth.user;

// モバイルナビの開閉状態
const isMobileNavOpen = ref(false);

// --- 画面幅監視して PCに戻ったらモバイルメニューを閉じる ---
const handleResize = () => {
  if (window.innerWidth > 900) {
    isMobileNavOpen.value = false;
  }
};

onMounted(() => {
  window.addEventListener('resize', handleResize);
});

onUnmounted(() => {
  window.removeEventListener('resize', handleResize);
});

// ルートが変わったら自動的に閉じる
watch(
  () => page.url,
  () => {
    isMobileNavOpen.value = false;
  }
);
</script>

<template>
  <div class="app-shell">
    <!-- 共通ヘッダー -->
    <header class="app-header">
      <div class="app-header__inner">
        <!-- 左：ロゴ＆デスクトップナビ -->
        <div class="app-header__left">
          <Link :href="route('dashboard')" class="app-logo">
            <span class="app-logo__mark">SL</span>
            <span class="app-logo__texts">
              <span class="app-logo__title">StudyLog</span>
              <span class="app-logo__subtitle">My Learning Dashboard</span>
            </span>
          </Link>

          <!-- デスクトップ用ナビ -->
          <nav class="app-nav app-nav--desktop">
            <Link
              :href="route('dashboard')"
              class="app-nav__link"
              :class="{ 'app-nav__link--active': route().current('dashboard') }"
            >
              ダッシュボード
            </Link>
            <Link
              :href="route('study.index')"
              class="app-nav__link"
              :class="{ 'app-nav__link--active': route().current('study.index') }"
            >
              学習ログ一覧
            </Link>
            <Link
              :href="route('study.create')"
              class="app-nav__link"
              :class="{ 'app-nav__link--active': route().current('study.create') }"
            >
              学習ログ登録
            </Link>
          </nav>
        </div>

        <!-- 右：アカウント操作 + ハンバーガー -->
        <div class="app-header__right">
          <!-- ユーザードロップダウン（PC/スマホ共通でここ） -->
          <Dropdown align="right" width="48">
            <template #trigger>
              <button type="button" class="app-user">
                <span class="app-user__initial">
                  {{ user.name ? user.name.charAt(0).toUpperCase() : 'U' }}
                </span>
                <span class="app-user__info">
                  <span class="app-user__name">{{ user.name }}</span>
                  <span class="app-user__email">{{ user.email }}</span>
                </span>
              </button>
            </template>

            <template #content>
              <DropdownLink :href="route('profile.edit')">
                プロフィール
              </DropdownLink>

              <DropdownLink
                :href="route('logout')"
                method="post"
                as="button"
              >
                ログアウト
              </DropdownLink>
            </template>
          </Dropdown>

          <!-- モバイル用ハンバーガーボタン（アカウントの横） -->
          <button
            type="button"
            class="app-header__menu-toggle"
            @click="isMobileNavOpen = !isMobileNavOpen"
            :aria-expanded="isMobileNavOpen"
            aria-label="ナビゲーションメニュー"
          >
            <span class="app-header__menu-line" :class="{ 'app-header__menu-line--top-open': isMobileNavOpen }"></span>
            <span class="app-header__menu-line" :class="{ 'app-header__menu-line--middle-open': isMobileNavOpen }"></span>
            <span class="app-header__menu-line" :class="{ 'app-header__menu-line--bottom-open': isMobileNavOpen }"></span>
          </button>
        </div>
      </div>

      <!-- モバイル用ナビ（リンクだけ） -->
      <transition name="app-mobile-nav">
        <div v-if="isMobileNavOpen" class="app-mobile-nav">
          <nav class="app-mobile-nav__links">
            <Link
              :href="route('dashboard')"
              class="app-mobile-nav__link"
              :class="{ 'app-mobile-nav__link--active': route().current('dashboard') }"
            >
              ダッシュボード
            </Link>
            <Link
              :href="route('study.index')"
              class="app-mobile-nav__link"
              :class="{ 'app-mobile-nav__link--active': route().current('study.index') }"
            >
              学習ログ一覧
            </Link>
            <Link
              :href="route('study.create')"
              class="app-mobile-nav__link"
              :class="{ 'app-mobile-nav__link--active': route().current('study.create') }"
            >
              学習ログ登録
            </Link>
          </nav>
        </div>
      </transition>
    </header>

    <!-- ページ個別ヘッダー -->
    <header v-if="$slots.header" class="app-subheader">
      <div class="app-subheader__inner">
        <slot name="header" />
      </div>
    </header>

    <!-- メインコンテンツ -->
    <main class="app-main">
      <slot />
    </main>
  </div>
</template>
