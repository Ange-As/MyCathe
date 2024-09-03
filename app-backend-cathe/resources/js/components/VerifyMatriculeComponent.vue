<script>
import {
    editCatechumene,
    indexOneMatricule,
    indexOnePaiement,
} from "../stores/defaultStore";

export default {
    data() {
        return {
            matricule: "",
            rows: [],
            data: {
                nom: "",
                prenom: "",
                date_inscription: "",
                annee_catechese: "",
                is_paiement_valid: "",
            },
            paiement: {
                reference_id: "",
                is_paiement_valid: false,
                montant: "",
                type_paiement:""
            },
            loading: false,
        };
    },
    methods: {
        async getData() {
            try {
                const response = await indexOneMatricule(this.matricule);
                const secondResponse = await indexOnePaiement(response.id);
                if (secondResponse.length !== 0) {
                    this.paiement.reference_id = secondResponse.reference_id;
                    this.paiement.is_paiement_valid =
                        secondResponse.is_paiement_valid === 0 ? false : true;
                    this.paiement.montant = secondResponse.montant;
                    this.paiement.type_paiement = secondResponse.type_paiement
                }
                this.data = response;
            } catch (error) {
                console.log(error);
            }
        },
        async editData() {
            this.loading = true;
            try {
                this.data.is_paiement_valid = this.paiement.is_paiement_valid;
                const response = await editCatechumene(
                    this.matricule,
                    this.data
                );

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
        <div class="col-lg-3 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="font-weight-bold">Rechercher un catéchumènes</h5>
                </div>
                <div class="card-body">
                    <form @submit.prevent="getData">
                        <input
                            type="text"
                            placeholder="Matricule"
                            class="form-control mb-4"
                            v-model="matricule"
                        />
                        <button class="btn btn-primary" type="submit">
                            Rechercher
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-9 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="font-weight-bold">
                        Informations sur le catéchumène
                    </h5>
                </div>
                <div class="card-body">
                    <form @submit.prevent="editData">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"
                                >Nom</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="exampleInputEmail1"
                                aria-describedby="emailHelp"
                                v-model="data.nom"
                                required
                            />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"
                                >Prénom</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="exampleInputEmail1"
                                aria-describedby="emailHelp"
                                v-model="data.prenom"
                                required
                            />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"
                                >Type de paiement</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="exampleInputEmail1"
                                aria-describedby="emailHelp"
                                disabled
                                v-model="paiement.type_paiement"
                                required
                            />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"
                                >Numéro de transaction</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="exampleInputEmail1"
                                aria-describedby="emailHelp"
                                disabled
                                v-model="paiement.reference_id"
                                required
                            />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"
                                >Montant</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="montant"
                                aria-describedby="emailHelp"
                                disabled
                                v-model="paiement.montant"
                                required
                            />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"
                                >date d'inscription</label
                            >
                            <input
                                type="date"
                                class="form-control"
                                id="exampleInputEmail1"
                                aria-describedby="emailHelp"
                                v-model="data.date_inscription"
                                required
                            />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"
                                >Année de catéchèse</label
                            >
                            <input
                                type="text"
                                id="annee_catechese"
                                class="form-control"
                                v-model="data.annee_catechese"
                                required
                            />
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label"
                                >Valider le paiement</label
                            >
                            <div class="form-check form-switch">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    role="switch"
                                    id="flexSwitchCheckChecked"
                                    v-model="paiement.is_paiement_valid"
                                />
                            </div>
                        </div>
                        <button
                            class="btn btn-primary mt-3"
                            type="submit"
                            :disabled="loading"
                        >
                            <span v-if="!loading"> Modifier </span>
                            <div
                                class="spinner-border"
                                role="status"
                                v-if="loading"
                            >
                                <span class="sr-only">Loading...</span>
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
