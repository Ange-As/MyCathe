import { defineStore } from "pinia";
import { createApi } from "~/utils/apiManage";

export const useAnimateurStore = defineStore("animateur", {
  actions: {
    async storeAnimateur(data: any) {
      const { apiWithoutAuth } = createApi("http://127.0.0.1:8000/api/v1", "");
      try {
        const response = await apiWithoutAuth.post("/animateur/store", data);
        return response.data;
      } catch (error) {
        throw error;
      }
    },
  },
});
