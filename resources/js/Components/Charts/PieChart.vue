<script setup>
import { onMounted, ref, watch } from 'vue';
import Chart from 'chart.js/auto';

const props = defineProps({
    labels: Array,   // ["Laravel", "Vue", "Blog", ...]
    values: Array    // [120, 300, 45, ...]
});

const canvasRef = ref(null);
let chartInstance = null;

const colorPalette = [
    "#2563eb", "#10b981", "#f59e0b", "#ef4444",
    "#6366f1", "#0ea5e9", "#ec4899", "#22c55e"
];

const renderChart = () => {
    if (chartInstance) chartInstance.destroy();

    chartInstance = new Chart(canvasRef.value, {
        type: 'pie',
        data: {
            labels: props.labels,
            datasets: [{
                data: props.values,
                backgroundColor: colorPalette,
                borderWidth: 0,
            }]
        },
        options: { responsive: true }
    });
};

onMounted(renderChart);
watch(() => props.values, renderChart);
</script>

<template>
    <canvas ref="canvasRef" height="150"></canvas>
</template>
