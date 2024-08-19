<script setup lang="ts">
const router = useRouter();
</script>

<template>
  <div class="w-full h-screen flex justify-center items-center">
    <UCard class="w-[500px]">
      <UButton
        label="Première année"
        size="lg"
        block
        @click="router.push('choices/new')"
      />
      <UDivider label="Ou" />
      <div class="space-y-5">
        <UButton
          label="Deuxième année"
          size="lg"
          block
          color="blue"
          @click="router.push('choices/elder')"
        />
        <UButton
          label="Troisième année"
          size="lg"
          block
          color="blue"
          @click="router.push('choices/elder')"
        />
        <UButton
          label="Quatrième année"
          size="lg"
          block
          color="blue"
          @click="router.push('choices/elder')"
        />
        <UButton
          label="cinquième année"
          size="lg"
          block
          color="blue"
          @click="router.push('choices/elder')"
        />
      </div>
    </UCard>
  </div>
</template>
