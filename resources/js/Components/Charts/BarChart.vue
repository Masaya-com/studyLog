<script setup>
import { onMounted, ref, watch } from 'vue';
import Chart from 'chart.js/auto';

const props = defineProps({
    labels: Array,     // ["2025-01-01", "2025-01-02", ...]
    values: Array      // [60, 120, 30, ...] ← minutes
});

const canvasRef = ref(null);
let chartInstance = null;

const renderChart = () => {
    if (chartInstance) chartInstance.destroy();

    chartInstance = new Chart(canvasRef.value, {
        type: 'bar',
        data: {
            labels: props.labels,
            datasets: [{
                label: '学習時間（分）',
                data: props.values,
                backgroundColor: '#2563ebaa',
                borderColor: '#2563eb',
                borderWidth: 1,
                borderRadius: 6,
                maxBarThickness: 32,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: '分' }
                }
            }
        }
    });
};

onMounted(renderChart);

// props変化時にも描画し直す
watch(() => props.values, renderChart);
</script>

<template>
    <canvas ref="canvasRef" height="120"></canvas>
</template>
