import { string, z } from "zod";

export const animateurSchema = z.object({
  nom: z.string(),
  prenom: z.string(),
  contact: z.string(),
  categorie_catechumene: z.string(),
  jour_cours: z.string(),
  annee_catechese: string(),
});
