import pandas as pd

# données de test
donnees1 = {
    'Unnamed: 0': ["3319   ", 3320, ""],
    'TITRE': [' Game 1', '', ' Game Test 4 '],
    'REFERENCES (éditeur/distributeur)': ['Distrib ABC', 'Distrib XYZ', 'Distrib jsp     '],
    'AUTEURS': ['NR', 'Author A', 'Author B'],
    'DATE DE PARUTION DEBUT': ["ojeo", 1995, 2005],
    'DATE DE PARUTION FIN': [None, -18, 2025],
    'INFORMATION DATE': ['boite', 'info', 'info'],
    'VERSION': ['France', 'USA', 'UK'],
    'NOMBRE DE JOUEURS': ['1 ou +', '2-4', '1-4'],
    'AGE INDIQUE (cf colonne B)': ['NR', '10+', '8+'],
    'MOTS CLES': ['CONNAISSANCES, EDUCATIF', 'ACTION, STRATEGY', 'PUZZLE, LOGIQUE'],
    'N Boîte': [1, 2, 3],
    'LOCALISATION_CNJ': ['Connaissance 1', 'Test Location 2', 'Test Location 3'],
    'MECANISME (cf colonne A)': ['Connaissances', 'Strategie', 'Puzzle'],
    'Unnamed: 14': ["Puzzle", None, None],
    'Unnamed: 15': [None, None, "Connaissances"],
    'Collection d\'origine (cf colonne C)': [None, 'Collection A', 'Collection B'],
    'Etat': [None, 'Parfait', 'Abime'],
    'Code barre': [None, '123456789', '987654321']
}

# Créer un DataFrame à partir du dictionnaire
data1 = pd.DataFrame(donnees1)

# Spécifier le chemin du fichier Excel que nous allons créer
file_path = "./data/inventaire_perso.xlsx"

# Créer et sauvegarder le fichier Excel
data1.to_excel(file_path, index=False)

print(f"Le fichier Excel a été créé et sauvegardé sous : {file_path}")
