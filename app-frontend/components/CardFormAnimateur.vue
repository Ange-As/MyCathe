<script setup lang="ts">
import type { FormSubmitEvent } from "#ui/types";
import { z } from "zod";
import { animateurSchema } from "~/schemas/animateurSchema";

type Schema = z.output<typeof animateurSchema>;

const initialState = {
  nom: undefined,
  prenom: undefined,
  contact: undefined,
  categorie_catechumene: undefined,
  jour_cours: undefined,
  annee_catechese: undefined,
};

const state = reactive({ ...initialState });

const years = [
  { value: "1 ÈRE ANNÉE", text: "1 ÈRE ANNÉE" },
  { value: "2 ÈME ANNÉE", text: "2 ÈME ANNÉE" },
  { value: "3 ÈME ANNÉE", text: "3 ÈME ANNÉE" },
  { value: "4 ÈME ANNÉE", text: "4 ÈME ANNÉE" },
  { value: "5 ÈME ANNÉE", text: "5 ÈME ANNÉE" },
];

// Options pour le sélecteur de catégorie
const categories = [
  { value: "4eme-3eme", text: "4ème-3ème" },
  { value: "2nde-1ere-terminal", text: "2nde-1ère-Terminal" },
  { value: "non-scolarisé", text: "Non-scolarisé" },
  { value: "etudiant-travailleur", text: "Étudiant/Travailleur" },
];

// Options pour le sélecteur de jours
const days = [
  { value: "mercredi-matin", text: "Mercredi matin" },
  { value: "mercredi-15h", text: "Mercredi 15h" },
  { value: "samedi-matin", text: "Samedi matin" },
  { value: "samedi-15h", text: "Samedi 15h" },
  { value: "dimanche", text: "Dimanche" },
];
const loading = ref(false);
const toast = useToast();
const animateurStore = useAnimateurStore();

async function handleSubmit(event: FormSubmitEvent<Schema>) {
  loading.value = true;

  try {
    const response = await animateurStore.storeAnimateur(event.data);

    if (response.status == 200) {
      toast.add({
        title: response.message,
      });
      Object.assign(state, initialState);
    } else {
      toast.add({
        title: response.message,
      });
    }
  } catch (error) {
    console.log(error);

    toast.add({
      title: "Ooops, une erreur !",
    });
  } finally {
    loading.value = false;
  }
}
</script>

<template>
  <UCard class="w-[500px]">
    <template #header>
      <div class="text-center text-xl">Inscription animateur</div>
    </template>
    <UForm
      :state="state"
      :schema="animateurSchema"
      @submit="handleSubmit"
      class="space-y-5"
    >
    <UFormGroup name="photo_animateur" size="lg">
      <input type="file" name="photo_animateur" id="photo_animateur">
    </UFormGroup>
      <UFormGroup name="nom" size="lg">
        <UInput placeholder="Saisissez votre nom" v-model="state.nom" />
      </UFormGroup>
      <UFormGroup name="prenom" size="lg">
        <UInput placeholder="Saisissez votre prenom" v-model="state.prenom" />
      </UFormGroup>
      <UFormGroup name="contact" size="lg">
        <UInput placeholder="Saisissez votre contact" v-model="state.contact" />
      </UFormGroup>
      <UFormGroup name="categorie_catechumene" size="lg">
        <USelect
          placeholder="Catégorie de catéchumène que vous souhaitez prendre"
          v-model="state.categorie_catechumene"
          :options="categories"
          option-attribute="text"
        />
      </UFormGroup>
      <UFormGroup name="jour_cours" size="lg">
        <USelect
          placeholder="Les jours où vous souhaitez enseigner"
          v-model="state.jour_cours"
          :options="days"
          option-attribute="text"
        />
      </UFormGroup>

      <UFormGroup name="annee_catechese" size="lg">
        <USelect
          placeholder="L'année que vous souhaitez prendre"
          v-model="state.annee_catechese"
          :options="years"
          option-attribute="text"
        />
      </UFormGroup>

      <UButton
        label="Enreigstrer"
        block
        size="lg"
        type="submit"
        :loading="loading"
      />
    </UForm>
  </UCard>

  <UNotifications />
</template>
