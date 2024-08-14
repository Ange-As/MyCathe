import { defineStore } from "pinia";
import { createApi } from "~/utils/apiManage";

export const useCatechumeneStore = defineStore("catechumene", {
  actions: {
    async storeCatechumene(data: any) {
      const { apiWithoutAuth } = createApi("https://cathe.tech-hive.tech/api/v1", "");
      try {
        const response = await apiWithoutAuth.post("/catechumene/store", data);
        return response.data;
      } catch (error) {
        throw error;
      }
    },

    async storePaiement(data: any) {
      const { apiWithoutAuth } = createApi("https://cathe.tech-hive.tech/api/v1", "");
      try {
        const response = await apiWithoutAuth.post("/paiement/store", data);
        return response.data;
      } catch (error) {
        throw error;
      }
    },

    async getInfoCate(matricule: any) {
      const { apiWithoutAuth } = createApi("https://cathe.tech-hive.tech/api/v1", "");
      try {
        const response = await apiWithoutAuth.get(
          `/catechumene/${matricule}/get`
        );
        return response.data;
      } catch (error) {
        throw error;
      }
    },
  },
});
