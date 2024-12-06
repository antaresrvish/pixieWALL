<template>
  <div class="anahat">
    <Header />
    <ColorPicker @color-selected="setColor" />
    <Canvas :selectedColor="selectedColor" />
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import Header from './components/header.vue';
import ColorPicker from './components/colorPicker.vue';
import Canvas from './components/canvas.vue';

export default defineComponent({
  components: { Header, ColorPicker, Canvas },
  setup() {
    const selectedColor = ref('red');

    const setColor = (color: string) => {
      selectedColor.value = color;
    };

    return { selectedColor, setColor };
  },
});
</script>

<style>
.anahat {
  width: 600px;
  margin: 0 auto;
  background: rgba(255, 255, 255, 0.95);
}
</style>
