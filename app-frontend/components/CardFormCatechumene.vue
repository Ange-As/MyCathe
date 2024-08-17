<script lang="ts" setup>
import { z } from "zod";
import { catechumeneSchema } from "~/schemas/catechumeneSchema";
import type { FormSubmitEvent } from "#ui/types";

type Schema = z.output<typeof catechumeneSchema>;

const state = reactive({
  photo: undefined,
  nom: undefined,
  prenom: undefined,
  age_de_naissance: undefined,
  contact: undefined,
  niveau_catechese: undefined,
  classe_or_profession: undefined,
  jour_cours: undefined,
  annee_catechese: undefined,
  profil: undefined,
  date_naissance: undefined,
});

const years = [
  { value: 1, text: "1 ÈRE ANNÉE" },
  { value: 2, text: "2 ÈME ANNÉE" },
  { value: 3, text: "3 ÈME ANNÉE" },
  { value: 4, text: "4 ÈME ANNÉE" },
  { value: 5, text: "5 ÈME ANNÉE" },
];

const days = [
  { value: "mercredi-matin", text: "Mercredi matin" },
  { value: "mercredi-15h", text: "Mercredi 15h" },
  { value: "samedi-matin", text: "Samedi matin" },
  { value: "samedi-15h", text: "Samedi 15h" },
  { value: "dimanche", text: "Dimanche" },
];

const profil = [
  { value: "JEUNE", text: "JEUNE" },
  { value: "ADULTE", text: "ADULTE" },
];

const loading = ref(false);
const catechumeneStore = useCatechumeneStore();
const toast = useToast();

const handleChangeImage = (event: Event, key: keyof typeof state) => {
  const target = event.target as HTMLInputElement;
  const file = target.files?.[0];
  if (file) {
    state[key] = file;
  }
};

async function handleSubmit(event: FormSubmitEvent<Schema>) {
  //   loading.value = true;

  try {
    const response = await catechumeneStore.storeCatechumene(event.data);
    if (response.status == 200) {
      toast.add({
        title: response.message,
      });
      navigateTo(`/catechumene/paiement/${response.id_cate}`);
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

  console.log(event.data);
}
</script>

<template>
  <UCard class="w-[500px]">
    <template #header>
      <div class="text-center text-xl">Inscription catéchumène</div>
    </template>
    <UForm
      :state="state"
      :schema="catechumeneSchema"
      @submit="handleSubmit"
      class="space-y-5"
    >
      <UFormGroup label="Chargez votre jugement de naissance" name="photo">
        <input type="file" @change="handleChangeImage($event, 'photo')" />
      </UFormGroup>
      <UFormGroup name="nom">
        <UInput placeholder="Nom" v-model="state.nom" />
      </UFormGroup>
      <UFormGroup name="prenom">
        <UInput placeholder="Prenom" v-model="state.prenom" />
      </UFormGroup>
      <UFormGroup name="age_de_naissance">
        <UInput
          placeholder="Votre âge"
          type="number"
          v-model="state.age_de_naissance"
        />
      </UFormGroup>
      <UFormGroup name="contact">
        <UInput placeholder="Contact" v-model="state.contact" />
      </UFormGroup>
      <UFormGroup name="classe_or_profession">
        <UInput
          placeholder="Saisissez votre classe ou votre profession"
          v-model="state.classe_or_profession"
        />
      </UFormGroup>
      <UFormGroup name="date_naissance" label="Votre date de naissance">
        <input type="date" v-model="state.date_naissance" />
      </UFormGroup>
      <UFormGroup name="jour_cours" size="lg">
        <USelect
          placeholder="Le jour où vous souhaitez faire cours"
          v-model="state.jour_cours"
          :options="days"
          option-attribute="text"
        />
      </UFormGroup>
      <UFormGroup name="niveau_catechese" size="lg">
        <USelect
          placeholder="Votre niveau de catéchèse"
          v-model="state.niveau_catechese"
          :options="years"
          option-attribute="text"
        />
      </UFormGroup>
      <UFormGroup name="annee_catechese" size="lg">
        <UInput placeholder="Ex: 2023-2024" v-model="state.annee_catechese" />
      </UFormGroup>
      <UFormGroup name="profil" size="lg">
        <USelect
          placeholder="Quel est votre profil"
          v-model="state.profil"
          :options="profil"
          option-attribute="text"
        />
      </UFormGroup>
      <UButton
        size="lg"
        type="submit"
        label="Enregistrer"
        :loading="loading"
        block
      />
    </UForm>
  </UCard>

  <UNotifications />
</template>
