from utils import *

"""
Fichier de test des fonctions dans utils.py
"""

# Création d'un DataFrame pour les tests
data = {
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

df = pd.DataFrame(data)

# Test pour excelToId
print("Testing excelToId:" + "\n" + str(excelToId(df)))

# Test pour excelToTitre
print("\nTesting excelToTitre:" + "\n" + str(excelToTitre(df)))

# Test pour excelToRef
print("\nTesting excelToRef:" + "\n" + str(excelToRef(df)))

# Test pour excelToAuteur
print("\nTesting excelToAuteur:" + "\n" + str(excelToAuteur(df)))

# Test pour excelToDateParutionDebut
print("\nTesting excelToDateParutionDebut:" + "\n" + str(excelToDateParutionDebut(df)))

# Test pour excelToDateParutionFin
print("\nTesting excelToDateParutionFin:" + "\n" + str(excelToDateParutionFin(df)))

# Test pour excelToVersion
print("\nTesting excelToVersion:" + "\n" + str(excelToVersion(df)))

# Test pour excelToMotsCles
print("\nTesting excelToMotsCles:" + "\n" + str(excelToMotsCles(df)))

# Test pour excelToMecanisme
print("\nTesting excelToMecanisme:" + "\n" + str(excelToMecanisme(df)))
