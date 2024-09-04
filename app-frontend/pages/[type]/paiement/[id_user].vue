<script lang="ts" setup>
import { z } from "zod";
import { paiementSchema } from "~/schemas/paiementSchema";
import type { FormSubmitEvent } from "#ui/types";
import { ref, reactive } from 'vue';
import { useRoute, useRouter } from 'vue-router';

type Schema = z.infer<typeof paiementSchema>;

const route = useRoute();
const router = useRouter();

const state = reactive<Schema>({
  reference_id: "",
  catechumene_id: Number(route.params.id_user),
  mode_paiement: "",
  montant: "",
  type_paiement: "subventionné",
});

const methods = [
  { value: "WAVE", label: "Wave(0709167474)" },
  { value: "OM", label: "Orange Money(0709167474)" },
  { value: "MOOV MONEY", label: "Moov Money(0172373636)" },
  { value: "MOMO", label: "MTN Money(0596287575)" },
];

const typePaiement = [
  { value: "subventionné", label: "Subventionné" },
  { value: "partiel", label: "Partiel" },
  { value: "total", label: "Total" },
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
      
      // Logique pour rediriger après le paiement
      router.push('/');
    } else {
      toast.add({
        title: response.message,
      });
    }
  } catch (error) {
    console.error("Error during payment submission:", error);
    toast.add({
      title: "Une erreur est survenue lors du paiement.",
    });
  } finally {
    loading.value = false;
  }
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
        <div class="space-y-1">
          <UFormGroup name="type_paiement" label="Type de paiement" required>
            <URadio
              v-for="r of typePaiement"
              :key="r.value"
              v-model="state.type_paiement"
              v-bind="r"
            />
          </UFormGroup>
        </div>

        <div class="space-y-1" v-if="state.type_paiement !== 'subventionné'">
          <UFormGroup name="mode_paiement" label="Mode de paiement" required>
            <URadio
              v-for="method of methods"
              :key="method.value"
              v-model="state.mode_paiement"
              v-bind="method"
            />
          </UFormGroup>
        </div>

        <UFormGroup
          v-if="state.type_paiement !== 'subventionné'"
          name="reference_id"
          label="Entrez le numéro qui effectue le dépôt"
          size="lg"
          required
        >
          <UInput v-model="state.reference_id" />
        </UFormGroup>

        <UFormGroup
          v-if="state.type_paiement !== 'subventionné'"
          name="montant"
          label="Entrez le montant que vous avez déposé"
          size="lg"
          required
        >
          <UInput v-model="state.montant" />
        </UFormGroup>

        <UButton
          size="lg"
          label="Enregistrer"
          block
          :loading="loading"
          type="submit"
        />
      </UForm>
    </UCard>
  </div>

  <UNotifications />
</template>
