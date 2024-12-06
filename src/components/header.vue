<template>
    <div id="tiklama">
        Şu ana kadar <span id="tiklamaSayi">{{ clickCount }}</span> tıklama
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted } from 'vue';
import { fetchClickCount } from '../services/api';

export default defineComponent({
    setup() {
        const clickCount = ref(0);

        const updateClickCount = async () => {
            clickCount.value = await fetchClickCount();
        };

        onMounted(updateClickCount);

        return { clickCount };
    },
});
</script>

<style scoped>
#tiklama {
    text-align: center;
    font-family: 'trebuchet ms';
    line-height: 50px;
}
</style>