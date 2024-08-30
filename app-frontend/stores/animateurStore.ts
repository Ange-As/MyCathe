import { defineStore } from "pinia";
import { createApi } from "~/utils/apiManage";

export const useAnimateurStore = defineStore("animateur", {
  actions: {
    async storeAnimateur(data: any) {
      const { apiWithoutAuth } = createApi("https://cathe.tech-hive.tech/api/v1", "");
      try {
        const response = await apiWithoutAuth.post("/animateur/store", data);
        return response.data;
      } catch (error) {
        throw error;
      }
    },
  },
});
