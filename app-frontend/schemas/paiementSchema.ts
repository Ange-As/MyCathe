import { z } from "zod";

export const paiementSchema = z.object({
  catechumene_id: z.number(),
  type_paiement: z.string()
});
