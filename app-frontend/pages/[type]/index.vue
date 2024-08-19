<script setup lang="ts">
const route = useRoute();
</script>

<template>
  <div class="w-full h-screen flex justify-center items-center">
    <CardFormAnimateur v-if="route.params.type == 'animateur'" />

    <div v-if="route.params.type == 'catechumene'">
      <CardFormTrancheAge />
    </div>
  </div>
</template>
