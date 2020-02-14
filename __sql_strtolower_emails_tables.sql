UPDATE membres_countries SET email = LOWER(email);
UPDATE membres_corres_last_time SET MATR = LOWER(MATR);
UPDATE membres_corres_connexion SET MATR = LOWER(MATR);
UPDATE membres_corres SET MATR = LOWER(MATR);
UPDATE membres_corres SET EMAIL = LOWER(EMAIL);