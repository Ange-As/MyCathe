<script lang="ts" setup>
const router = useRouter()
</script>

<template>
  <div class="w-full justify-center items-center">
    <UCard class="w-[500px]">
      <UButton label="Catéchumène de NDI" color="blue" block @click="router.push('/catechumene/1/')" size="lg" />
      <UDivider label="ou" />
      <UButton label="Catéchumène provenant d'une autre paroisse" color="gray" block @click="router.push('/catechumene/2/')" size="lg" />
    </UCard>
  </div>
</template>
