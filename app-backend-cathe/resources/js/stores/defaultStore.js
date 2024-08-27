import axios from "axios";
import { API_LINK } from "../constant";

const indexOneMatricule = async (matricule) => {
    try {
        const response = await axios.get(
            `${API_LINK}/catechumene/${matricule}/get`
        );
        return response.data;
    } catch (error) {
        throw error;
    }
};

const indexOnePaiement = async (id_user) => {
    try {
        const response = await axios.get(`${API_LINK}/paiement/${id_user}/get`);
        return response.data;
    } catch (error) {
        throw error;
    }
};

const filterAnimateur = async (
    annee_catechese = "",
    categorie_catechumene = "",
    jour_cours = ""
) => {
    try {
        const response = await axios.get(
            `${API_LINK}/animateur/filter?annee_catechese=${annee_catechese}&categorie=${categorie_catechumene}&jour_cours=${jour_cours}`
        );
        return response.data;
    } catch (error) {
        throw error;
    }
};

const getStatCountCatechumene = async () => {
    try {
        const response = await axios.get("/v1/catechumene/get_count_today");
        return response.data;
    } catch (error) {
        throw error;
    }
};

export {
    indexOneMatricule,
    indexOnePaiement,
    filterAnimateur,
    getStatCountCatechumene,
};
