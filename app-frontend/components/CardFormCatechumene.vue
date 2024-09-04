<script lang="ts" setup>
import { z } from "zod";
import { catechumeneSchema } from "~/schemas/catechumeneSchema";
import type { FormSubmitEvent } from "#ui/types";
import * as QRCode from "qrcode";  // Ajout pour QRCode
import { jsPDF } from 'jspdf';  // Ajout pour jsPDF
import { ref, reactive } from 'vue';

type Schema = z.output<typeof catechumeneSchema>;

const route = useRoute();
const router = useRouter();
const state = reactive({
  photo: undefined,
  photo_catechumene: undefined,
  nom: undefined,
  prenom: undefined,
  age_de_naissance: undefined,
  contact: undefined,
  niveau_catechese: undefined,
  classe_or_profession: undefined,
  jour_cours: undefined,
  annee_catechese: "2024-2025",
  profil: route.params.tranche,
  date_naissance: undefined,
  ets_origin: undefined,
  showQRCodeButton: false, // Ajout pour gérer l'affichage du bouton de téléchargement
});

const years = [
  { value: "1 ÈRE ANNÉE", text: "1 ÈRE ANNÉE" },
  { value: "2 ÈME ANNÉE", text: "2 ÈME ANNÉE" },
  { value: "3 ÈME ANNÉE", text: "3 ÈME ANNÉE" },
  { value: "4 ÈME ANNÉE", text: "4 ÈME ANNÉE" },
  { value: "5 ÈME ANNÉE", text: "5 ÈME ANNÉE" },
];

const days = [
  { value: "mercredi-matin", text: "Mercredi matin" },
  { value: "mercredi-15h", text: "Mercredi 15h" },
  { value: "samedi-matin", text: "Samedi matin" },
  { value: "samedi-15h", text: "Samedi 15h" },
  { value: "dimanche", text: "Dimanche" },
];

const loading = ref(false);
const pdfGenerated = ref(false);  // Nouvelle variable pour suivre l'état de génération du PDF
const catechumeneStore = useCatechumeneStore();
const toast = useToast();

const handleChangeImage = (event: Event, key: keyof typeof state) => {
  const target = event.target as HTMLInputElement;
  const file = target.files?.[0];
  if (file) {
    state[key] = file;
  }
};

async function generateQRCode(data: string): Promise<string> {
  try {
    const qrCodeUrl = await QRCode.toDataURL(data);
    return qrCodeUrl;
  } catch (err) {
    console.error(err);
    throw new Error("Failed to generate QR code");
  }
}

function generatePDF(qrCodeUrl: string, data: any): void {
  const doc = new jsPDF();

  // Ajouter le QR code au PDF
  doc.addImage(qrCodeUrl, "PNG", 15, 40, 180, 180);



  // Enregistrer le PDF
  doc.save(`${data.nom}_${data.prenom}_QRCode.pdf`);
}

async function handleSubmit(event: FormSubmitEvent<Schema>) {
  loading.value = true;

  try {
    const response = await catechumeneStore.storeCatechumene(state);
    if (response.status == 200) {
      toast.add({
        title: response.message,
      });

      // Générer le QR code avec les informations du catéchumène
      const qrCodeData = `
        Nom: ${state.nom}
        Prénom: ${state.prenom}
        Contact: ${state.contact}
        Niveau de catéchèse: ${state.niveau_catechese}
        Classe ou profession: ${state.classe_or_profession}
        Date de naissance: ${state.date_naissance}
      `;
      const qrCodeUrl = await generateQRCode(qrCodeData);

      // Générer et télécharger le PDF contenant le QR code
      generatePDF(qrCodeUrl, state);

      // Indiquer que le PDF a été généré
      pdfGenerated.value = true;
      
      toast.add({
        title: "Le QR code a été généré et le PDF est prêt à être téléchargé.",
        type: "success"
      });

      if (response.id_cate != null) {
        navigateTo(`/catechumene/paiement/${response.id_cate}`);
      }
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
      <UFormGroup
        name="photo_catechumene"
        size="lg"
        label="Chargez votre photo"
      >
        <input
          type="file"
          name="photo_catechumene"
          id="photo_catechumene"
          @change="handleChangeImage($event, 'photo_catechumene')"
        />
      </UFormGroup>
      <UFormGroup label="Chargez votre extrait de naissance" name="photo">
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
        <UInput
          placeholder="Ex: 2023-2024"
          v-model="state.annee_catechese"
          disabled
          color="gray"
        />
      </UFormGroup>
      <UFormGroup name="ets_origin" v-if="route.params.tranche == '2'" required>
        <UInput
          placeholder="Donnez nous votre paroisse d'origine"
          v-model="state.ets_origin"
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
    <div v-if="pdfGenerated" class="text-center mt-4 text-green-600">
      Le QR code a été généré et le PDF est prêt à être téléchargé.
    </div>
  </UCard>
  
  <UNotifications />
</template>
