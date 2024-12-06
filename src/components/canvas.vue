<template>
    <div id="tuval" :style="{ borderTop: `10px solid ${selectedColor}` }">
        <div v-for="cell in cells" :key="cell.hucre" class="k" :id="cell.hucre" :style="{ backgroundColor: cell.renk }"
            @click="onCellClick(cell.hucre)"></div>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, watchEffect } from 'vue';
import { fetchCells, updateCell } from '../services/api';

export default defineComponent({
    props: {
        selectedColor: String,
    },
    setup(props) {
        const cells = ref<{ hucre: string; renk: string }[]>([]);

        const fetchAndUpdateCells = async () => {
            cells.value = await fetchCells();
        };

        const onCellClick = async (hucre: string) => {
            await updateCell(hucre, props.selectedColor || 'red');
            fetchAndUpdateCells();
        };

        watchEffect(fetchAndUpdateCells);

        return { cells, onCellClick };
    },
});
</script>

<style scoped>
.k {
    width: 5px;
    height: 5px;
    border-right: 1px solid #f3f3f3;
    border-bottom: 1px solid #f3f3f3;
    float: left;
}

.k:hover {
    border-bottom: 1px solid red;
    border-right: 1px solid red;
}
</style>