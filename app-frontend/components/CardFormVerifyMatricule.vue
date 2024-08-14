<script setup lang="ts">
import { z } from "zod";

const state = reactive({
  matricule: undefined,
});

const schema = z.object({
  matricule: z.string({ message: "Ce champ est requis" }),
});

function goToNexPage() {
  return navigateTo(`/catechumene/choices/elder/${state.matricule}`);
}
</script>

<template>
  <UCard class="w-[500px]">
    <template #header>
      <h1 class="text-xl">Vérifiez votre identitée</h1>
    </template>
    <UForm
      :state="state"
      :schema="schema"
      @submit="goToNexPage"
      class="space-y-5"
    >
      <UFormGroup name="matricule" label="Entrez votre matricule" required>
        <UInput v-model="state.matricule" size="lg" />
      </UFormGroup>

      <UButton block type="submit" size="lg" label="Vérifier" />
    </UForm>
  </UCard>
</template>
