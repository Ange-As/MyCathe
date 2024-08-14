<script setup lang="ts"></script>

<template>
  <div class="w-full h-screen flex justify-center items-center">
    <UCard class="w-[500px]">
      <UButton
        label="C'est ma première année"
        size="lg"
        block
        @click="navigateTo('/catechumene/choices/new')"
      />
      <UDivider label="Ou" />
      <UButton
        label="Je suis un ancien"
        size="lg"
        block
        color="blue"
        @click="navigateTo('/catechumene/choices/elder')"
      />
    </UCard>
  </div>
</template>
