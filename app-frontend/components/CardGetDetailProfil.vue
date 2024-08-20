<script setup lang="ts">
const rows = ref<any>([]);
const route = useRoute();
const catechumeneStore = useCatechumeneStore();
const isLoading = ref(false);

async function getDetail() {
  isLoading.value = true;
  try {
    const response = await catechumeneStore.getInfoCate(route.params.matricule);
    rows.value = response;
    console.log(rows);
  } catch (error) {
    console.log(error);
  } finally {
    isLoading.value = false;
  }
}

onMounted(() => {
  getDetail();
});
</script>

<template>
  <UCard class="w-[500px]">
    <template #header>
      <h1 class="text-xl">Vos informations</h1>
    </template>

    <div v-if="!isLoading">
      <div class="space-y-5" v-if="rows.length != 0">
        <p>Nom: {{ rows.nom }}</p>
        <p>Prenom: {{ rows.prenom }}</p>
        <!-- <p>Nom: {{ rows.nom }}</p> -->

        <UButton
          label="Passer au paiement"
          block
          size="lg"
          @click="navigateTo(`/catechumene/paiement/${rows.id}`)"
        />
      </div>

      <div v-else>
        <p class="text-red-500 mb-5 text-center">Ce compte n'existe pas !</p>
        <UButton
          label="Inscrivez-vous"
          block
          size="lg"
          @click="
            navigateTo(`/catechumene/${route.params.tranche}/choices/new/`)
          "
        />
      </div>
    </div>
    <div v-else class="flex justify-center items-end">
      <UProgress animation="carousel" size="sm" />
    </div>
  </UCard>
</template>
