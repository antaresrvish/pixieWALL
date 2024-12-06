<template>
    <div id="renkSecim">
        <span v-for="color in colors" :key="color" class="renk" :id="color" :style="{ backgroundColor: color }"
            @click="selectColor(color)"></span>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';

export default defineComponent({
    emits: ['color-selected'],
    setup(_, { emit }) {
        const colors = ['red', 'green', 'blue', 'yellow', 'gray', 'purple', 'pink', 'orange', 'black', 'white'];

        const selectColor = (color: string) => {
            emit('color-selected', color);
        };

        return { colors, selectColor };
    },
});
</script>

<style scoped>
.renk {
    width: 47px;
    height: 50px;
    display: block;
    float: left;
    cursor: pointer;
    margin: 5px;
    border-radius: 5px;
}
</style>