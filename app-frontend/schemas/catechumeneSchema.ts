import { z } from "zod";

export const catechumeneSchema = z.object({
  photo: z.instanceof(File).optional(),
  photo_catechumene: z.instanceof(File).optional(),
  nom: z.string().min(1, "Le nom est requis"),
  prenom: z.string().min(1, "Le prénom est requis"),
  age_de_naissance: z.number().optional(),
  contact: z.string().min(1, "Le contact est requis"),
  niveau_catechese: z.string().min(1, "Le niveau de catéchèse est requis"),
  classe_or_profession: z.string().min(1, "La classe ou profession est requise"),
  jour_cours: z.string().min(1, "Le jour de cours est requis"),
  annee_catechese: z.string(),
  profil: z.string(),
  date_naissance: z.preprocess((arg) => {
    if (typeof arg === 'string' || arg instanceof String) {
      return new Date(arg as string);
    }
    return arg;
  }, z.date().optional()),
  ets_origin: z.string().optional(),
});
