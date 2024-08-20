<script lang="ts" setup></script>

<template>
  <div class="w-full justify-center items-center">
    <UCard class="w-[500px]">
      <UButton label="Jeune" color="blue" block @click="navigateTo('/catechumene/jeune/')" />
      <UDivider label="ou" />
      <UButton label="Adulte" color="gray" block @click="navigateTo('/catechumene/adulte/')" />
    </UCard>
  </div>
</template>
