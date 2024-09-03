<script lang="ts" setup></script>

<template>
  <div class="page-container">
    <header class="header">
      <h1 class="app-name">KTNDI</h1>
    </header>
    <main class="main-content">
      <div class="text-content">
        <h2>Je m'inscris :</h2>
        <UButton
          class="signup-button"
          label="En tant que catéchumène"
          size="xl"
          block
          variant="outline"
          @click="navigateTo('/catechumene/')"
        />
        <UButton
          class="signup-button"
          label="En tant que animateur"
          size="xl"
          block
          variant="outline"
          @click="navigateTo('/animateur/')"
        />
      </div>
      <div class="image-container">
        <img src="/img/logo.jpeg" alt="logo" class="logo-image" />
      </div>
    </main>

    <UNotifications />
  </div>
</template>

<style scoped>
.page-container {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  overflow: hidden; /* Assure qu'il n'y a pas de défilement */
  background-color: #111010; /* Couleure de fond de la page */
}

.header {
  background-color: #000; /* Utilise le noir pour le fond du header */
  color: #00ff00; /* Utilise le vert pour le texte */
  padding: 20px;
  display: flex;
  justify-content: flex-start;
  align-items: center;
}

.app-name {
  font-size: 24px;
  font-weight: bold;
}

.main-content {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
  flex: 1;
}

.text-content {
  flex: 1;
  padding: 20px;
  color: white;
}

.signup-button {
  margin-bottom: 10px;
}

.image-container {
  flex: 1;
  width: 20vw; /* Utilise 30% de la largeur de la fenêtre */
  display: flex;
  justify-content: center; /* Centre l'image horizontalement dans le conteneur */
  align-items: center;
  padding: 20px;
}

.logo-image {
  width: 75%; /* L'image prendra 100% de la largeur du conteneur */
  height: auto;
  border-radius: 15px; /* Bordures arrondies pour l'image */
}
</style>
