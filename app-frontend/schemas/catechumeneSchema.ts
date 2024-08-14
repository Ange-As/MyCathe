import { z } from "zod";

export const catechumeneSchema = z.object({
  nom: z.string({ message: "ce champ est requis !" }),
  prenom: z.string({ message: "ce champ est requis !" }),
  age_de_naissance: z.number({ message: "ce champ est requis" }),
  contact: z.string({ message: "ce champ est requis !" }),
  niveau_catechese: z.string({ message: "ce champ est requis" }),
  classe_or_profession: z.string({ message: "ce champ est requis !" }),
  jour_cours: z.string({ message: "ce champ est requis !" }),
  annee_catechese: z.string({ message: "ce champ est requis !" }),
  profil: z.string({ message: "ce champ est requis !" }),
  date_naissance: z.string({ message: "ce champ est requis !" }),
});
