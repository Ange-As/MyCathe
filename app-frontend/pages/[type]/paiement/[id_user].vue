<script setup lang="ts">
import { z } from "zod";
import { paiementSchema } from "~/schemas/paiementSchema";
import type { FormSubmitEvent } from "#ui/types";

type Schema = z.output<typeof paiementSchema>;
const route = useRoute();
const state = reactive({
  reference_id: undefined,
  catechumene_id: Number(route.params.id_user),
  mode_paiement: undefined,
  montant: undefined,
});

const methods = [
  { value: "wave", label: "Wave" },
  { value: "OM", label: "Orange Money" },
];

const paiementStore = useCatechumeneStore();
const loading = ref(false);
const toast = useToast();

async function handleSubmit(event: FormSubmitEvent<Schema>) {
  loading.value = true;

  try {
    const response = await paiementStore.storePaiement(event.data);

    if (response.status === 200) {
      toast.add({
        title: response.message,
      });
      navigateTo("/");
    } else {
      toast.add({
        title: response.message,
      });
    }
  } catch (error) {
    console.error(error);

    toast.add({
      title: "Ooops, une erreur !",
    });
  } finally {
    loading.value = false;
  }

  console.log(event.data);
}
</script>

<template>
  <div class="w-full h-screen flex justify-center items-center">
    <UCard class="w-[500px]">
      <template #header>
        <h1 class="text-xl text-center">Paiement</h1>
      </template>
      <UForm
        :state="state"
        :schema="paiementSchema"
        @submit="handleSubmit"
        class="space-y-5"
      >
        <UFormGroup
          name="catecgumene_id"
          label="Entrez le numero de référence de votre dépôt"
          size="lg"
          class="hidden"
        >
          <UInput v-model="state.catechumene_id" />
        </UFormGroup>

        <div class="space-y-1">
          <UFormGroup name="catechumene_id">
            <URadio
              v-for="method of methods"
              :key="method.value"
              v-model="state.mode_paiement"
              v-bind="method"
            />
          </UFormGroup>
        </div>

        <UFormGroup
          name="reference_id"
          label="Entrez le numero de référence de votre dépôt"
          size="lg"
        >
          <UInput v-model="state.reference_id" />
        </UFormGroup>

        <UFormGroup
          name="montant"
          label="Entrez le montant que vous avez déposé"
          size="lg"
        >
          <UInput v-model="state.montant" />
        </UFormGroup>

        <UButton
          size="lg"
          label="Enregister"
          block
          :loading="loading"
          type="submit"
        />
      </UForm>
    </UCard>
  </div>

  <UNotifications />
</template>
