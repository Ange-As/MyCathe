import { z } from "zod";

export const paiementSchema = z.object({
  mode_paiement: z.string(),
  reference_id: z.string(),
  catechumene_id: z.number(),
  montant: z.string()
});
