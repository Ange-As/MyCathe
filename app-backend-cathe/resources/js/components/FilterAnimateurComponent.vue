<script>
import { filterAnimateur } from "../stores/defaultStore";

export default {
    data() {
        return {
            annee: "",
            categorie: "",
            jour_cours: "",
            data: [],
        };
    },
    methods: {
        async filterData() {
            try {
                const response = await filterAnimateur(
                    this.annee,
                    this.categorie,
                    this.jour_cours
                );
                console.log(response);
                
                this.data = response;
            } catch (error) {
                console.log(error);
            }
        },
    },
};
</script>

<template>
    <div class="row">
        <div class="col-lg-12 mb-3">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Filtre</h5>
                </div>
                <div class="card-body">
                    <form method="get" @submit.prevent="filterData">
                        <div
                            class="d-flex justify-content-between align-items-center"
                        >
                            <select
                                class="form-control"
                                aria-label="Default select example"
                                v-model="annee"
                            >
                                <option value="" selected>
                                    Sélectionner une année
                                </option>
                                <option value="1 ÈRE ANNÉE">1 ÈRE ANNÉE</option>
                                <option value="2 ÉME ANNÉE">2 ÉME ANNÉE</option>
                                <option value="3 ÈME ANNÉE">3 ÈME ANNÉE</option>
                                <option value="4 ÈME ANNÉE">4 ÈME ANNÉE</option>
                                <option value="5 ÈME ANNÉE">5 ÈME ANNÉE</option>
                            </select>
                            <select
                                class="form-control mx-4"
                                aria-label="Default select example"
                                v-model="categorie"
                            >
                                <option value="" selected>
                                    Sélectionner une catégorie
                                </option>
                                <option value="4eme-3eme">4ème-3ème</option>
                                <option value="2nde-1ere-terminal">
                                    2nde-1ère-Terminal
                                </option>
                                <option value="non-scolarisé">
                                    Non-scolarisé
                                </option>
                                <option value="etudiant-travailleur">
                                    Étudiant/Travailleur
                                </option>
                            </select>
                            <select
                                class="form-control"
                                aria-label="Default select example"
                                v-model="jour_cours"
                            >
                                <option value="" selected>
                                    Sélectionner un jour de cours
                                </option>
                                <option value="mercredi-matin">
                                    Mercredi matin
                                </option>
                                <option value="mercredi-15h2">
                                    Mercredi 15h
                                </option>
                                <option value="samedi-matin">
                                    Samedi matin
                                </option>
                                <option value="samedi-15h">Samedi 15h</option>
                                <option value="dimanche">Dimanche</option>
                            </select>

                            <button
                                class="btn btn-primary"
                                style="margin-left: 10px"
                                type="submit"
                            >
                                Chercher
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mb-3">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Liste des animateurs</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nom complet</th>
                                    <th>Contact</th>
                                    <th>Année de catéchèse</th>
                                    <th>Catégorie d'enseignement</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="d in data">
                                    <td>{{ d.nom }} {{ d.prenom }}</td>
                                    <td>{{ d.contact }}</td>
                                    <td>{{ d.annee_catechese }}</td>
                                    <td>{{ d.categorie_catechumene }}</td>
                                    <td>
                                        <button
                                            class="btn btn-warning"
                                            style="margin-right: 10px"
                                        >
                                            Modifier
                                        </button>
                                        <button class="btn btn-danger">
                                            Supprimer
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
