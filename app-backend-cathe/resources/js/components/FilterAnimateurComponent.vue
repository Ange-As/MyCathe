<script>
import {
    deleteAnimateur,
    editAnimateur,
    filterAnimateur,
} from "../stores/defaultStore";

export default {
    data() {
        return {
            annee: "",
            categorie: "",
            jour_cours: "",
            data: {
                annee_catechese: "",
                categorie_catechumene: "",
                contact: "",
                id: 0,
                jour_cours: "",
                nom: "",
                prenom: "",
            },
            rows: [],
            loading: false,
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

                this.rows = response;
            } catch (error) {
                console.log(error);
            }
        },
        getData(row) {
            this.data = row;
        },
        async editData() {
            this.loading = true;
            try {
                const response = await editAnimateur(this.data.id, this.data);

                this.$swal.fire({
                    text: response.message,
                    icon: response.status == 200 ? "success" : "error",
                });
            } catch (error) {
                throw error;
            } finally {
                this.loading = false;
            }
        },

        async deleteData(id) {
            this.loading = true;
            try {
                const response = await deleteAnimateur(id);

                this.$swal.fire({
                    text: response.message,
                    icon: response.status == 200 ? "success" : "error",
                });
            } catch (error) {
                throw error;
            } finally {
                this.loading = false;
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
                                <tr v-for="d in rows">
                                    <td>{{ d.nom }} {{ d.prenom }}</td>
                                    <td>{{ d.contact }}</td>
                                    <td>{{ d.annee_catechese }}</td>
                                    <td>{{ d.categorie_catechumene }}</td>
                                    <td>
                                        <button
                                            type="button"
                                            class="btn btn-warning"
                                            data-toggle="modal"
                                            data-target="#exampleModal"
                                            style="margin-right: 10px"
                                            @click="getData(d)"
                                        >
                                            Modifier
                                        </button>
                                        <button
                                            class="btn btn-danger"
                                            @click="deleteData(d.id)"
                                        >
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

    <!-- modal -->
    <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Modifier les informations de l'utilisateur
                    </h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editData">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Nom</label>
                            <input
                                type="text"
                                class="form-control"
                                required
                                v-model="data.nom"
                            />
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Prénom</label>
                            <input
                                type="text"
                                class="form-control"
                                required
                                v-model="data.prenom"
                            />
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Contact</label>
                            <input
                                type="text"
                                class="form-control"
                                required
                                v-model="data.contact"
                            />
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label"
                                >Catégorie catéchumène</label
                            >
                            <select
                                class="form-control"
                                required
                                v-model="data.categorie_catechumene"
                            >
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
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label"
                                >Jour de cours</label
                            >
                            <select
                                name=""
                                id=""
                                class="form-control"
                                required
                                v-model="data.jour_cours"
                            >
                                <option value="mercredi-matin">
                                    Mercredi matin
                                </option>
                                <option value="mercredi-15h">
                                    Mercredi 15h
                                </option>
                                <option value="samedi-matin">
                                    Samedi matin
                                </option>
                                <option value="samedi-15h">Samedi 15h</option>
                                <option value="dimanche">Dimanche</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label"
                                >Année de catéchèse</label
                            >
                            <select
                                name=""
                                id=""
                                class="form-control"
                                required
                                v-model="data.annee_catechese"
                            >
                                <option selected>Sélectionner une année</option>
                                <option value="1 ÈRE ANNÉE">1 ÈRE ANNÉE</option>
                                <option value="2 ÈME ANNÉE">2 ÈME ANNÉE</option>
                                <option value="3 ÈME ANNÉE">3 ÈME ANNÉE</option>
                                <option value="4 ÈME ANNÉE">4 ÈME ANNÉE</option>
                                <option value="5 ÈME ANNÉE">5 ÈME ANNÉE</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Fermer
                        </button>
                        <button
                            type="submit"
                            class="btn btn-primary"
                            :disabled="loading"
                        >
                            <span v-if="!loading"> Sauvegarder </span>
                            <div
                                class="spinner-border"
                                role="status"
                                v-if="loading"
                            >
                                <span class="sr-only">Loading...</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
